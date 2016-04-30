<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OfficeUnitDesignations Controller
 *
 * @property \App\Model\Table\OfficeUnitDesignationsTable $OfficeUnitDesignations
 */
class OfficeUnitDesignationsController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'OfficeUnitDesignations.title' => 'desc'
        ]
    ];

/**
* Index method
*
* @return void
*/
public function index()
{
			$officeUnitDesignations = $this->OfficeUnitDesignations->find('all', [
	'conditions' =>['OfficeUnitDesignations.status !=' => 99],
	'contain' => ['ParentOfficeUnitDesignations', 'Offices', 'OfficeUnits']
	]);
		$this->set('officeUnitDesignations', $this->paginate($officeUnitDesignations) );
	$this->set('_serialize', ['officeUnitDesignations']);
	}

    /**
     * View method
     *
     * @param string|null $id Office Unit Designation id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $officeUnitDesignation = $this->OfficeUnitDesignations->get($id, [
            'contain' => ['ParentOfficeUnitDesignations', 'Offices', 'OfficeUnits']
        ]);
        $this->set('officeUnitDesignation', $officeUnitDesignation);
        $this->set('_serialize', ['officeUnitDesignation']);
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
        $officeUnitDesignation = $this->OfficeUnitDesignations->newEntity();
        if ($this->request->is('post'))
        {

            $data=$this->request->data;
            $data['create_by']=$user['id'];
            $data['create_date']=$time;
            $officeUnitDesignation = $this->OfficeUnitDesignations->patchEntity($officeUnitDesignation, $data);
            if ($this->OfficeUnitDesignations->save($officeUnitDesignation))
            {
                $this->Flash->success('The office unit designation has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The office unit designation could not be saved. Please, try again.');
            }
        }
        $parentOfficeUnitDesignations = $this->OfficeUnitDesignations->ParentOfficeUnitDesignations->find('list', ['conditions'=>['status'=>1]]);
        $offices = $this->OfficeUnitDesignations->Offices->find('list', ['conditions'=>['status'=>1]]);
        $officeUnits = $this->OfficeUnitDesignations->OfficeUnits->find('list', ['conditions'=>['status'=>1]]);
        $this->set(compact('officeUnitDesignation', 'parentOfficeUnitDesignations', 'offices', 'officeUnits'));
        $this->set('_serialize', ['officeUnitDesignation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office Unit Designation id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $officeUnitDesignation = $this->OfficeUnitDesignations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $officeUnitDesignation = $this->OfficeUnitDesignations->patchEntity($officeUnitDesignation, $data);
            if ($this->OfficeUnitDesignations->save($officeUnitDesignation))
            {
                $this->Flash->success('The office unit designation has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The office unit designation could not be saved. Please, try again.');
            }
        }
        $parentOfficeUnitDesignations = $this->OfficeUnitDesignations->ParentOfficeUnitDesignations->find('list', ['conditions'=>['status'=>1]]);
        $offices = $this->OfficeUnitDesignations->Offices->find('list', ['conditions'=>['status'=>1]]);
        $officeUnits = $this->OfficeUnitDesignations->OfficeUnits->find('list', ['conditions'=>['status'=>1]]);
        $this->set(compact('officeUnitDesignation', 'parentOfficeUnitDesignations', 'offices', 'officeUnits'));
        $this->set('_serialize', ['officeUnitDesignation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office Unit Designation id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $officeUnitDesignation = $this->OfficeUnitDesignations->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $officeUnitDesignation = $this->OfficeUnitDesignations->patchEntity($officeUnitDesignation, $data);
        if ($this->OfficeUnitDesignations->save($officeUnitDesignation))
        {
            $this->Flash->success('The office unit designation has been deleted.');
        }
        else
        {
            $this->Flash->error('The office unit designation could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
