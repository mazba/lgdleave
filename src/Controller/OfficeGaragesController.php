<?php
namespace App\Controller;
use Cake\Core\Configure;

/**
 * OfficeGarages Controller
 *
 * @property \App\Model\Table\OfficeGaragesTable $OfficeGarages
 */
class OfficeGaragesController extends AppController
{

    public $paginate = [
        'limit' => 15,
        'order' => [
            'OfficeGarages.id' => 'desc'
        ]
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $user = $this->Auth->user();
        if ($user['user_group_id'] == Configure::read('user_group.super_admin')) {
            $officeGarages = $this->OfficeGarages->find('all', [
                'conditions' => ['OfficeGarages.status' => 1],
                'contain' => ['Offices', 'OfficeBuildings', 'OfficeRooms']
            ]);
        } else {
            $officeGarages = $this->OfficeGarages->find('all', [
                'conditions' => ['OfficeGarages.status' => 1, 'OfficeGarages.office_id' => $user['office_id']],
                'contain' => ['Offices', 'OfficeBuildings', 'OfficeRooms']
            ]);
        }

        $this->set('officeGarages', $this->paginate($officeGarages));
        $this->set('_serialize', ['officeGarages']);
    }

    /**
     * View method
     *
     * @param string|null $id Office Garage id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        $officeGarage = $this->OfficeGarages->get($id, [
            'contain' => ['Offices', 'OfficeBuildings', 'OfficeRooms']
        ]);
        $this->set('officeGarage', $officeGarage);
        $this->set('_serialize', ['officeGarage']);
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
        $officeGarage = $this->OfficeGarages->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['create_by'] = $user['id'];
            $data['create_date'] = $time;
            if (!isset($data['office_id'])) {
                $data['office_id'] = $user['office_id'];
            }
            $officeGarage = $this->OfficeGarages->patchEntity($officeGarage, $data);
            echo "<pre>";
            print_r($officeGarage);
            echo "</pre>";
            die;
            if ($this->OfficeGarages->save($officeGarage)) {
                $this->Flash->success('The office garage has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office garage could not be saved. Please, try again.');
            }
        }

        if ($user['user_group_id'] == Configure::read('user_group.super_admin')) {
            $offices = $this->OfficeGarages->Offices->find('list');
            $officeRooms = $this->OfficeGarages->OfficeRooms->find('list');
            $officeBuildings = $this->OfficeGarages->OfficeBuildings->find('list');
            $this->set(compact('offices'));
        } else {
            $officeBuildings = $this->OfficeGarages->OfficeBuildings->find('list');
            $officeRooms = $this->OfficeGarages->OfficeRooms->find('list', ['conditions' => ['office_id' => $user['office_id']]]);
        }


        $this->set(compact('officeGarage', 'offices', 'officeBuildings', 'officeRooms'));
        $this->set('_serialize', ['officeGarage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office Garage id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();
        $officeGarage = $this->OfficeGarages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['update_by'] = $user['id'];
            $data['update_date'] = $time;
            if (!isset($data['office_id'])) {
                $data['office_id'] = $user['office_id'];
            }
            $officeGarage = $this->OfficeGarages->patchEntity($officeGarage, $data);
            if ($this->OfficeGarages->save($officeGarage)) {
                $this->Flash->success('The office garage has been updated.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office garage could not be updated. Please, try again.');
            }
        }

        if ($user['user_group_id'] == Configure::read('user_group.super_admin')) {
            $offices = $this->OfficeGarages->Offices->find('list');
            $officeRooms = $this->OfficeGarages->OfficeRooms->find('list');
            $officeBuildings = $this->OfficeGarages->OfficeBuildings->find('list');
            $this->set(compact('offices'));
        } else {
            $officeBuildings = $this->OfficeGarages->OfficeBuildings->find('list');
            $officeRooms = $this->OfficeGarages->OfficeRooms->find('list', ['conditions' => ['office_id' => $user['office_id']]]);
        }
        $this->set(compact('officeGarage', 'offices', 'officeBuildings', 'officeRooms'));
        $this->set('_serialize', ['officeGarage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office Garage id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $officeGarage = $this->OfficeGarages->get($id);

        $user = $this->Auth->user();
        $data = $this->request->data;
        $data['updated_by'] = $user['id'];
        $data['updated_date'] = time();
        $data['status'] = 99;
        $officeGarage = $this->OfficeGarages->patchEntity($officeGarage, $data);
        if ($this->OfficeGarages->save($officeGarage)) {
            $this->Flash->success('The office garage has been deleted.');
        } else {
            $this->Flash->error('The office garage could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
