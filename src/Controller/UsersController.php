<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'Users.id' => 'desc'
        ]
    ];

/**
* Index method
*
* @return void
*/
public function index()
{
			$users = $this->Users->find('all', [
	'conditions' =>['Users.status !=' => 99],
	'contain' => ['Offices', 'UserGroups']
	]);
		$this->set('users', $this->paginate($users) );
	$this->set('_serialize', ['users']);
	}

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $user = $this->Users->get($id, [
            'contain' => ['Offices', 'UserGroups']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Designations');
        $this->loadModel('OfficeUnits');
        $user_info=$this->Auth->user();
        $time=time();
        $user = $this->Users->newEntity();
        
        if ($this->request->is('post'))
        {
            $data=$this->request->data;

            $data['create_by']=$user_info['id'];
            $data['create_date']=$time;
            $data['create_by']=$user_info['id'];
            $data['create_time']=$time;
            $data['office_id']=1;



            $user = $this->Users->patchEntity($user, $data, [
                'associated' => [
                    'UserBasics',
                    'UserDesignations',

                ]
            ]);


            if ($this->Users->save($user))
            {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $Designations = $this->Designations->find('list', ['conditions'=>['office_id'=>1,'status'=>1]]);
        $OfficeUnits = $this->OfficeUnits->find('list', ['conditions'=>['office_id'=>1,'status'=>1]]);

        $userGroups = $this->Users->UserGroups->find('list', ['conditions'=>['status'=>1]]);
        $this->set(compact('user', 'Designations','OfficeUnits','userGroups'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user))
            {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $offices = $this->Users->Offices->find('list', ['conditions'=>['status'=>1]]);
        $userGroups = $this->Users->UserGroups->find('list', ['conditions'=>['status'=>1]]);
        $this->set(compact('user', 'offices', 'userGroups'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $user = $this->Users->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $user = $this->Users->patchEntity($user, $data);
        if ($this->Users->save($user))
        {
            $this->Flash->success('The user has been deleted.');
        }
        else
        {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }


    public function ajax($action=null)
    {

     if($action=='get_unit_designation')
        {
          //  $office_id = $this->request->data('office_id');
            $office_unit_id = $this->request->data('office_unit_id');
            $this->loadModel('OfficeUnitDesignations');
            $designations = $this->OfficeUnitDesignations->find('list', ['conditions'=>['office_unit_id'=>$office_unit_id, 'status'=>1]]);

            $this->response->body(json_encode($designations));
            return $this->response;
        }



    }
}
