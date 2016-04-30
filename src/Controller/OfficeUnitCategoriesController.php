<?php
namespace App\Controller;

/**
 * OfficeUnitCategories Controller
 *
 * @property \App\Model\Table\OfficeUnitCategoriesTable $OfficeUnitCategories
 */
class OfficeUnitCategoriesController extends AppController
{

    public $paginate = [
        'limit' => 15,
        'order' => [
            'OfficeUnitCategories.title' => 'desc'
        ]
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $officeUnitCategories = $this->OfficeUnitCategories->find('all', [
            'conditions' => ['OfficeUnitCategories.status !=' => 99]
        ]);
        $this->set('officeUnitCategories', $this->paginate($officeUnitCategories));
        $this->set('_serialize', ['officeUnitCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Office Unit Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        $officeUnitCategory = $this->OfficeUnitCategories->get($id, [
            'contain' => []
        ]);
        $this->set('officeUnitCategory', $officeUnitCategory);
        $this->set('_serialize', ['officeUnitCategory']);
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
        $officeUnitCategory = $this->OfficeUnitCategories->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['create_by'] = $user['id'];
            $data['create_date'] = $time;
            $officeUnitCategory = $this->OfficeUnitCategories->patchEntity($officeUnitCategory, $data);
            if ($this->OfficeUnitCategories->save($officeUnitCategory)) {
                $this->Flash->success('The office unit category has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office unit category could not be saved. Please, try again.');
            }
        }
        $this->set(compact('officeUnitCategory'));
        $this->set('_serialize', ['officeUnitCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office Unit Category id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();
        $officeUnitCategory = $this->OfficeUnitCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['update_by'] = $user['id'];
            $data['update_date'] = $time;
            $officeUnitCategory = $this->OfficeUnitCategories->patchEntity($officeUnitCategory, $data);
            if ($this->OfficeUnitCategories->save($officeUnitCategory)) {
                $this->Flash->success('The office unit category has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The office unit category could not be saved. Please, try again.');
            }
        }
        $this->set(compact('officeUnitCategory'));
        $this->set('_serialize', ['officeUnitCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office Unit Category id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $officeUnitCategory = $this->OfficeUnitCategories->get($id);

        $user = $this->Auth->user();
        $data = $this->request->data;
        $data['updated_by'] = $user['id'];
        $data['updated_date'] = time();
        $data['status'] = 99;
        $officeUnitCategory = $this->OfficeUnitCategories->patchEntity($officeUnitCategory, $data);
        if ($this->OfficeUnitCategories->save($officeUnitCategory)) {
            $this->Flash->success('The office unit category has been deleted.');
        } else {
            $this->Flash->error('The office unit category could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
