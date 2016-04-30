<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Inflector;

/**
 * UserTypes Controller
 *
 * @property \App\Model\Table\UserTypesTable $UserTypes
 */
class UserTypesController extends AppController
{

    public $paginate = [
        'limit' => 15,
        'order' => [
            'UserTypes.title' => 'desc'
        ]
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $userTypes = $this->UserTypes->find('all', [
            'conditions' => ['UserTypes.status !=' => 99]
        ]);
        $this->set('userTypes', $this->paginate($userTypes));
        $this->set('_serialize', ['userTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id User Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        $userType = $this->UserTypes->get($id, [
            'contain' => []
        ]);
        $this->set('userType', $userType);
        $this->set('_serialize', ['userType']);
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
        $userType = $this->UserTypes->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['create_by'] = $user['id'];
            $data['create_date'] = $time;
            $userType = $this->UserTypes->patchEntity($userType, $data);
            if ($this->UserTypes->save($userType)) {
                $this->Flash->success('The user type has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user type could not be saved. Please, try again.');
            }
        }
        $this->set(compact('userType'));
        $this->set('_serialize', ['userType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();
        $userType = $this->UserTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['update_by'] = $user['id'];
            $data['update_date'] = $time;
            $userType = $this->UserTypes->patchEntity($userType, $data);
            if ($this->UserTypes->save($userType)) {
                $this->Flash->success('The user type has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user type could not be saved. Please, try again.');
            }
        }
        $this->set(compact('userType'));
        $this->set('_serialize', ['userType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $userType = $this->UserTypes->get($id);

        $user = $this->Auth->user();
        $data = $this->request->data;
        $data['updated_by'] = $user['id'];
        $data['updated_date'] = time();
        $data['status'] = 99;
        $userType = $this->UserTypes->patchEntity($userType, $data);
        if ($this->UserTypes->save($userType)) {
            $this->Flash->success('The user type has been deleted.');
        } else {
            $this->Flash->error('The user type could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
