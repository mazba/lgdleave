<?php
namespace App\View\Cell;

use Cake\Collection\Collection;
use Cake\Core\Configure;
use Cake\Database\Query;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\View\Cell;

/**
 * Dashboard cell
 */
class DashboardCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function superAdmin()
    {
        $this->loadModel('Offices');
        $this->loadModel('Users');
        $this->loadModel('Applications');
        $this->loadModel('ApplicationTypes');
        $this->loadModel('LocationTypes');
        //count
        $application_number = $this->Applications->find('all')->where(['status'=>Configure::read('application_status.Pending')])->count();
        $district_council = $this->Applications->find('all')->where(['location_type_id'=>1,'status'=>Configure::read('application_status.Pending')])->count();
        $upazila_council = $this->Applications->find('all')->where(['location_type_id'=>2,'status'=>Configure::read('application_status.Pending')])->count();
        $city_council = $this->Applications->find('all')->where(['location_type_id'=>3,'status'=>Configure::read('application_status.Pending')])->count();
        $municipality_council = $this->Applications->find('all')->where(['location_type_id'=>5,'status'=>Configure::read('application_status.Pending')])->count();
        $union_council = $this->Applications->find('all')->where(['location_type_id'=>7,'status'=>Configure::read('application_status.Pending')])->count();
        //table data
        $this->loadModel('Applications');
        $new_applications = $this->Applications->find()
            ->select(
                [
                    'location_type'=>'LocationTypes.title_bn',
                    'area_district'=>'AreaDistricts.zillaname',
                    'area_division'=>'AreaDivisions.divname',
                    'applicant_type'=>'ApplicantTypes.title_bn',
                    'application_type'=>'ApplicationTypes.title_bn',
                    'applicant_name_bn'=>'Applications.applicant_name_bn',
                    'id'=>'Applications.id',
                    'temporary_id'=>'Applications.temporary_id',
                    'submission'=>"FROM_UNIXTIME(Applications.submission_time,'%D, %M, %Y')",
                ]
            )
            ->where(
                [
                    'Applications.status'=>Configure::read('application_status.Pending')
                ]
            )
            ->limit(10)
            ->contain(['ApplicationTypes','ApplicantTypes','LocationTypes','AreaDivisions','AreaDistricts','AreaUpazilas','CityCorporations','Municipals'])
            ->toArray();
        //for accepted application
        $this->loadModel('Applications');
        $new_approved_applications = $this->Applications->find()
            ->select(
                [
                    'location_type'=>'LocationTypes.title_bn',
                    'area_district'=>'AreaDistricts.zillaname',
                    'area_division'=>'AreaDivisions.divname',
                    'applicant_type'=>'ApplicantTypes.title_bn',
                    'application_type'=>'ApplicationTypes.title_bn',
                    'applicant_name_bn'=>'Applications.applicant_name_bn',
                    'id'=>'Applications.id',
                    'temporary_id'=>'Applications.temporary_id',
                    'submission'=>"FROM_UNIXTIME(Applications.submission_time,'%D, %M, %Y')",
                ]
            )
            ->where(
                [
                    'Applications.status'=>Configure::read('application_status.Approve')
                ]
            )
            ->limit(10)
            ->contain(['ApplicationTypes','ApplicantTypes','LocationTypes','AreaDivisions','AreaDistricts','AreaUpazilas','CityCorporations','Municipals'])
            ->toArray();
//        echo '<pre>';
//        print_r($new_applications);
//        echo '</pre>';
//        die;



        $this->set(compact(
            'application_number',
            'user_number',
            'pending_application_number',
            'approve_application_number',
            'reject_application_number',
            'new_approved_applications',
            'new_applications',
            'number_of_application_type',
            'district_council',
            'upazila_council',
            'city_council',
            'municipality_council',
            'union_council'
        ));
    }
    public function officeAdmin()
    {
        $user = $this->request->session()->read('Auth.User');
        $application_status = Configure::read('application_status');
        $this->loadModel('Offices');
        $this->loadModel('Users');
        $this->loadModel('Applications');
        $this->loadModel('ApplicationTypes');
        //find application type
        $usrUnits = TableRegistry::get('user_designations');
        $userUnits = $usrUnits->find()
            ->select(['office_unit_id'])
            ->where(['user_id'=>$user['id'],'is_basic IS'=>null]);
        $collection = new Collection($userUnits);
        $userUnits = $collection->extract('office_unit_id');
        $userUnits = $userUnits->toArray();

        $applicantType = TableRegistry::get('applicant_types_office_units');
        $applicantType = $applicantType->find()
            ->where(['office_unit_id IN'=>$userUnits]);
        $collection = new Collection($applicantType);
        $applicantType = $collection->extract('applicant_type_id');
        $applicantTypes = $applicantType->toArray();

//        //count
        $user_number = $this->Users->find('all')->where(['status'=>1])->count();
        $application_number = $this->Applications->find('all')->where(['Applications.applicant_type_id IN'=>$applicantTypes])->count();
        $pending_application_number = $this->Applications->find('all')->where(['status'=>$application_status['Pending'],'Applications.applicant_type_id IN'=>$applicantTypes])->count();
        $approve_application_number = $this->Applications->find('all')->where(['status'=>$application_status['Approve'],'Applications.applicant_type_id IN'=>$applicantTypes])->count();
        $reject_application_number = $this->Applications->find('all')->where(['status'=>$application_status['Reject'],'Applications.applicant_type_id IN'=>$applicantTypes])->count();
        $number_of_application_type = $this->ApplicationTypes->find('all')->where(['status'=>1])->count();

        //table data

        $this->loadModel('Applications');
        $new_applications = $this->Applications->find()
            ->select(
                [
                    'location_type'=>'LocationTypes.title_bn',
                    'area_district'=>'AreaDistricts.zillaname',
                    'area_division'=>'AreaDivisions.divname',
                    'applicant_type'=>'ApplicantTypes.title_bn',
                    'application_type'=>'ApplicationTypes.title_bn',
                    'applicant_name_bn'=>'Applications.applicant_name_bn',
                    'id'=>'Applications.id',
                    'temporary_id'=>'Applications.temporary_id',
                    'submission'=>"FROM_UNIXTIME(Applications.submission_time,'%D, %M, %Y')",
                ]
            )
            ->where(
                [
                    'Applications.status'=>Configure::read('application_status.Pending'),
                    'Applications.applicant_type_id IN'=>$applicantTypes
                ]
            )
            ->limit(10)
            ->contain(['ApplicationTypes','ApplicantTypes','LocationTypes','AreaDivisions','AreaDistricts','AreaUpazilas','CityCorporations','Municipals'])
            ->toArray();




        //for accepted application

        $new_approved_applications = $this->Applications->find()
            ->select(
                [
                    'location_type'=>'LocationTypes.title_bn',
                    'area_district'=>'AreaDistricts.zillaname',
                    'area_division'=>'AreaDivisions.divname',
                    'applicant_type'=>'ApplicantTypes.title_bn',
                    'application_type'=>'ApplicationTypes.title_bn',
                    'applicant_name_bn'=>'Applications.applicant_name_bn',
                    'id'=>'Applications.id',
                    'temporary_id'=>'Applications.temporary_id',
                    'submission'=>"FROM_UNIXTIME(Applications.submission_time,'%D, %M, %Y')",
                ]
            )
            ->where(
                [
                    'Applications.status'=>Configure::read('application_status.Approve'),
                    'Applications.applicant_type_id IN'=>$applicantTypes
                ]
            )
            ->limit(10)
            ->contain(['ApplicationTypes','ApplicantTypes','LocationTypes','AreaDivisions','AreaDistricts','AreaUpazilas','CityCorporations','Municipals'])
            ->toArray();
//        echo '<pre>';
//        print_r($new_applications);
//        echo '</pre>';
//        die;



        $this->set(compact(
            'application_number',
            'user_number',
            'pending_application_number',
            'approve_application_number',
            'reject_application_number',
            'new_approved_applications',
            'new_applications',
            'number_of_application_type'
        ));
    }
    public function officeUser()
    {

    }
}
