<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;


/**
 * Applications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 */
class ApplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $user = $this->Auth->user();

        $new_applications = TableRegistry::get('application_events')->find();

        $new_applications->select(['location_type' => 'location_types.title_bn',
            'area_district' => 'zillas.zillaname',
            'area_division' => 'divisions.divname',
            'applicant_type' => 'applicant_types.title_bn',
            'application_type' => 'application_types.title_bn',
            'applicant_name_bn' => 'applications.applicant_name_bn',
            'applications_id' => 'applications.id',
            'temporary_id' => 'applications.temporary_id',
            'submission' => "FROM_UNIXTIME(applications.submission_time,'%D, %M, %Y')",
        ])
            ->select(['applications.id', 'applications.applicant_id', 'applications.applicant_name_bn', 'applications.phone', 'applications.email', 'applications.application_type_id', 'applications.start_date', 'applications.end_date', 'applications.status'])
            ->select(['applicants.id', 'applicants.applicant_type_id', 'applicants.location_type_id', 'applicants.division_id', 'applicants.district_id', 'applicants.upazila_id', 'applicants.union_id', 'applicants.union_ward', 'applicants.city_corporation_id', 'applicants.city_corporation_ward_id', 'applicants.municipal_id', 'applicants.municipal_ward_id'])
            ->select(['location_types.id', 'location_types.title_bn'])
            ->select(['application_types.id', 'application_types.title_bn'])
            ->where(['application_events.recipient_id' => $user['id']])
            ->leftJoin('applications', 'applications.id=application_events.application_id')
            ->leftJoin('applicants', 'applicants.id=applications.applicant_id')
            ->leftJoin('location_types', 'location_types.id=applicants.location_type_id')
            ->leftJoin('application_types', 'application_types.id=applications.application_type_id')
            ->leftJoin('divisions', 'divisions.divid=applicants.division_id')
            ->leftJoin('zillas', 'zillas.zillaid=applicants.district_id')
            ->leftJoin('applicant_types', 'applicant_types.id=applicants.applicant_type_id')
            ->where(['applications.status' => Configure::read('application_status.Pending')]);


        //   echo "<pre>";print_r($new_applications->toArray());die();

        $this->set(compact('new_applications'));
        $this->set('_serialize', ['new_applications']);
    }

    /**
     * View method
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['ApplicationTypes', 'Applicants', 'ApplicationsFiles', 'ApplicationEvents']
        ]);

        $this->set('application', $application);
        $this->set('_serialize', ['application']);
    }


    public function receive($id)
    {
        $this->loadModel('Applications');
        $this->loadModel('application_events');
        $this->loadModel('user_designations');
        $auth = $this->Auth->user();

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
//        echo "<pre>";
//        print_r($application);
//        die();

        if ($this->request->is('post')) {
            $inputs = $this->request->data;
            $data = [];
            //if approve
            if ($inputs['status'] == 3) {
                $applications = TableRegistry::get('Applications');

                $data['status'] = 1;
                $data['comment'] = $inputs['comment'];
                $data['approve_time'] = time();
                $query = $applications->query();

                if ($query->update()
                    ->set($data)
                    ->where(['id' => $id])
                    ->execute()
                ) {
                    $this->Flash->success(__('This application has been approve.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('This application could not be approve. Please, try again.'));
                }
            } //Backward,,,, make event for applicant
            elseif ($inputs['status'] == 1) {
                $user_designation = TableRegistry::get('user_designations')->find()
                    ->where(['user_id' => $auth['id'], 'is_basic' => 1])
                    ->first();

                $recipient_id = TableRegistry::get('user_designations')->find()
                    ->where(['designation_id' => $user_designation['designation_id'] + 1, 'is_basic' => 1])
                    ->first();

                $data['recipient_id'] = $recipient_id->user_id;
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
            //    echo "<pre>";print_r($application_event);die();
            if ($this->application_events->save($application_event)) {
                $this->Flash->success(__('The receive application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The receive application could not be saved. Please, try again.'));
            }

        }
        $user_designation = TableRegistry::get('user_designations')->find()
            ->where(['user_id' => $auth['id'], 'is_basic' => 1, 'designation_id' => 1])
            ->first();


        $application_events = TableRegistry::get('application_events')->find()
            ->select(['comment'=>'application_events.comment',
                'create_time'=>'application_events.create_time',
                'full_name_bn'=>'users.full_name_bn',
                'designations'=>'designations.name_bn'])
            ->where(['application_id' => $id])
            ->leftJoin('users', 'users.id=application_events.create_by')
            ->leftJoin('user_designations', 'user_designations.user_id=users.id')
            ->where(['user_designations.is_basic' => 1])
            ->leftJoin('designations', 'designations.id=user_designations.designation_id');



      //  echo "<pre>";print_r($application_events->toArray());die();
        $this->set(compact('applications', 'user_designation','application_events'));
        $this->set('_serialize', ['application']);
    }
}
