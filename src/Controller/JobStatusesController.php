<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * JobStatuses Controller
 *
 * @property \App\Model\Table\JobStatusesTable $JobStatuses
 */
class JobStatusesController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'JobStatuses.title' => 'desc'
        ]
    ];

/**
* Index method
*
* @return void
*/
public function index()
{
$jobStatuses = $this->JobStatuses->find('all', [
'conditions' =>['JobStatuses.status !=' => 99]
]);
$this->set('jobStatuses', $this->paginate($jobStatuses) );
$this->set('_serialize', ['jobStatuses']);
}

    /**
     * View method
     *
     * @param string|null $id Job Status id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $jobStatus = $this->JobStatuses->get($id, [
            'contain' => []
        ]);
        $this->set('jobStatus', $jobStatus);
        $this->set('_serialize', ['jobStatus']);
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
        $jobStatus = $this->JobStatuses->newEntity();
        if ($this->request->is('post'))
        {

            $data=$this->request->data;
            $data['create_by']=$user['id'];
            $data['create_date']=$time;
            $jobStatus = $this->JobStatuses->patchEntity($jobStatus, $data);
            if ($this->JobStatuses->save($jobStatus))
            {
                $this->Flash->success('The job status has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The job status could not be saved. Please, try again.');
            }
        }
        $this->set(compact('jobStatus'));
        $this->set('_serialize', ['jobStatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Job Status id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $jobStatus = $this->JobStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $jobStatus = $this->JobStatuses->patchEntity($jobStatus, $data);
            if ($this->JobStatuses->save($jobStatus))
            {
                $this->Flash->success('The job status has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The job status could not be saved. Please, try again.');
            }
        }
        $this->set(compact('jobStatus'));
        $this->set('_serialize', ['jobStatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Job Status id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $jobStatus = $this->JobStatuses->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $jobStatus = $this->JobStatuses->patchEntity($jobStatus, $data);
        if ($this->JobStatuses->save($jobStatus))
        {
            $this->Flash->success('The job status has been deleted.');
        }
        else
        {
            $this->Flash->error('The job status could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
