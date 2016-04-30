<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Offices Controller
 *
 * @property \App\Model\Table\OfficesTable $Offices
 */
class OfficesController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'Offices.id' => 'desc'
        ]
    ];

/**
* Index method
*
* @return void
*/
public function index()
{
			$offices = $this->Offices->find('all', [
	'conditions' =>['Offices.status !=' => 99],
	'contain' => ['ParentOffices']
	]);
		$this->set('offices', $this->paginate($offices) );
	$this->set('_serialize', ['offices']);
	}

    /**
     * View method
     *
     * @param string|null $id Office id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $office = $this->Offices->get($id, [
            'contain' => ['ParentOffices']
        ]);
        $this->set('office', $office);
        $this->set('_serialize', ['office']);
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
        $office = $this->Offices->newEntity();
        if ($this->request->is('post'))
        {

            $data=$this->request->data;
            $data['create_by']=$user['id'];
            $data['create_date']=$time;
            $office = $this->Offices->patchEntity($office, $data);
            if ($this->Offices->save($office))
            {
                $this->Flash->success('The office has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The office could not be saved. Please, try again.');
            }
        }
        $parentOffices = $this->Offices->ParentOffices->find('list', ['conditions'=>['status'=>1]]);
        $this->set(compact('office', 'parentOffices'));
        $this->set('_serialize', ['office']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $office = $this->Offices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $office = $this->Offices->patchEntity($office, $data);
            if ($this->Offices->save($office))
            {
                $this->Flash->success('The office has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The office could not be saved. Please, try again.');
            }
        }
        $parentOffices = $this->Offices->ParentOffices->find('list', ['conditions'=>['status'=>1]]);
        $this->set(compact('office', 'parentOffices'));
        $this->set('_serialize', ['office']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $office = $this->Offices->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $office = $this->Offices->patchEntity($office, $data);
        if ($this->Offices->save($office))
        {
            $this->Flash->success('The office has been deleted.');
        }
        else
        {
            $this->Flash->error('The office could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
