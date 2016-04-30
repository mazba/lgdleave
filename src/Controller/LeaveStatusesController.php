<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LeaveStatuses Controller
 *
 * @property \App\Model\Table\LeaveStatusesTable $LeaveStatuses
 */
class LeaveStatusesController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'LeaveStatuses.id' => 'desc'
        ]
    ];

/**
* Index method
*
* @return void
*/
public function index()
{
			$leaveStatuses = $this->LeaveStatuses->find('all', [
	'conditions' =>['LeaveStatuses.status !=' => 99]
	]);
		$this->set('leaveStatuses', $this->paginate($leaveStatuses) );
	$this->set('_serialize', ['leaveStatuses']);
	}

    /**
     * View method
     *
     * @param string|null $id Leave Status id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $leaveStatus = $this->LeaveStatuses->get($id, [
            'contain' => []
        ]);
        $this->set('leaveStatus', $leaveStatus);
        $this->set('_serialize', ['leaveStatus']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user=$this->Auth->user();
        $time=time();
        $leaveStatus = $this->LeaveStatuses->newEntity();
        if ($this->request->is('post'))
        {

            $data=$this->request->data;
            $data['create_by']=$user['id'];
            $data['create_date']=$time;
            $leaveStatus = $this->LeaveStatuses->patchEntity($leaveStatus, $data);
            if ($this->LeaveStatuses->save($leaveStatus))
            {
                $this->Flash->success('The leave status has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The leave status could not be saved. Please, try again.');
            }
        }
        $this->set(compact('leaveStatus'));
        $this->set('_serialize', ['leaveStatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Status id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $leaveStatus = $this->LeaveStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $leaveStatus = $this->LeaveStatuses->patchEntity($leaveStatus, $data);
            if ($this->LeaveStatuses->save($leaveStatus))
            {
                $this->Flash->success('The leave status has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The leave status could not be saved. Please, try again.');
            }
        }
        $this->set(compact('leaveStatus'));
        $this->set('_serialize', ['leaveStatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Status id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $leaveStatus = $this->LeaveStatuses->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $leaveStatus = $this->LeaveStatuses->patchEntity($leaveStatus, $data);
        if ($this->LeaveStatuses->save($leaveStatus))
        {
            $this->Flash->success('The leave status has been deleted.');
        }
        else
        {
            $this->Flash->error('The leave status could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
