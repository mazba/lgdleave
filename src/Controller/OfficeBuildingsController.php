<?php
namespace App\Controller;

use Cake\Core\Configure;

/**
 * OfficeBuildings Controller
 *
 * @property \App\Model\Table\OfficeBuildingsTable $OfficeBuildings
 */
class OfficeBuildingsController extends AppController
{

    public $paginate = [
        'limit' => 15,
        'order' => [
            'OfficeBuildings.id' => 'desc'
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
            $officeBuildings = $this->OfficeBuildings->find('all', [
                'conditions' => ['OfficeBuildings.status ' => 1],
                'contain' => ['ParentOfficeBuildings', 'Offices']
            ]);
        } else {
            $officeBuildings = $this->OfficeBuildings->find('all', [
                'conditions' => ['OfficeBuildings.status ' => 1, 'OfficeBuildings.office_id' => $user['office_id']],
                'contain' => ['ParentOfficeBuildings', 'Offices']
            ]);
        }

        $this->set('officeBuildings', $this->paginate($officeBuildings));
        $this->set('_serialize', ['officeBuildings']);
    }

    /**
     * View method
     *
     * @param string|null $id Office Building id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        $officeBuilding = $this->OfficeBuildings->get($id, [
            'contain' => ['ParentOfficeBuildings', 'Offices', 'ItemAssigns', 'ChildOfficeBuildings', 'OfficeGarages', 'OfficeRooms', 'OfficeWarehouses']
        ]);
        $this->set('officeBuilding', $officeBuilding);
        $this->set('_serialize', ['officeBuilding']);
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
        $officeBuilding = $this->OfficeBuildings->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['create_by'] = $user['id'];
            $data['create_date'] = $time;
            if (!isset($data['office_id'])) {
                $data['office_id'] = $user['office_id'];
            }
            $officeBuilding = $this->OfficeBuildings->patchEntity($officeBuilding, $data);
            if ($this->OfficeBuildings->save($officeBuilding)) {
                $this->Flash->success('The office building has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office building could not be saved. Please, try again.');
            }
        }

        if ($user['user_group_id'] == Configure::read('user_group.super_admin')) {
            $offices = $this->OfficeBuildings->Offices->find('list');
            $parentOfficeBuildings = $this->OfficeBuildings->ParentOfficeBuildings->find('list');
            $this->set(compact('offices'));
        } else {
            $parentOfficeBuildings = $this->OfficeBuildings->ParentOfficeBuildings->find('list', ['conditions' => ['office_id' => $user['office-id']]]);
        }

        $this->set(compact('officeBuilding', 'parentOfficeBuildings'));
        $this->set('_serialize', ['officeBuilding']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office Building id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();
        $officeBuilding = $this->OfficeBuildings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['update_by'] = $user['id'];
            $data['update_date'] = $time;
            if (!isset($data['office_id'])) {
                $data['office_id'] = $user['office_id'];
            }
            $officeBuilding = $this->OfficeBuildings->patchEntity($officeBuilding, $data);
            if ($this->OfficeBuildings->save($officeBuilding)) {
                $this->Flash->success('The office building has been updated.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office building could not be updated. Please, try again.');
            }
        }
        if ($user['user_group_id'] == Configure::read('user_group.super_admin')) {
            $offices = $this->OfficeBuildings->Offices->find('list');
            $parentOfficeBuildings = $this->OfficeBuildings->ParentOfficeBuildings->find('list');
            $this->set(compact('offices'));
        } else {
            $parentOfficeBuildings = $this->OfficeBuildings->ParentOfficeBuildings->find('list', ['conditions' => ['office_id' => $user['office-id']]]);
        }

        $this->set(compact('officeBuilding', 'parentOfficeBuildings'));
        $this->set('_serialize', ['officeBuilding']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office Building id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $officeBuilding = $this->OfficeBuildings->get($id);

        $user = $this->Auth->user();
        $data = $this->request->data;
        $data['updated_by'] = $user['id'];
        $data['updated_date'] = time();
        $data['status'] = 99;
        $officeBuilding = $this->OfficeBuildings->patchEntity($officeBuilding, $data);
        if ($this->OfficeBuildings->save($officeBuilding)) {
            $this->Flash->success('The office building has been deleted.');
        } else {
            $this->Flash->error('The office building could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
