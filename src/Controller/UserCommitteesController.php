<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserCommittees Controller
 *
 * @property \App\Model\Table\UserCommitteesTable $UserCommittees
 */
class UserCommitteesController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'UserCommittees.title' => 'desc'
        ]
    ];

    /**
    * Index method
    *
    * @return void
    */
    public function index()
    {
    $userCommittees = $this->UserCommittees->find('all', [
            'conditions' =>['UserCommittees.status !=' => 99],
            'contain' => ['Committees', 'Offices', 'Users']
    ]);
    $this->set('userCommittees', $this->paginate($userCommittees) );
    $this->set('_serialize', ['userCommittees']);
    }

    /**
     * View method
     *
     * @param string|null $id User Committee id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $userCommittee = $this->UserCommittees->get($id, [
            'contain' => ['Committees', 'Offices', 'Users']
        ]);
        $this->set('userCommittee', $userCommittee);
        $this->set('_serialize', ['userCommittee']);
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
        $userCommittee = $this->UserCommittees->newEntity();
        if ($this->request->is('post'))
        {
            $data=$this->request->data;
            $already_exists = $this->UserCommittees->exists(['office_id'=>$user['office_id'],'user_id'=>$data['user_id'],'committee_id'=>$data['committee_id']]);
            if($already_exists)
                $this->Flash->error('The user Already Assign to this Committee. Please Update.');
            else{
                $data['create_by']=$user['id'];
                $data['create_date']=$time;
                $data['office_id']=$user['office_id'];
                $userCommittee = $this->UserCommittees->patchEntity($userCommittee, $data);
                if ($this->UserCommittees->save($userCommittee))
                {
                    $this->Flash->success('The user committee has been saved.');
                    return $this->redirect(['action' => 'index']);
                }
                else
                {
                    $this->Flash->error('The user committee could not be saved. Please, try again.');
                }
            }
        }
        $committees = $this->UserCommittees->Committees->find('list', ['conditions'=>['status'=>1,'office_id'=>$user['office_id']]]);
        $users = $this->UserCommittees->Users->find('list',['conditions'=>['status'=>1,'office_id'=>$user['office_id']]]);
        $this->set(compact('userCommittee', 'committees', 'users'));
        $this->set('_serialize', ['userCommittee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Committee id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $userCommittee = $this->UserCommittees->get($id, [
            'contain' => ['Committees','Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $userCommittee = $this->UserCommittees->patchEntity($userCommittee, $data);
            if ($this->UserCommittees->save($userCommittee))
            {
                $this->Flash->success('The user committee has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The user committee could not be saved. Please, try again.');
            }
        }
        $this->set(compact('userCommittee', 'committees', 'offices', 'users'));
        $this->set('_serialize', ['userCommittee']);
    }
}
