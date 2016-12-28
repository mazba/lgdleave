<?php
namespace App\View\Cell;

use Cake\Collection\Collection;
use Cake\Core\Configure;
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
        $application_number = $this->Applications->find('all')->where(['status' => Configure::read('application_status.Pending')])->count();
        $district_council = $this->Applications->find('all')
            ->where(['applicants.location_type_id' => 1, 'Applications.status' => Configure::read('application_status.Pending')])
            ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $upazila_council = $this->Applications->find('all')
            ->where(['applicants.location_type_id' => 2, 'Applications.status' => Configure::read('application_status.Pending')])
            ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $city_council = $this->Applications->find('all')
            ->where(['applicants.location_type_id' => 3, 'Applications.status' => Configure::read('application_status.Pending')])
            ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $municipality_council = $this->Applications->find('all')
            ->where(['applicants.location_type_id' => 5, 'Applications.status' => Configure::read('application_status.Pending')])
            ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $union_council = $this->Applications->find('all')
            ->where(['applicants.location_type_id' => 7, 'Applications.status' => Configure::read('application_status.Pending')])
            ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        //table data

        $new_applications = TableRegistry::get('applications')->find();

        $new_applications->select([
            'applicant_type' => 'applicant_types.title_bn',
            'applicant_name_bn' => 'applications.applicant_name_bn',
            'id' => 'applications.id',
            'temporary_id' => 'applications.temporary_id',
            'submission' => "FROM_UNIXTIME(applications.submission_time,'%D, %M, %Y')",
        ]);
        $new_applications->select(['applications.id', 'applications.applicant_id', 'applications.applicant_name_bn', 'applications.phone', 'applications.email', 'applications.application_type_id', 'applications.start_date', 'applications.end_date', 'applications.status']);
        $new_applications->select(['applicants.id', 'applicants.applicant_type_id', 'applicants.location_type_id', 'applicants.division_id', 'applicants.district_id', 'applicants.upazila_id', 'applicants.union_id', 'applicants.union_ward', 'applicants.city_corporation_id', 'applicants.city_corporation_ward_id', 'applicants.municipal_id', 'applicants.municipal_ward_id']);
        $new_applications->where(['applications.status' => Configure::read('application_status.Pending')]);

        $new_applications->leftJoin('applicants', 'applicants.id=applications.applicant_id');
        $new_applications->leftJoin('applicant_types', 'applicant_types.id=applicants.applicant_type_id');
        $new_applications->order(['applications.id' => 'DESC']);
        $new_applications->limit(10);
        $new_applications->toArray();


        //for accepted application
        $new_approved_applications = TableRegistry::get('applications')->find();

        $new_approved_applications->select([
            'applicant_type' => 'applicant_types.title_bn',
            'applicant_name_bn' => 'applications.applicant_name_bn',
            'id' => 'applications.id',
            'temporary_id' => 'applications.temporary_id',
            'approved_time' => "FROM_UNIXTIME(applications.approve_time,'%D, %M, %Y')",
        ]);
        $new_approved_applications->select(['applications.id', 'applications.applicant_id', 'applications.applicant_name_bn', 'applications.phone', 'applications.email', 'applications.application_type_id', 'applications.start_date', 'applications.end_date', 'applications.status']);
        $new_approved_applications->select(['applicants.id', 'applicants.applicant_type_id', 'applicants.location_type_id', 'applicants.division_id', 'applicants.district_id', 'applicants.upazila_id', 'applicants.union_id', 'applicants.union_ward', 'applicants.city_corporation_id', 'applicants.city_corporation_ward_id', 'applicants.municipal_id', 'applicants.municipal_ward_id']);
        $new_approved_applications->where(['applications.status' => Configure::read('application_status.Approve')]);

        $new_approved_applications->leftJoin('applicants', 'applicants.id=applications.applicant_id');
        $new_approved_applications->leftJoin('applicant_types', 'applicant_types.id=applicants.applicant_type_id');
        $new_approved_applications->order(['applications.id' => 'DESC']);
        $new_approved_applications->limit(10);
        $new_approved_applications->toArray();


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
        $this->loadModel('Applicants');
        //find application type
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

//        //count
        $user_number = $this->Applicants->find('all')->where(['status' => 1,'applicant_type_id IN' => $applicantTypes])->count();
        $application_number = $this->Applications->find('all')
            ->where(['applicants.applicant_type_id IN' => $applicantTypes])
            ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $pending_application_number = $this->Applications->find('all')
            ->where(['Applications.status' => $application_status['Pending'], 'applicants.applicant_type_id IN' => $applicantTypes])
            ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $approve_application_number = $this->Applications->find('all')
            ->where(['Applications.status' => $application_status['Approve'], 'applicants.applicant_type_id IN' => $applicantTypes])
            ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $reject_application_number = $this->Applications->find('all')
            ->where(['Applications.status' => $application_status['Reject'], 'applicants.applicant_type_id IN' => $applicantTypes])
            ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $number_of_application_type = $this->ApplicationTypes->find('all')->where(['status' => 1])->count();

//        //table data
        $new_applications = TableRegistry::get('applications')->find();

        $new_applications->select([
            'applicant_type' => 'applicant_types.title_bn',
            'applicant_name_bn' => 'applications.applicant_name_bn',
            'id' => 'applications.id',
            'temporary_id' => 'applications.temporary_id',
            'submission' => "FROM_UNIXTIME(applications.submission_time,'%D, %M, %Y')",
        ]);
        $new_applications->select(['applications.id', 'applications.applicant_id', 'applications.applicant_name_bn', 'applications.phone', 'applications.email', 'applications.application_type_id', 'applications.start_date', 'applications.end_date', 'applications.status']);
        $new_applications->select(['applicants.id', 'applicants.applicant_type_id', 'applicants.location_type_id', 'applicants.division_id', 'applicants.district_id', 'applicants.upazila_id', 'applicants.union_id', 'applicants.union_ward', 'applicants.city_corporation_id', 'applicants.city_corporation_ward_id', 'applicants.municipal_id', 'applicants.municipal_ward_id']);
        $new_applications->where([
            'applications.status' => Configure::read('application_status.Pending'),
            'applicants.applicant_type_id IN' => $applicantTypes
        ]);

        $new_applications->leftJoin('applicants', 'applicants.id=applications.applicant_id');
        $new_applications->leftJoin('applicant_types', 'applicant_types.id=applicants.applicant_type_id');
        $new_applications->order(['applications.id' => 'DESC']);
        $new_applications->limit(10);
        $new_application = $new_applications->toArray();


//        //for accepted application
        $new_approved_application = TableRegistry::get('applications')->find();

        $new_approved_application->select([
            'applicant_type' => 'applicant_types.title_bn',
            'applicant_name_bn' => 'applications.applicant_name_bn',
            'id' => 'applications.id',
            'temporary_id' => 'applications.temporary_id',
            'approve_time' => "FROM_UNIXTIME(applications.approve_time,'%D, %M, %Y')",
        ]);
        $new_approved_application->select(['applications.id', 'applications.applicant_id', 'applications.applicant_name_bn', 'applications.phone', 'applications.email', 'applications.application_type_id', 'applications.start_date', 'applications.end_date', 'applications.status']);
        $new_approved_application->select(['applicants.id', 'applicants.applicant_type_id', 'applicants.location_type_id', 'applicants.division_id', 'applicants.district_id', 'applicants.upazila_id', 'applicants.union_id', 'applicants.union_ward', 'applicants.city_corporation_id', 'applicants.city_corporation_ward_id', 'applicants.municipal_id', 'applicants.municipal_ward_id']);
        $new_approved_application->where([
            'applications.status' => Configure::read('application_status.Approve'),
            'applicants.applicant_type_id IN' => $applicantTypes
        ]);

        $new_approved_application->leftJoin('applicants', 'applicants.id=applications.applicant_id');
        $new_approved_application->leftJoin('applicant_types', 'applicant_types.id=applicants.applicant_type_id');
        $new_approved_application->order(['applications.id' => 'DESC']);
        $new_approved_application->limit(10);
        $new_approved_applications = $new_approved_application->toArray();


        $this->set(compact(
            'application_number',
            'user_number',
            'pending_application_number',
            'approve_application_number',
            'reject_application_number',
            'new_approved_applications',
            'new_application',
            'number_of_application_type'
        ));
    }

    public function applicantUser()
    {
        $user = $this->request->session()->read('Auth.User');
        $application_status = Configure::read('application_status');
        $this->loadModel('Offices');
        $this->loadModel('Users');
        $this->loadModel('Applications');
        $this->loadModel('ApplicationTypes');

//
////        //count
        $application_number = $this->Applications->find('all')
            ->where(['Applications.create_by IN' => $user['id']])
           // ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            // ->innerJoin('users', 'users.id=applicants.user_id')
            ->count();
        $pending_application_number = $this->Applications->find('all')
            ->where(['Applications.status' => $application_status['Pending'], 'Applications.create_by IN' => $user['id']])
          //  ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $approve_application_number = $this->Applications->find('all')
            ->where(['Applications.status' => $application_status['Approve'], 'Applications.create_by IN' => $user['id']])
           // ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
        $reject_application_number = $this->Applications->find('all')
            ->where(['Applications.status' => $application_status['Reject'], 'Applications.create_by IN' => $user['id']])
        //    ->innerJoin('applicants', 'applicants.id=Applications.applicant_id')
            ->count();
//
////        //table data
        $new_applications = TableRegistry::get('applications')->find();

        $new_applications->select([
            'applicant_type' => 'applicant_types.title_bn',
            'applicant_name_bn' => 'applications.applicant_name_bn',
            'id' => 'applications.id',
            'temporary_id' => 'applications.temporary_id',
            'submission' => 'applications.submission_time'             ,
        ]);
        $new_applications->select(['applications.id', 'applications.applicant_id', 'applications.applicant_name_bn', 'applications.phone', 'applications.email', 'applications.application_type_id', 'applications.start_date', 'applications.end_date', 'applications.status']);
        $new_applications->select(['applicants.id', 'applicants.applicant_type_id', 'applicants.location_type_id', 'applicants.division_id', 'applicants.district_id', 'applicants.upazila_id', 'applicants.union_id', 'applicants.union_ward', 'applicants.city_corporation_id', 'applicants.city_corporation_ward_id', 'applicants.municipal_id', 'applicants.municipal_ward_id']);
        $new_applications->where([
            'applications.status' => Configure::read('application_status.Pending'),
            'applicants.user_id IN' => $user['id']
        ]);

        $new_applications->leftJoin('applicants', 'applicants.id=applications.applicant_id');
        $new_applications->leftJoin('applicant_types', 'applicant_types.id=applicants.applicant_type_id');
        $new_applications->order(['applications.id' => 'DESC']);
        $new_applications->limit(10);
        $new_application = $new_applications->toArray();
//
//
//        //for accepted application
        $new_approved_application = TableRegistry::get('applications')->find();

        $new_approved_application->select([
            'applicant_type' => 'applicant_types.title_bn',
            'applicant_name_bn' => 'applications.applicant_name_bn',
            'id' => 'applications.id',
            'temporary_id' => 'applications.temporary_id',
            'approve_time' => 'applications.approve_time',
        ]);
        $new_approved_application->select(['applications.id', 'applications.applicant_id', 'applications.applicant_name_bn', 'applications.phone', 'applications.email', 'applications.application_type_id', 'applications.start_date', 'applications.end_date', 'applications.status']);
        $new_approved_application->select(['applicants.id', 'applicants.applicant_type_id', 'applicants.location_type_id', 'applicants.division_id', 'applicants.district_id', 'applicants.upazila_id', 'applicants.union_id', 'applicants.union_ward', 'applicants.city_corporation_id', 'applicants.city_corporation_ward_id', 'applicants.municipal_id', 'applicants.municipal_ward_id']);
        $new_approved_application->where([
            'applications.status' => Configure::read('application_status.Approve'),
            'applicants.user_id IN' => $user['id']
        ]);

        $new_approved_application->leftJoin('applicants', 'applicants.id=applications.applicant_id');
        $new_approved_application->leftJoin('applicant_types', 'applicant_types.id=applicants.applicant_type_id');
        $new_approved_application->order(['applications.id' => 'DESC']);
        $new_approved_application->limit(10);
        $new_approved_applications = $new_approved_application->toArray();


        $new_reject_application = TableRegistry::get('applications')->find();

        $new_reject_application->select([
            'applicant_type' => 'applicant_types.title_bn',
            'applicant_name_bn' => 'applications.applicant_name_bn',
            'id' => 'applications.id',
            'temporary_id' => 'applications.temporary_id',
            'approve_time' => 'applications.submission_time',
        ]);
        $new_reject_application->select(['applications.id', 'applications.applicant_id', 'applications.applicant_name_bn', 'applications.phone', 'applications.email', 'applications.application_type_id', 'applications.start_date', 'applications.end_date', 'applications.status']);
        $new_reject_application->select(['applicants.id', 'applicants.applicant_type_id', 'applicants.location_type_id', 'applicants.division_id', 'applicants.district_id', 'applicants.upazila_id', 'applicants.union_id', 'applicants.union_ward', 'applicants.city_corporation_id', 'applicants.city_corporation_ward_id', 'applicants.municipal_id', 'applicants.municipal_ward_id']);
        $new_reject_application->where([
            'applications.status' => Configure::read('application_status.Reject'),
            'applicants.user_id IN' => $user['id']
        ]);

        $new_reject_application->leftJoin('applicants', 'applicants.id=applications.applicant_id');
        $new_reject_application->leftJoin('applicant_types', 'applicant_types.id=applicants.applicant_type_id');
        $new_reject_application->order(['applications.id' => 'DESC']);
        $new_reject_application->limit(10);
        $new_reject_application = $new_reject_application->toArray();


        $this->set(compact(
            'application_number',
            'user_number',
            'pending_application_number',
            'approve_application_number',
            'reject_application_number',
            'new_approved_applications',
            'new_application',
            'number_of_application_type',
            'new_reject_application'
        ));
    }

//    public function officeUser()
//    {
//
//    }
}
