<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Committees Controller
 *
 * @property \App\Model\Table\CommitteesTable $Committees
 */
class CommitteesController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'Committees.id' => 'desc'
        ]
    ];

    /**
    * Index method
    *
    * @return void
    */
    public function index()
    {
        $committees = $this->Committees->find('all', [
            'conditions' =>['Committees.status !=' => 99],
            'contain' => ['ParentCommittees', 'Offices']
        ]);
        $this->set('committees', $this->paginate($committees) );
        $this->set('_serialize', ['committees']);
    }

    /**
     * View method
     *
     * @param string|null $id Committee id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $committee = $this->Committees->get($id, [
            'contain' => ['ParentCommittees', 'Offices']
        ]);
        $this->set('committee', $committee);
        $this->set('_serialize', ['committee']);
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
        $committee = $this->Committees->newEntity();
        if ($this->request->is('post'))
        {
            $data=$this->request->data;
            $data['start_date'] = strtotime($data['start_date']);
            $data['end_date'] = strtotime($data['end_date']);
            $data['create_by']=$user['id'];
            $data['create_date']=$time;
            $committee = $this->Committees->patchEntity($committee, $data);
            if ($this->Committees->save($committee))
            {
                $this->Flash->success('The committee has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The committee could not be saved. Please, try again.');
            }
        }
        $parentCommittees = $this->Committees->ParentCommittees->find('list')->where(['status'=>1]);
        $offices = $this->Committees->Offices->find('list')->where(['status'=>1]);
        $this->set(compact('committee', 'parentCommittees', 'offices'));
        $this->set('_serialize', ['committee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Committee id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $committee = $this->Committees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $committee = $this->Committees->patchEntity($committee, $data);
            if ($this->Committees->save($committee))
            {
                $this->Flash->success('The committee has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The committee could not be saved. Please, try again.');
            }
        }
        $parentCommittees = $this->Committees->ParentCommittees->find('list')->where(['status'=>1]);
        $offices = $this->Committees->Offices->find('list')->where(['status'=>1]);
        $this->set(compact('committee', 'parentCommittees', 'offices'));
        $this->set('_serialize', ['committee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Committee id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $committee = $this->Committees->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $committee = $this->Committees->patchEntity($committee, $data);
        if ($this->Committees->save($committee))
        {
            $this->Flash->success('The committee has been deleted.');
        }
        else
        {
            $this->Flash->error('The committee could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
