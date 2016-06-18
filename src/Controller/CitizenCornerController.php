<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Phinx\Config\Config;

/**
 * CitizenCorner Controller
 *
 * @property \App\Model\Table\CitizenCornerTable $CitizenCorner
 */
class CitizenCornerController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
       // $this->Auth->allow();
        $this->loadComponent('FileUpload');
        $this->loadComponent('RequestHandler');

    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadModel('LocationTypes');
        $this->loadModel('AreaDivisions');
        $this->loadModel('Applications');
        $this->loadModel('ApplicationTypes');
        $this->loadModel('ApplicationsFiles');

        $time = time();

        $applications = $this->Applications->newEntity();
        $applcationFile = $this->ApplicationsFiles->newEntity();
        $auth = $this->Auth->user();

        $applicant = TableRegistry::get('applicants')->find()
            ->where(['user_id' => $auth['id']]);
        $applicant_id=$applicant->toArray();


        //  echo "<pre>";print_r($auth);die();
        if ($this->request->is('post')) {

            try {

                $data = $this->request->data;
                $conn = ConnectionManager::get('default');
                $conn->transactional(function () use ($data, $applications, $time,$auth,$applicant_id) {
                    $data['applicant_id']= $applicant_id['id'];
                    $data['create_time'] = $time;
                    $data['submission_time'] = $time;
                    $data['temporary_id'] = $this->findMax()+1;


                    $data['status'] = Configure::read('application_status.Pending');
                    $data['start_date'] = strtotime($data['start_date']);
                    $data['end_date'] = strtotime($data['end_date']);
                    $data['last_foreign_tour_time'] = $data['last_foreign_tour_time'] ? strtotime($data['last_foreign_tour_time']) : 0;
                    $data['applicant_using_passport_validity'] = $data['applicant_using_passport_validity'] ? strtotime($data['applicant_using_passport_validity']) : 0;
                    $files = $data['document_file'];
                    $files_label = $data['file_label'];
                    unset($data['document_file']);
                    unset($data['file_label']);
                    $applications = $this->Applications->patchEntity($applications, $data);

//                    echo"<pre/>";
//                 print_r($applications); die();

                    if ($this->Applications->save($applications)) {
                        //
                        $fileTable = TableRegistry::get('applications_files');

                        if (is_array($files)) {
                            $i = 0;
                            foreach ($files as $file) {
                                $result = $this->FileUpload->upload_file($file, 'u_load/application_file', ['jpg', 'jpeg', 'png', 'doc', 'pdf', 'xls', 'xlsx']);
                                if ($result['status'] === true) {
                                    $fileEntity = $fileTable->newEntity();
                                    $fileEntity->file_label = $files_label[$i];
                                    $fileEntity->file = $result['file_path'];
                                    $fileEntity->application_id = $applications['id'];
                                    $fileTable->save($fileEntity);
                                    $i++;
                                } else {
                                    throw new Exception('error');
                                }
                            }
                        } else {
                            $result = $this->FileUpload->upload_file($files, 'u_load/application_file', ['jpg', 'png']);
                            if ($result['status'] === true) {
                                $fileEntity = $fileTable->newEntity();
                                $fileEntity->file_label = $files_label['0'];
                                $fileEntity->file = $result['file_path'];
                                $fileEntity->application_id = $applications['id'];
                                $fileTable->save($fileEntity);
                            } else {
                                throw new Exception('error');
                            }
                        }
                    } else {
                        throw  new Exception('error');
                    }
                });
                $this->Flash->success(__('The citizen corner has been saved.'));
                return $this->redirect(['action' => 'success', $applications['id']]);

            } catch (\Exception $e) {
                $this->Flash->error(__('The citizen corner could not be saved. Please, try again.'));
            }
        }


        // $applicantTypes = $this->ApplicantTypes->find('list', ['conditions' => ['status' => 1]]);
        $applicationTypes = $this->ApplicationTypes->find('list', ['conditions' => ['status' => 1]]);
        $locationTypes = $this->LocationTypes->find('list', ['conditions' => ['status' => 1]]);
        $divisions = $this->AreaDivisions->find('list');

        $this->set(compact('locationTypes', 'applicationTypes', 'divisions', 'applications'));
      //  $this->viewBuilder()->layout('citizen_corner');
        $this->set('_serialize', ['applications']);
    }

    public function success($id)
    {

        $this->loadModel('Applications');
        $application = $this->Applications->get($id, [
            'contain' => [
               'Applicants',
                'ApplicationTypes',
                'ApplicationsFiles'
            ]
        ]);
//echo "<pre>";print_r($application);die();
    $applications=  $application->toArray();;

        $Area_division = TableRegistry::get('AreaDivisions')->find();
        $Area_division->where(['divid'=>$application['applicant']['division_id']]);

        $Area_district = TableRegistry::get('AreaDistricts')->find();
        $Area_district->where(['zillaid'=>$application['applicant']['district_id']]);

        $Area_upazila = TableRegistry::get('AreaUpazilas')->find();
        $Area_upazila->where(['zillaid'=>$application['applicant']['district_id'],'upazilaid'=>$application['applicant']['upazila_id']]);

        $Municipal = TableRegistry::get('Municipals')->find();
        $Municipal->where(['municipalid'=>$application['applicant']['municipal_id'],'zillaid'=>$application['applicant']['district_id']]);

        $City_corporation = TableRegistry::get('CityCorporations')->find();
        $City_corporation->where(['citycorporationid'=>$application['applicant']['city_corporation_id'],'zillaid'=>$application['applicant']['district_id']]);

        $Union = TableRegistry::get('Unions')->find();
        $Union->where(['rowid'=>$application['applicant']['union_ward']]);


        $Applicant_type = TableRegistry::get('ApplicantTypes')->find();
        $Applicant_type->where(['id'=>$application['applicant']['applicant_type_id']]);


         //  echo "<pre>";print_r($Applicant_type->toArray());die();


        $applications['area_division']= $Area_division->first();
        $applications['area_district']= $Area_district->first();
        $applications['area_upazila']= $Area_upazila->first();
        $applications['municipal']= $Municipal->toArray()? $Municipal->toArray():[];
        $applications['city_corporation']= $City_corporation->toArray()? $City_corporation->toArray():[];
        $applications['union']= $Union->toArray()? $Union->toArray():[];
        $applications['applicant_type']= $Applicant_type->first();
      //  echo "<pre>";print_r($applications);die();

        $this->set(compact('applications'));
      //  $this->viewBuilder()->layout('citizen_corner');

        //  $this->set('_serialize', ['application']);
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

        $applications=  $application->toArray();;

        $Area_division = TableRegistry::get('AreaDivisions')->find();
        $Area_division->where(['divid'=>$application['applicant']['division_id']]);

        $Area_district = TableRegistry::get('AreaDistricts')->find();
        $Area_district->where(['zillaid'=>$application['applicant']['district_id']]);

        $Area_upazila = TableRegistry::get('AreaUpazilas')->find();
        $Area_upazila->where(['zillaid'=>$application['applicant']['district_id'],'upazilaid'=>$application['applicant']['upazila_id']]);

        $Municipal = TableRegistry::get('Municipals')->find();
        $Municipal->where(['municipalid'=>$application['applicant']['municipal_id'],'zillaid'=>$application['applicant']['district_id']]);

        $City_corporation = TableRegistry::get('CityCorporations')->find();
        $City_corporation->where(['citycorporationid'=>$application['applicant']['city_corporation_id'],'zillaid'=>$application['applicant']['district_id']]);

        $Union = TableRegistry::get('Unions')->find();
        $Union->where(['rowid'=>$application['applicant']['union_ward']]);


        $Applicant_type = TableRegistry::get('ApplicantTypes')->find();
        $Applicant_type->where(['id'=>$application['applicant']['applicant_type_id']]);


        //  echo "<pre>";print_r($Applicant_type->toArray());die();


        $applications['area_division']= $Area_division->first();
        $applications['area_district']= $Area_district->first();
        $applications['area_upazila']= $Area_upazila->first();
        $applications['municipal']= $Municipal->toArray()? $Municipal->toArray():[];
        $applications['city_corporation']= $City_corporation->toArray()? $City_corporation->toArray():[];
        $applications['union']= $Union->toArray()? $Union->toArray():[];
        $applications['applicant_type']= $Applicant_type->first();

        //generating the pdf
        Configure::write('CakePdf', [
            'engine' => [
                'className' => 'CakePdf.WkHtmlToPdf',
                'binary' => 'C:\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
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

        $applications=  $application->toArray();;

        $Location_type = TableRegistry::get('LocationTypes')->find();
        $Location_type->where(['id'=>$application['applicant']['location_type_id']]);


        $Area_division = TableRegistry::get('AreaDivisions')->find();
        $Area_division->where(['divid'=>$application['applicant']['division_id']]);

        $Area_district = TableRegistry::get('AreaDistricts')->find();
        $Area_district->where(['zillaid'=>$application['applicant']['district_id']]);

        $Area_upazila = TableRegistry::get('AreaUpazilas')->find();
        $Area_upazila->where(['zillaid'=>$application['applicant']['district_id'],'upazilaid'=>$application['applicant']['upazila_id']]);

        $Municipal = TableRegistry::get('Municipals')->find();
        $Municipal->where(['municipalid'=>$application['applicant']['municipal_id'],'zillaid'=>$application['applicant']['district_id']]);

        $City_corporation = TableRegistry::get('CityCorporations')->find();
        $City_corporation->where(['citycorporationid'=>$application['applicant']['city_corporation_id'],'zillaid'=>$application['applicant']['district_id']]);

        $Union = TableRegistry::get('Unions')->find();
        $Union->where(['rowid'=>$application['applicant']['union_ward']]);


        $Applicant_type = TableRegistry::get('ApplicantTypes')->find();
        $Applicant_type->where(['id'=>$application['applicant']['applicant_type_id']]);


        //  echo "<pre>";print_r($Applicant_type->toArray());die();


        $applications['location_type']= $Location_type->first();
        $applications['area_division']= $Area_division->first();
        $applications['area_district']= $Area_district->first();
        $applications['area_upazila']= $Area_upazila->first();
        $applications['municipal']= $Municipal->toArray()? $Municipal->toArray():[];
        $applications['city_corporation']= $City_corporation->toArray()? $City_corporation->toArray():[];
        $applications['union']= $Union->toArray()? $Union->toArray():[];
        $applications['applicant_type']= $Applicant_type->first();
        //generating the pdf
        Configure::write('CakePdf', [
            'engine' => [
                'className' => 'CakePdf.WkHtmlToPdf',
                'binary' => 'C:\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
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

    public function ajax($action = null)
    {
        if ($action == 'get_applicantTypes') {

            $location_type_id = $this->request->data('location_type_id');
            $this->loadModel('ApplicantTypes');
            $application_types = $this->ApplicantTypes->find('list')
                ->where(['type' => $location_type_id, 'status' => 1])
                ->toArray();
            $this->response->body(json_encode($application_types));
            return $this->response;
        } elseif ($action == 'get_districts') {

            $division_id = $this->request->data('division_id');
            $this->loadModel('AreaDistricts');
            $districts = $this->AreaDistricts->find('list', ['keyField' => 'zillaid', 'keyValue' => 'zillaname'])
                ->where(['divid' => $division_id])
                ->toArray();
            $this->response->body(json_encode($districts));
            return $this->response;

        } elseif ($action == 'get_upazilas') {
            $district_id = $this->request->data('district_id');
            $this->loadModel('AreaUpazilas');
            $upazilas = $this->AreaUpazilas->find('list', ['keyField' => 'upazilaid', 'keyValue' => 'upazilaname'])
                ->where(['zillaid' => $district_id])
                ->toArray();

            $this->response->body(json_encode($upazilas));
            return $this->response;
        } elseif ($action == 'get_city_corporations') {
            $district_id = $this->request->data('district_id');
            $this->loadModel('CityCorporations');
            $cityCorporations = $this->CityCorporations->find('list', ['keyField' => 'citycorporationid', 'keyValue' => 'citycorporationname'])
                ->where(['zillaid' => $district_id])
                ->toArray();

            $this->response->body(json_encode($cityCorporations));
            return $this->response;

        } elseif ($action == 'get_municipals') {
            $district_id = $this->request->data('district_id');
            $this->loadModel('Municipals');
            $municipals = $this->Municipals->find('list', ['keyField' => 'municipalid', 'keyValue' => 'municipalname'])
                ->where(['zillaid' => $district_id])
                ->toArray();

            $this->response->body(json_encode($municipals));
            return $this->response;
        } elseif ($action == 'get_unions') {
            $district_id = $this->request->data('district_id');
            $upazila_id = $this->request->data('upazila_id');

            $this->loadModel('Unions');
            $unions = $this->Unions->find('list', ['conditions' => ['upazilaid' => $upazila_id, 'zillaid' => $district_id]])->toArray();

            $this->response->body(json_encode($unions));
            return $this->response;
        } elseif ($action == 'get_city_corporation_wards') {
            $district_id = $this->request->data('district_id');
            $city_corporation_id = $this->request->data('city_corporation_id');

            $this->loadModel('CityCorporationWards');

            $cityCorporationWards = $this->CityCorporationWards->find('list', ['keyField' => 'citycorporationwardid', 'keyValue' => 'wardname'])
                ->where(['zillaid' => $district_id, 'citycorporationid' => $city_corporation_id])
                ->toArray();


            $this->response->body(json_encode($cityCorporationWards));
            return $this->response;
        } elseif ($action == 'get_municipal_wards') {
            $district_id = $this->request->data('district_id');
            $municipal_id = $this->request->data('municipal_id');

            $this->loadModel('MunicipalWards');

            $municipalWards = $this->MunicipalWards->find('list', ['keyField' => 'wardid', 'keyValue' => 'wardname'])
                ->where(['zillaid' => $district_id, 'municipalid' => $municipal_id])
                ->toArray();

            $this->response->body(json_encode($municipalWards));
            return $this->response;
        }
    }
    public function findMax(){
        $this->loadModel('Applications');

        $query = $this->Applications->find()
            ->toArray();
        $max= 0;
        foreach($query as $max_temporary_id){
            if($max <$max_temporary_id['temporary_id']){
                $max= $max_temporary_id['temporary_id'];
            }
        }
        if($max ==0){
            $max=1000;
        }
       return $max;
    }
}
