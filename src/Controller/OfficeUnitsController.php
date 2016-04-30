<?php
namespace App\Controller;

use Cake\Core\Configure;

/**
 * OfficeUnits Controller
 *
 * @property \App\Model\Table\OfficeUnitsTable $OfficeUnits
 */
class OfficeUnitsController extends AppController
{

    public $paginate = [
        'limit' => 15,
        'order' => [
            'OfficeUnits.id' => 'desc'
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
            $officeUnits = $this->OfficeUnits->find('all', [
                'conditions' => ['OfficeUnits.status' => 1],
                'contain' => ['ParentOfficeUnits', 'OfficeLevels', 'OfficeUnitCategories', 'Offices']
            ]);
        }else{
            $officeUnits = $this->OfficeUnits->find('all', [
                'conditions' => ['OfficeUnits.status' => 1,'OfficeUnits.office_id'=>$user['office_id']],
                'contain' => ['ParentOfficeUnits', 'OfficeLevels', 'OfficeUnitCategories', 'Offices']
            ]);
        }

        $this->set('officeUnits', $this->paginate($officeUnits));
        $this->set('_serialize', ['officeUnits']);
    }

    /**
     * View method
     *
     * @param string|null $id Office Unit id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        $officeUnit = $this->OfficeUnits->get($id, [
            'contain' => ['ParentOfficeUnits', 'OfficeLevels', 'OfficeUnitCategories', 'Offices']
        ]);
        $this->set('officeUnit', $officeUnit);
        $this->set('_serialize', ['officeUnit']);
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
        $officeUnit = $this->OfficeUnits->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['create_by'] = $user['id'];
            $data['create_date'] = $time;
            if (!isset($data['office_id'])) {
                $data['office_id'] = $user['office_id'];
            }
            $officeUnit = $this->OfficeUnits->patchEntity($officeUnit, $data);
            if ($this->OfficeUnits->save($officeUnit)) {
                $this->Flash->success('The office unit has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office unit could not be saved. Please, try again.');
            }
        }

        if ($user['user_group_id'] == Configure::read('user_group.super_admin')) {

            $parentOfficeUnits = $this->OfficeUnits->ParentOfficeUnits->find('list', ['conditions' => ['status' => 1]]);
            $offices = $this->OfficeUnits->Offices->find('list', ['conditions' => ['status' => 1]]);
            $this->set(compact('offices'));

        } else {

            $parentOfficeUnits = $this->OfficeUnits->ParentOfficeUnits->find('list', ['conditions' => ['status' => 1, 'office_id' => $user['office_id']]]);
        }

        $officeLevels = $this->OfficeUnits->OfficeLevels->find('list', ['conditions' => ['status' => 1]]);
        $officeUnitCategories = $this->OfficeUnits->OfficeUnitCategories->find('list', ['conditions' => ['status' => 1]]);

        $this->set(compact('officeUnit', 'parentOfficeUnits', 'officeLevels', 'officeUnitCategories'));
        $this->set('_serialize', ['officeUnit']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office Unit id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();
        $officeUnit = $this->OfficeUnits->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['update_by'] = $user['id'];
            $data['update_date'] = $time;
            if (!isset($data['office_id'])) {
                $data['office_id'] = $user['office_id'];
            }
            $officeUnit = $this->OfficeUnits->patchEntity($officeUnit, $data);
            if ($this->OfficeUnits->save($officeUnit)) {
                $this->Flash->success('The office unit has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office unit could not be saved. Please, try again.');
            }
        }

        if ($user['user_group_id'] == Configure::read('user_group.super_admin')) {

            $parentOfficeUnits = $this->OfficeUnits->ParentOfficeUnits->find('list', ['conditions' => ['status' => 1]]);
            $offices = $this->OfficeUnits->Offices->find('list', ['conditions' => ['status' => 1]]);
            $this->set(compact('offices'));

        } else {

            $parentOfficeUnits = $this->OfficeUnits->ParentOfficeUnits->find('list', ['conditions' => ['status' => 1, 'office_id' => $user['office_id']]]);
        }

        $officeLevels = $this->OfficeUnits->OfficeLevels->find('list', ['conditions' => ['status' => 1]]);
        $officeUnitCategories = $this->OfficeUnits->OfficeUnitCategories->find('list', ['conditions' => ['status' => 1]]);
        $this->set(compact('officeUnit', 'parentOfficeUnits', 'officeLevels', 'officeUnitCategories'));
        $this->set('_serialize', ['officeUnit']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office Unit id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $officeUnit = $this->OfficeUnits->get($id);

        $user = $this->Auth->user();
        $data = $this->request->data;
        $data['updated_by'] = $user['id'];
        $data['updated_date'] = time();
        $data['status'] = 99;
        $officeUnit = $this->OfficeUnits->patchEntity($officeUnit, $data);
        if ($this->OfficeUnits->save($officeUnit)) {
            $this->Flash->success('The office unit has been deleted.');
        } else {
            $this->Flash->error('The office unit could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
