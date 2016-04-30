<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserLeaves Controller
 *
 * @property \App\Model\Table\UserLeavesTable $UserLeaves
 */
class UserLeavesController extends AppController
{

    public $paginate = [
        'limit' => 15,
        'order' => [
            'UserLeaves.id' => 'desc'
        ]
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $userLeaves = $this->UserLeaves->find('all', [
            'conditions' => ['UserLeaves.status !=' => 99],
            'contain' => ['Offices', 'Users', 'ResponsibleUsers', 'ApprovalUsers', 'LeaveStatuses']
        ]);
        $this->set('userLeaves', $this->paginate($userLeaves));
        $this->set('_serialize', ['userLeaves']);
    }

    /**
     * View method
     *
     * @param string|null $id User Leave id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        $userLeave = $this->UserLeaves->get($id, [
            'contain' => ['Offices', 'Users', 'ResponsibleUsers', 'ApprovalUsers', 'LeaveStatuses']
        ]);
        $this->set('userLeave', $userLeave);
        $this->set('_serialize', ['userLeave']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Auth->user();
        $time = time();
        $userLeave = $this->UserLeaves->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['office_id'] = $user['office_id'];
            $data['create_by'] = $user['id'];
            $data['create_date'] = $time;
            $data['start_date'] = $data['start_date'] ? strtotime($data['start_date']) : 0;
            $data['end_date'] = $data['end_date'] ? strtotime($data['end_date']) : 0;
            $userLeave = $this->UserLeaves->patchEntity($userLeave, $data);
            if ($this->UserLeaves->save($userLeave)) {
                $this->Flash->success('The user leave has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user leave could not be saved. Please, try again.');
            }
        }
        $users = $this->UserLeaves->Users->find('list', ['conditions' => ['status' => 1,'office_id'=>$user['office_id']]]);
        $leaveStatuses = $this->UserLeaves->LeaveStatuses->find('list', ['conditions' => ['status' => 1]]);
        $this->set(compact('userLeave', 'offices', 'users','leaveStatuses'));
        $this->set('_serialize', ['userLeave']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Leave id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();
        $userLeave = $this->UserLeaves->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['start_date'] = $data['start_date'] ? strtotime($data['start_date']) : 0;
            $data['end_date'] = $data['end_date'] ? strtotime($data['end_date']) : 0;
            $data['update_by'] = $user['id'];
            $data['update_date'] = $time;
            $userLeave = $this->UserLeaves->patchEntity($userLeave, $data);
            if ($this->UserLeaves->save($userLeave)) {
                $this->Flash->success('The user leave has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user leave could not be saved. Please, try again.');
            }
        }
        $offices = $this->UserLeaves->Offices->find('list', ['conditions' => ['status' => 1]]);
        $users = $this->UserLeaves->Users->find('list', ['conditions' => ['status' => 1]]);
        $responsibleUsers = $this->UserLeaves->ResponsibleUsers->find('list', ['conditions' => ['status' => 1]]);
        $approvalUsers = $this->UserLeaves->ApprovalUsers->find('list', ['conditions' => ['status' => 1]]);
        $leaveStatuses = $this->UserLeaves->LeaveStatuses->find('list', ['conditions' => ['status' => 1]]);
        $this->set(compact('userLeave', 'offices', 'users', 'responsibleUsers', 'approvalUsers', 'leaveStatuses'));
        $this->set('_serialize', ['userLeave']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Leave id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $userLeave = $this->UserLeaves->get($id);

        $user = $this->Auth->user();
        $data = $this->request->data;
        $data['updated_by'] = $user['id'];
        $data['updated_date'] = time();
        $data['status'] = 99;
        $userLeave = $this->UserLeaves->patchEntity($userLeave, $data);
        if ($this->UserLeaves->save($userLeave)) {
            $this->Flash->success('The user leave has been deleted.');
        } else {
            $this->Flash->error('The user leave could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
