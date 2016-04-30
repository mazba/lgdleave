<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * JobRanks Controller
 *
 * @property \App\Model\Table\JobRanksTable $JobRanks
 */
class JobRanksController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'JobRanks.title' => 'desc'
        ]
    ];

/**
* Index method
*
* @return void
*/
public function index()
{
$jobRanks = $this->JobRanks->find('all', [
'conditions' =>['JobRanks.status !=' => 99],
'contain' => ['Offices']
]);
$this->set('jobRanks', $this->paginate($jobRanks) );
$this->set('_serialize', ['jobRanks']);
}

    /**
     * View method
     *
     * @param string|null $id Job Rank id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $jobRank = $this->JobRanks->get($id, [
            'contain' => ['Offices', 'JobGrades']
        ]);
        $this->set('jobRank', $jobRank);
        $this->set('_serialize', ['jobRank']);
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
        $jobRank = $this->JobRanks->newEntity();
        if ($this->request->is('post'))
        {

            $data=$this->request->data;
            $data['create_by']=$user['id'];
            $data['create_date']=$time;
            $jobRank = $this->JobRanks->patchEntity($jobRank, $data);
            if ($this->JobRanks->save($jobRank))
            {
                $this->Flash->success('The job rank has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The job rank could not be saved. Please, try again.');
            }
        }
        $offices = $this->JobRanks->Offices->find('list', ['limit' => 200]);
        $this->set(compact('jobRank', 'offices'));
        $this->set('_serialize', ['jobRank']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Job Rank id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $jobRank = $this->JobRanks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $jobRank = $this->JobRanks->patchEntity($jobRank, $data);
            if ($this->JobRanks->save($jobRank))
            {
                $this->Flash->success('The job rank has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The job rank could not be saved. Please, try again.');
            }
        }
        $offices = $this->JobRanks->Offices->find('list', ['limit' => 200]);
        $this->set(compact('jobRank', 'offices'));
        $this->set('_serialize', ['jobRank']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Job Rank id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $jobRank = $this->JobRanks->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $jobRank = $this->JobRanks->patchEntity($jobRank, $data);
        if ($this->JobRanks->save($jobRank))
        {
            $this->Flash->success('The job rank has been deleted.');
        }
        else
        {
            $this->Flash->error('The job rank could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
