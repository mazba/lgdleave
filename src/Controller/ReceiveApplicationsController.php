<?php
namespace App\Controller;

use Cake\Collection\Collection;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;


/**
 * ReceiveApplications Controller
 *
 * @property \App\Model\Table\ReceiveApplicationsTable $ReceiveApplications
 */
class ReceiveApplicationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        if ($this->request->is('ajax')) {
            $user = $this->Auth->user();
            $usrUnits = TableRegistry::get('user_designations');
            $userUnits = $usrUnits->find()
                ->select(['office_unit_id'])
                ->where(['user_id' => $user['id'], 'is_basic IS' => null]);
            $collection = new Collection($userUnits);
            $userUnits = $collection->extract('office_unit_id');
            $userUnits = $userUnits->toArray();

            $applicantType = TableRegistry::get('applicant_types_office_units');
            $applicantType = $applicantType->find()
                ->where(['office_unit_id IN' => $userUnits]);
            $collection = new Collection($applicantType);
            $applicantType = $collection->extract('applicant_type_id');
            $applicantTypes = $applicantType->toArray();
            $new_applications = TableRegistry::get('applications')->find();
            $new_applications->select(['location_type' => 'location_types.title_bn',
                'area_district' => 'zillas.zillaname',
                'area_division' => 'divisions.divname',
                'applicant_type' => 'applicant_types.title_bn',
                'application_type' => 'application_types.title_bn',
                'applicant_name_bn' => 'applications.applicant_name_bn',
                'id' => 'applications.id',
                'temporary_id' => 'applications.temporary_id',
                'submission' => "FROM_UNIXTIME(applications.submission_time,'%D, %M, %Y')",
            ]);
            $new_applications->select(['applications.id', 'applications.applicant_id', 'applications.applicant_name_bn', 'applications.phone', 'applications.email', 'applications.application_type_id', 'applications.start_date', 'applications.end_date', 'applications.status']);
            $new_applications->select(['applicants.id', 'applicants.applicant_type_id', 'applicants.location_type_id', 'applicants.division_id', 'applicants.district_id', 'applicants.upazila_id', 'applicants.union_id', 'applicants.union_ward', 'applicants.city_corporation_id', 'applicants.city_corporation_ward_id', 'applicants.municipal_id', 'applicants.municipal_ward_id']);
            $new_applications->select(['location_types.id', 'location_types.title_bn']);
            $new_applications->select(['application_types.id', 'application_types.title_bn']);
            $new_applications->where(['applications.status' => Configure::read('application_status.Pending')]);
            $new_applications->where(['applicants.applicant_type_id IN' => $applicantTypes]);

            $new_applications->leftJoin('applicants', 'applicants.id=applications.applicant_id');
            $new_applications->leftJoin('location_types', 'location_types.id=applicants.location_type_id');
            $new_applications->leftJoin('application_types', 'application_types.id=applications.application_type_id');
            $new_applications->leftJoin('divisions', 'divisions.divid=applicants.division_id');
            $new_applications->leftJoin('zillas', 'zillas.zillaid=applicants.district_id');
            $new_applications->leftJoin('applicant_types', 'applicant_types.id=applicants.applicant_type_id');

            $this->response->body(json_encode($new_applications->toArray()));
            return $this->response;
        }
    }


    /**
     * View method
     *
     * @param string|null $id Receive Application id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Applications');
        $Application = $this->Applications->get($id, [
            'contain' => []
        ]);
        $this->set('Application', $Application);
        $this->set('_serialize', ['Application']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function receive($id)
    {
        $this->loadModel('Applications');
        $this->loadModel('application_events');
        $this->loadModel('user_designations');

        $application = $this->Applications->get($id, [
            'contain' => [
                'Applicants',
                'ApplicationTypes',
                'ApplicationsFiles'
            ]
        ]);

        $applications = $application->toArray();

        $Area_division = TableRegistry::get('AreaDivisions')->find();
        $Area_division->where(['divid' => $application['applicant']['division_id']]);

        $Area_district = TableRegistry::get('AreaDistricts')->find();
        $Area_district->where(['zillaid' => $application['applicant']['district_id']]);

        $Area_upazila = TableRegistry::get('AreaUpazilas')->find();
        $Area_upazila->where(['zillaid' => $application['applicant']['district_id'], 'upazilaid' => $application['applicant']['upazila_id']]);

        $Municipal = TableRegistry::get('Municipals')->find();
        $Municipal->where(['municipalid' => $application['applicant']['municipal_id'], 'zillaid' => $application['applicant']['district_id']]);

        $City_corporation = TableRegistry::get('CityCorporations')->find();
        $City_corporation->where(['citycorporationid' => $application['applicant']['city_corporation_id'], 'zillaid' => $application['applicant']['district_id']]);

        $Union = TableRegistry::get('Unions')->find();
        $Union->where(['rowid' => $application['applicant']['union_ward']]);


        $Location_type = TableRegistry::get('LocationTypes')->find();
        $Location_type->where(['id' => $application['applicant']['location_type_id']]);

        $Applicant_type = TableRegistry::get('ApplicantTypes')->find();
        $Applicant_type->where(['id' => $application['applicant']['applicant_type_id']]);


        //  echo "<pre>";print_r($Applicant_type->toArray());die();


        $applications['area_division'] = $Area_division->first();
        $applications['area_district'] = $Area_district->first();
        $applications['area_upazila'] = $Area_upazila->first();
        $applications['municipal'] = $Municipal->toArray() ? $Municipal->toArray() : [];
        $applications['city_corporation'] = $City_corporation->toArray() ? $City_corporation->toArray() : [];
        $applications['union'] = $Union->toArray() ? $Union->toArray() : [];
        $applications['applicant_type'] = $Location_type->first();
        $applications['location_type'] = $Applicant_type->first();

        if ($this->request->is('post')) {
            $auth = $this->Auth->user();
            $inputs = $this->request->data;
            $data = [];
            //Backward,,,, make event for applicant
            if ($inputs['status'] == 1) {
                $data['recipient_id'] = $application->applicant->user_id;
            } else {
                $user_designation = TableRegistry::get('user_designations')->find()
                    ->where(['user_id' => $auth['id'], 'is_basic' => 1])
                    ->first();

                $recipient_id = TableRegistry::get('user_designations')->find()
                    ->where(['designation_id' => $user_designation['designation_id'] - 1, 'is_basic' => 1])
                    ->first();

                $data['recipient_id'] = $recipient_id->user_id;
            }
            $data['comment'] = $inputs['comment'];
            $data['application_id'] = $id;
            $data['create_time'] = time();
            $data['status'] = 1;
            $data['create_by'] = $auth['id'];

            $application_event = $this->application_events->newEntity();

            $application_event = $this->application_events->patchEntity($application_event, $data);
            //echo "<pre>";print_r($application_event);die();
            if ($this->application_events->save($application_event)) {
                $this->Flash->success(__('The receive application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The receive application could not be saved. Please, try again.'));
            }

            //    echo "<pre>";print_r($data);die();


            //This part was for update comment row in the application row.......

//            $receiveApplication = $this->Applications->patchEntity($application,['status'=>$inputs['status'],'comment'=>$inputs['comment'],'approve_time'=>strtotime($inputs['approve_time'])]);
//            if ($this->Applications->save($receiveApplication)) {
//                $this->Flash->success(__('The receive application has been saved.'));
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error(__('The receive application could not be saved. Please, try again.'));
//            }
        }
        $application_events = TableRegistry::get('application_events')->find()
            ->select(['comment' => 'application_events.comment',
                'create_time' => 'application_events.create_time',
                'full_name_bn' => 'users.full_name_bn',
                'designations' => 'designations.name_bn'])
            ->where(['application_id' => $id])
            ->leftJoin('users', 'users.id=application_events.create_by')
            ->leftJoin('user_designations', 'user_designations.user_id=users.id')
            ->where(['user_designations.is_basic' => 1])
            ->leftJoin('designations', 'designations.id=user_designations.designation_id')
            ->toArray();
        $this->set(compact('applications', 'application_events'));

        //  echo "<pre>";print_r($application_events->toArray());die();
        $this->set('_serialize', ['application']);
    }

    /*
     * pdf view
     */
    public function pdfView($id)
    {
        $this->loadModel('Applications');
        $application = $this->Applications->get($id, [
            'contain' => [
                'Applicants',
                'ApplicationTypes',
                'ApplicationsFiles'
            ]
        ]);

        $applications = $application->toArray();;

        $Area_division = TableRegistry::get('AreaDivisions')->find();
        $Area_division->where(['divid' => $application['applicant']['division_id']]);

        $Area_district = TableRegistry::get('AreaDistricts')->find();
        $Area_district->where(['zillaid' => $application['applicant']['district_id']]);

        $Area_upazila = TableRegistry::get('AreaUpazilas')->find();
        $Area_upazila->where(['zillaid' => $application['applicant']['district_id'], 'upazilaid' => $application['applicant']['upazila_id']]);

        $Municipal = TableRegistry::get('Municipals')->find();
        $Municipal->where(['municipalid' => $application['applicant']['municipal_id'], 'zillaid' => $application['applicant']['district_id']]);

        $City_corporation = TableRegistry::get('CityCorporations')->find();
        $City_corporation->where(['citycorporationid' => $application['applicant']['city_corporation_id'], 'zillaid' => $application['applicant']['district_id']]);

        $Union = TableRegistry::get('Unions')->find();
        $Union->where(['rowid' => $application['applicant']['union_ward']]);


        $Applicant_type = TableRegistry::get('ApplicantTypes')->find();
        $Applicant_type->where(['id' => $application['applicant']['applicant_type_id']]);


        //  echo "<pre>";print_r($Applicant_type->toArray());die();


        $applications['area_division'] = $Area_division->first();
        $applications['area_district'] = $Area_district->first();
        $applications['area_upazila'] = $Area_upazila->first();
        $applications['municipal'] = $Municipal->toArray() ? $Municipal->toArray() : [];
        $applications['city_corporation'] = $City_corporation->toArray() ? $City_corporation->toArray() : [];
        $applications['union'] = $Union->toArray() ? $Union->toArray() : [];
        $applications['applicant_type'] = $Applicant_type->first();
        //generating the pdf
        Configure::write('CakePdf', [
            'engine' => [
                //            'className'=>'CakePdf.Mpdf',
                'className' => 'CakePdf.WkHtmlToPdf',
                'binary' => '/usr/bin/wkhtmltopdf',
                'options' => [
                    'print-media-type' => false,
                    'outline' => true,
                    'dpi' => 96
                ],
            ]
        ]);
        $this->RequestHandler->renderAs($this, 'pdf');
        $this->request->env('HTTP_ACCEPT', 'application/pdf');
        $this->set(compact('applications'));
        $this->set('_serialize', ['application']);
    }

    public function pdfViewApplication($id)
    {
        $this->loadModel('Applications');
        $application = $this->Applications->get($id, [
            'contain' => [
                'Applicants',
                'ApplicationTypes',
                'ApplicationsFiles'
            ]
        ]);

        $applications = $application->toArray();;

        $Location_type = TableRegistry::get('LocationTypes')->find();
        $Location_type->where(['id' => $application['applicant']['location_type_id']]);


        $Area_division = TableRegistry::get('AreaDivisions')->find();
        $Area_division->where(['divid' => $application['applicant']['division_id']]);

        $Area_district = TableRegistry::get('AreaDistricts')->find();
        $Area_district->where(['zillaid' => $application['applicant']['district_id']]);

        $Area_upazila = TableRegistry::get('AreaUpazilas')->find();
        $Area_upazila->where(['zillaid' => $application['applicant']['district_id'], 'upazilaid' => $application['applicant']['upazila_id']]);

        $Municipal = TableRegistry::get('Municipals')->find();
        $Municipal->where(['municipalid' => $application['applicant']['municipal_id'], 'zillaid' => $application['applicant']['district_id']]);

        $City_corporation = TableRegistry::get('CityCorporations')->find();
        $City_corporation->where(['citycorporationid' => $application['applicant']['city_corporation_id'], 'zillaid' => $application['applicant']['district_id']]);

        $Union = TableRegistry::get('Unions')->find();
        $Union->where(['rowid' => $application['applicant']['union_ward']]);


        $Applicant_type = TableRegistry::get('ApplicantTypes')->find();
        $Applicant_type->where(['id' => $application['applicant']['applicant_type_id']]);


        //  echo "<pre>";print_r($Applicant_type->toArray());die();


        $applications['location_type'] = $Location_type->first();
        $applications['area_division'] = $Area_division->first();
        $applications['area_district'] = $Area_district->first();
        $applications['area_upazila'] = $Area_upazila->first();
        $applications['municipal'] = $Municipal->first() ? $Municipal->first() : [];
        $applications['city_corporation'] = $City_corporation->first() ? $City_corporation->first() : [];
        $applications['union'] = $Union->first() ? $Union->first() : [];
        $applications['applicant_type'] = $Applicant_type->first();
        //generating the pdf
        Configure::write('CakePdf', [
            'engine' => [
                'className' => 'CakePdf.WkHtmlToPdf',
                'binary' => '/usr/bin/wkhtmltopdf',
                'options' => [
                    'print-media-type' => false,
                    'outline' => true,
                    'dpi' => 96,
                ],
            ]
        ]);
        $this->RequestHandler->renderAs($this, 'pdf');
        $this->request->env('HTTP_ACCEPT', 'application/pdf');
        $this->set(compact('applications'));
        $this->set('_serialize', ['application']);
    }
    /*

    public function pdfViewApplication($id)
    {
        $this->loadModel('Applications');
        $application = $this->Applications->get($id, [
            'contain' => [
                'Applicants',
                'ApplicationTypes',
                'ApplicationsFiles'
            ]
        ]);
        //generating the pdf
        Configure::write('CakePdf', [
            'engine' => [
                'className' => 'CakePdf.WkHtmlToPdf',
               'binary' => '/usr/bin/wkhtmltopdf',
                'options' => [
                    'print-media-type' => false,
                    'outline' => true,
                    'dpi' => 96,
                ],
            ]
        ]);
        $this->RequestHandler->renderAs($this, 'pdf');
        $this->request->env('HTTP_ACCEPT', 'application/pdf');
        $this->set(compact('application'));
        $this->set('_serialize', ['application']);
    }
    */
}
