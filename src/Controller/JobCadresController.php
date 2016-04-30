<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * JobCadres Controller
 *
 * @property \App\Model\Table\JobCadresTable $JobCadres
 */
class JobCadresController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'JobCadres.title' => 'desc'
        ]
    ];

/**
* Index method
*
* @return void
*/
public function index()
{
$jobCadres = $this->JobCadres->find('all', [
'conditions' =>['JobCadres.status !=' => 99]
]);
$this->set('jobCadres', $this->paginate($jobCadres) );
$this->set('_serialize', ['jobCadres']);
}

    /**
     * View method
     *
     * @param string|null $id Job Cadre id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $jobCadre = $this->JobCadres->get($id, [
            'contain' => ['JobGrades']
        ]);
        $this->set('jobCadre', $jobCadre);
        $this->set('_serialize', ['jobCadre']);
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
        $jobCadre = $this->JobCadres->newEntity();
        if ($this->request->is('post'))
        {

            $data=$this->request->data;
            $data['create_by']=$user['id'];
            $data['create_date']=$time;
            $jobCadre = $this->JobCadres->patchEntity($jobCadre, $data);
            if ($this->JobCadres->save($jobCadre))
            {
                $this->Flash->success('The job cadre has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The job cadre could not be saved. Please, try again.');
            }
        }
        $this->set(compact('jobCadre'));
        $this->set('_serialize', ['jobCadre']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Job Cadre id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $jobCadre = $this->JobCadres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $jobCadre = $this->JobCadres->patchEntity($jobCadre, $data);
            if ($this->JobCadres->save($jobCadre))
            {
                $this->Flash->success('The job cadre has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The job cadre could not be saved. Please, try again.');
            }
        }
        $this->set(compact('jobCadre'));
        $this->set('_serialize', ['jobCadre']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Job Cadre id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $jobCadre = $this->JobCadres->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $jobCadre = $this->JobCadres->patchEntity($jobCadre, $data);
        if ($this->JobCadres->save($jobCadre))
        {
            $this->Flash->success('The job cadre has been deleted.');
        }
        else
        {
            $this->Flash->error('The job cadre could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
