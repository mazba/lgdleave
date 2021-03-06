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
class ReportleaveController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->Auth->allow();
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



        if ($this->request->is('post')) {

            $input_data=$this->request->data;
            $location_type_id = $input_data['location_type_id'];
            $application_type_id = $input_data['application_type_id'];

            $divsion_id = isset($input_data['divsion_id'])?$input_data['divsion_id']:'';
            $district_id = isset($input_data['district_id'])?$input_data['district_id']:'';
            $upazila_id = isset($input_data['upazila_id'])?$input_data['upazila_id']:$input_data['upazila_id'];
            $city_corporation_id = isset($input_data['city_corporation_id'])?$input_data['city_corporation_id']:'';
            $city_corporation_ward_id = isset($input_data['city_corporation_ward_id'])?$input_data['city_corporation_ward_id']:'';
            $municipal_id = isset($input_data['municipal_id'])?$input_data['municipal_id']:'';
            $municipal_ward_id = isset($input_data['municipal_ward_id'])?$input_data['municipal_ward_id']:'';
            $union_id = isset($input_data['union_id'])?$input_data['union_id']:'';
            $union_ward =isset($input_data['union_ward'])?$input_data['union_ward']:'';
            $applicant_type_id = isset($input_data['applicant_type_id'])?$input_data['applicant_type_id']:'';
            $status = isset($input_data['status'])?$input_data['status']:'';
            $start_date = isset($input_data['from_date'])?strtotime($input_data['from_date']):'';
            $end_date = isset($input_data['to_date'])?strtotime($input_data['to_date']):'';


            $applicants = TableRegistry::get('applications')->find();

            $applicants->select(['applications.id','applications.applicant_id','applications.applicant_name_bn','applications.phone','applications.email','applications.application_type_id','applications.start_date','applications.end_date','applications.status']);
            $applicants->select(['applicants.id','applicants.applicant_type_id','applicants.location_type_id','applicants.division_id','applicants.district_id','applicants.upazila_id','applicants.union_id','applicants.union_ward','applicants.city_corporation_id','applicants.city_corporation_ward_id','applicants.municipal_id','applicants.municipal_ward_id']);
            $applicants->select(['location_types.id','location_types.title_bn']);
            $applicants->select(['application_types.id','application_types.title_bn']);


            if (!empty($application_type_id)) {
                $applicants->where(['application_type_id' => $application_type_id ]);
            }

            if (!empty($status)) {
                $applicants->where(['applications.status' => $status]);
            }

            if (!empty($start_date) && $start_date > 0) {
                $applicants->where(['start_date  >=' => $start_date]);
            }
            if (!empty($end_date) && $end_date > 0) {
                $applicants->where(['end_date  <=' => $end_date]);
            }

//

            if (!empty($applicant_type_id) ) {
                $applicants->where(['applicant_type_id' => $applicant_type_id]);
            }

            if (!empty($location_type_id) ) {
                $applicants->where(['location_type_id' => $location_type_id]);
            }

            if (!empty($divsion_id) ) {
                $applicants->where(['division_id' => $divsion_id]);
            }
            if (!empty($district_id) ) {
                $applicants->where(['district_id' => $district_id]);
            }
            if (!empty($upazila_id) ) {
                $applicants->where(['upazila_id' => $upazila_id]);
            }
            if (!empty($city_corporation_id) ) {
                $applicants->where(['city_corporation_id' => $city_corporation_id]);
            }
            if (!empty($city_corporation_ward_id) ) {
                $applicants->where(['city_corporation_ward_id' => $city_corporation_ward_id]);
            }
            if (!empty($municipal_id) ) {
                $applicants->where(['municipal_id' => $municipal_id]);
            }
            if (!empty($municipal_ward_id) ) {
                $applicants->where(['municipal_ward_id' => $municipal_ward_id]);
            }
            if (!empty($union_id) ) {
                $applicants->where(['union_id' => $union_id]);
            }
            if (!empty($union_ward) ) {
                $applicants->where(['union_ward' => $union_ward]);
            }

            $applicants->leftJoin('applicants', 'applicants.id=applications.applicant_id');
            $applicants->leftJoin('location_types', 'location_types.id=applicants.location_type_id');
            $applicants->leftJoin('application_types', 'application_types.id=applications.application_type_id');

          //  echo "<pre>";print_r($applicants->toArray());die();
            $reportData =$applicants->toArray();


        //echo "<pre>";print_r($reportData);die();




            //   echo "<pre/>"; print_r($reportData);die();
            $this->set('reportData', $reportData);
            $this->set('_serialize', ['reportData']);
        }

        $applicationTypes =  $this->ApplicationTypes->find('list', ['conditions'=>['status'=>1]]);
        $locationTypes = $this->LocationTypes->find('list', ['conditions' => ['status' => 1]]);
        $divisions = $this->AreaDivisions->find('list');

        $this->set(compact('locationTypes', 'applicationTypes','divisions'));

    }

    public function ajax($action = null)
    {
        if ($action == 'get_applicantTypes') {

            $location_type_id = $this->request->data('location_type_id');
            $this->loadModel('ApplicantTypes');
            $application_types = $this->ApplicantTypes->find('list')
                ->where(['type' => $location_type_id,'status'=>1])
                ->toArray();
            $this->response->body(json_encode($application_types));
            return $this->response;
        }

        elseif ($action == 'get_districts') {

            $division_id = $this->request->data('division_id');
            $this->loadModel('AreaDistricts');
            $districts = $this->AreaDistricts->find('list',['keyField' => 'zillaid', 'keyValue' => 'zillaname'])
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


}
