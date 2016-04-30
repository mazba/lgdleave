<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * JobGrades Controller
 *
 * @property \App\Model\Table\JobGradesTable $JobGrades
 */
class JobGradesController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'JobGrades.title' => 'desc'
        ]
    ];

/**
* Index method
*
* @return void
*/
public function index()
{
$jobGrades = $this->JobGrades->find('all', [
'conditions' =>['JobGrades.status !=' => 99],
'contain' => ['JobCadres', 'JobRanks']
]);
$this->set('jobGrades', $this->paginate($jobGrades) );
$this->set('_serialize', ['jobGrades']);
}

    /**
     * View method
     *
     * @param string|null $id Job Grade id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $jobGrade = $this->JobGrades->get($id, [
            'contain' => ['JobCadres', 'JobRanks', 'UserPayInformations']
        ]);
        $this->set('jobGrade', $jobGrade);
        $this->set('_serialize', ['jobGrade']);
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
        $jobGrade = $this->JobGrades->newEntity();
        if ($this->request->is('post'))
        {

            $data=$this->request->data;
            $data['create_by']=$user['id'];
            $data['create_date']=$time;
            $jobGrade = $this->JobGrades->patchEntity($jobGrade, $data);
            if ($this->JobGrades->save($jobGrade))
            {
                $this->Flash->success('The job grade has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The job grade could not be saved. Please, try again.');
            }
        }
        $jobCadres = $this->JobGrades->JobCadres->find('list', ['limit' => 200]);
        $jobRanks = $this->JobGrades->JobRanks->find('list', ['limit' => 200]);
        $this->set(compact('jobGrade', 'jobCadres', 'jobRanks'));
        $this->set('_serialize', ['jobGrade']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Job Grade id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $jobGrade = $this->JobGrades->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $jobGrade = $this->JobGrades->patchEntity($jobGrade, $data);
            if ($this->JobGrades->save($jobGrade))
            {
                $this->Flash->success('The job grade has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The job grade could not be saved. Please, try again.');
            }
        }
        $jobCadres = $this->JobGrades->JobCadres->find('list', ['limit' => 200]);
        $jobRanks = $this->JobGrades->JobRanks->find('list', ['limit' => 200]);
        $this->set(compact('jobGrade', 'jobCadres', 'jobRanks'));
        $this->set('_serialize', ['jobGrade']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Job Grade id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $jobGrade = $this->JobGrades->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $jobGrade = $this->JobGrades->patchEntity($jobGrade, $data);
        if ($this->JobGrades->save($jobGrade))
        {
            $this->Flash->success('The job grade has been deleted.');
        }
        else
        {
            $this->Flash->error('The job grade could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
