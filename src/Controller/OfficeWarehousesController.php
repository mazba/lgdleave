<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OfficeWarehouses Controller
 *
 * @property \App\Model\Table\OfficeWarehousesTable $OfficeWarehouses
 */
class OfficeWarehousesController extends AppController
{

    public $paginate = [
        'limit' => 15,
        'order' => [
            'OfficeWarehouses.title' => 'desc'
        ]
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $officeWarehouses = $this->OfficeWarehouses->find('all', [
            'conditions' => ['OfficeWarehouses.status !=' => 99],
            'contain' => ['ParentOfficeWarehouses', 'Offices', 'OfficeBuildings', 'OfficeRooms']
        ]);
        $this->set('officeWarehouses', $this->paginate($officeWarehouses));
        $this->set('_serialize', ['officeWarehouses']);
    }

    /**
     * View method
     *
     * @param string|null $id Office Warehouse id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        $officeWarehouse = $this->OfficeWarehouses->get($id, [
            'contain' => ['ParentOfficeWarehouses', 'Offices', 'OfficeBuildings', 'OfficeRooms', 'ItemAssigns', 'ItemWithdrawals', 'Items', 'ChildOfficeWarehouses']
        ]);
        $this->set('officeWarehouse', $officeWarehouse);
        $this->set('_serialize', ['officeWarehouse']);
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
        $officeWarehouse = $this->OfficeWarehouses->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['create_by'] = $user['id'];
            $data['create_date'] = $time;
            $officeWarehouse = $this->OfficeWarehouses->patchEntity($officeWarehouse, $data);
            if ($this->OfficeWarehouses->save($officeWarehouse)) {
                $this->Flash->success('The office warehouse has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office warehouse could not be saved. Please, try again.');
            }
        }
        $parentOfficeWarehouses = $this->OfficeWarehouses->ParentOfficeWarehouses->find('list', ['limit' => 200]);
        $offices = $this->OfficeWarehouses->Offices->find('list', ['limit' => 200]);
        $officeBuildings = $this->OfficeWarehouses->OfficeBuildings->find('list', ['limit' => 200]);
        $officeRooms = $this->OfficeWarehouses->OfficeRooms->find('list', ['limit' => 200]);
        $this->set(compact('officeWarehouse', 'parentOfficeWarehouses', 'offices', 'officeBuildings', 'officeRooms'));
        $this->set('_serialize', ['officeWarehouse']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office Warehouse id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();
        $officeWarehouse = $this->OfficeWarehouses->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['update_by'] = $user['id'];
            $data['update_date'] = $time;
            $officeWarehouse = $this->OfficeWarehouses->patchEntity($officeWarehouse, $data);
            if ($this->OfficeWarehouses->save($officeWarehouse)) {
                $this->Flash->success('The office warehouse has been updated.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office warehouse could not be updated. Please, try again.');
            }
        }
        $parentOfficeWarehouses = $this->OfficeWarehouses->ParentOfficeWarehouses->find('list');
        $offices = $this->OfficeWarehouses->Offices->find('list');
        $officeBuildings = $this->OfficeWarehouses->OfficeBuildings->find('list');
        $officeRooms = $this->OfficeWarehouses->OfficeRooms->find('list');
        $this->set(compact('officeWarehouse', 'parentOfficeWarehouses', 'offices', 'officeBuildings', 'officeRooms'));
        $this->set('_serialize', ['officeWarehouse']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office Warehouse id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $officeWarehouse = $this->OfficeWarehouses->get($id);

        $user = $this->Auth->user();
        $data = $this->request->data;
        $data['updated_by'] = $user['id'];
        $data['updated_date'] = time();
        $data['status'] = 99;
        $officeWarehouse = $this->OfficeWarehouses->patchEntity($officeWarehouse, $data);
        if ($this->OfficeWarehouses->save($officeWarehouse)) {
            $this->Flash->success('The office warehouse has been deleted.');
        } else {
            $this->Flash->error('The office warehouse could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
