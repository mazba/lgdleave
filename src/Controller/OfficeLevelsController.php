<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OfficeLevels Controller
 *
 * @property \App\Model\Table\OfficeLevelsTable $OfficeLevels
 */
class OfficeLevelsController extends AppController
{

    public $paginate = [
        'limit' => 15,
        'order' => [
            'OfficeLevels.title' => 'desc'
        ]
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $officeLevels = $this->OfficeLevels->find('all', [
            'conditions' => ['OfficeLevels.status !=' => 99],
            'contain' => ['ParentOfficeLevels']
        ]);
        $this->set('officeLevels', $this->paginate($officeLevels));
        $this->set('_serialize', ['officeLevels']);
    }

    /**
     * View method
     *
     * @param string|null $id Office Level id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        $officeLevel = $this->OfficeLevels->get($id, [
            'contain' => ['ParentOfficeLevels', 'ChildOfficeLevels', 'OfficeUnits', 'Offices']
        ]);
        $this->set('officeLevel', $officeLevel);
        $this->set('_serialize', ['officeLevel']);
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
        $officeLevel = $this->OfficeLevels->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['create_by'] = $user['id'];
            $data['create_date'] = $time;
            $officeLevel = $this->OfficeLevels->patchEntity($officeLevel, $data);
            if ($this->OfficeLevels->save($officeLevel)) {
                $this->Flash->success('The office level has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office level could not be saved. Please, try again.');
            }
        }
        $parentOfficeLevels = $this->OfficeLevels->ParentOfficeLevels->find('list', ['limit' => 200]);
        $this->set(compact('officeLevel', 'parentOfficeLevels'));
        $this->set('_serialize', ['officeLevel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office Level id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();
        $officeLevel = $this->OfficeLevels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['update_by'] = $user['id'];
            $data['update_date'] = $time;
            $officeLevel = $this->OfficeLevels->patchEntity($officeLevel, $data);
            if ($this->OfficeLevels->save($officeLevel)) {
                $this->Flash->success('The office level has been updated.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office level could not be updated. Please, try again.');
            }
        }
        $parentOfficeLevels = $this->OfficeLevels->ParentOfficeLevels->find('list', ['limit' => 200]);
        $this->set(compact('officeLevel', 'parentOfficeLevels'));
        $this->set('_serialize', ['officeLevel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office Level id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $officeLevel = $this->OfficeLevels->get($id);

        $user = $this->Auth->user();
        $data = $this->request->data;
        $data['updated_by'] = $user['id'];
        $data['updated_date'] = time();
        $data['status'] = 99;
        $officeLevel = $this->OfficeLevels->patchEntity($officeLevel, $data);
        if ($this->OfficeLevels->save($officeLevel)) {
            $this->Flash->success('The office level has been deleted.');
        } else {
            $this->Flash->error('The office level could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
