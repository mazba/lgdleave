<?php
namespace App\View\Cell;

use Cake\Core\Configure;
use Cake\I18n\Time;
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

    }
    public function officeAdmin()
    {
        $user = $this->request->session()->read('Auth.User');
        $application_status = Configure::read('application_status');
        $this->loadModel('Offices');
        $this->loadModel('Users');
        $this->loadModel('Applications');
        $this->loadModel('ApplicationTypes');
//        $this->loadModel('ItemAssigns');
//        $this->loadModel('OfficeBuildings');
//        $this->loadModel('OfficeRooms');
//        $this->loadModel('Committees');
//        $this->loadModel('OfficeWarehouses');
//        $this->loadModel('Users');
//
//        //count
        $user_number = $this->Users->find('all')->where(['status'=>1])->count();
        $application_number = $this->Applications->find('all')->count();
        $pending_application_number = $this->Applications->find('all')->where(['status'=>$application_status['Pending']])->count();
        $approve_application_number = $this->Applications->find('all')->where(['status'=>$application_status['Approve']])->count();
        $reject_application_number = $this->Applications->find('all')->where(['status'=>$application_status['Reject']])->count();
        $number_of_application_type = $this->ApplicationTypes->find('all')->where(['status'=>1])->count();
        $this->set(compact(
            'application_number',
            'user_number',
            'pending_application_number',
            'approve_application_number',
            'reject_application_number',
            'number_of_application_type'
        ));
    }
    public function officeUser()
    {
//        $this->loadModel('ItemAssigns');
//        $this->loadModel('ItemWithdrawals');
//        $user = $this->request->session()->read('Auth.User');
//        $recently_assigned_items = $this->ItemAssigns
//            ->find()
//            ->where([
//                'ItemAssigns.status'=>1,
//                'ItemAssigns.designated_user_id'=>$user['id']
//            ])
//            ->contain(['Items','Items.Offices','Items.Manufacturers'])
//            ->limit(10);
//        $recently_withdrawal_items = $this->ItemWithdrawals
//            ->find()
//            ->where([
//                'ItemAssigns.status'=>0,
//                'ItemAssigns.designated_user_id'=>$user['id']
//            ])
//            ->contain(['Offices','ItemAssigns','ItemAssigns.Offices','ItemAssigns.Items'])
//            ->limit(10);
//        $this->set(compact('recently_assigned_items','recently_withdrawal_items'));
    }
}
