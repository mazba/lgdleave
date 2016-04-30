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
//        $this->loadModel('Offices');
//        $this->loadModel('Users');
//        $this->loadModel('Items');
//        //count
//        $office_number = $this->Offices->find('all')->where(['status'=>1])->count();
//        $user_number = $this->Users->find('all')->where(['status'=>1])->count();
//        $item_number = $this->Items->find('all')->where(['status'=>1])->count();
//        // item
//        $office_items = $this->Offices->find();
//        $office_items
//            ->select(['Offices.id','Offices.name_bn'])
//            ->contain(['Items','Committees','OfficeBuildings','OfficeRooms','OfficeUnits','OfficeWarehouses']);
//        $this->set(compact('office_number','user_number','item_number','office_items'));

    }
    public function officeAdmin()
    {
//        $user = $this->request->session()->read('Auth.User');
//        $this->loadModel('Offices');
//        $this->loadModel('Users');
//        $this->loadModel('Items');
//        $this->loadModel('ItemAssigns');
//        $this->loadModel('OfficeBuildings');
//        $this->loadModel('OfficeRooms');
//        $this->loadModel('Committees');
//        $this->loadModel('OfficeWarehouses');
//        $this->loadModel('Users');
//
//        //count
//        $user_number = $this->Users->find('all')->where(['status'=>1,'office_id'=>$user['office_id']])->count();
//        $item_number = $this->Items->find('all')->where(['status'=>1,'office_id'=>$user['office_id']])->count();
//        $assign_item_number = $this->ItemAssigns->find('all')->where(['status'=>1,'office_id'=>$user['office_id']])->count();
//        $building_number = $this->OfficeBuildings->find('all')->where(['status'=>1,'office_id'=>$user['office_id']])->count();
//        $room_number = $this->OfficeRooms->find('all')->where(['status'=>1,'office_id'=>$user['office_id']])->count();
//        $committee_number = $this->Committees->find('all')->where(['status'=>1,'office_id'=>$user['office_id']])->count();
//        // item
//        $office_warehouse = $this->OfficeWarehouses->find()
//            ->contain(
//                [
//                'Items',
//                'ItemWithdrawals'=>function($q){
//                    return $q->where(['status'=>1]);
//                },
//                'ItemAssigns'=>function($q){
//                return $q->where(['status'=>1]);
//            }]
//            );
//        //recently assigned item
//        $recently_assigned_item = $this->ItemAssigns
//            ->find()
//            ->where(['ItemAssigns.status'=>1,'ItemAssigns.office_id'=>$user['office_id']])
//            ->contain(['DesignatedUsers','Items'])
//            ->limit(10);
//        //Leave preparatory to Retirement
//        $lpr_range = Configure::read('lpr_range');
//        $lpr_year = new Time('-'.$lpr_range.' years');
//        $lpr_year = $lpr_year->addMonth(1)->toUnixString();
//        $leave_preparatory_users = $this->Users
//            ->find()
//            ->where(['Users.status'=>1,'UserBasic.date_of_birth <'=>$lpr_year,'Users.office_id'=>$user['office_id']])
//            ->contain(['UserBasic']);
////        echo '<pre>';
////        print_r($leave_preparatory_users->toArray());
////        echo '</pre>';
////        die;
//        $this->set(compact('leave_preparatory_users','building_number','recently_assigned_item','room_number','office_warehouse','committee_number','assign_item_number','user_number','item_number','office_items'));
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
