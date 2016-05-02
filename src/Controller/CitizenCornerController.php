<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CitizenCorner Controller
 *
 * @property \App\Model\Table\CitizenCornerTable $CitizenCorner
 */
class CitizenCornerController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->Auth->allow();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadModel('ApplicantTypes');
        $this->loadModel('AreaDivisions');
        $this->loadModel('Applications');
        $applications = $this->Applications;
        $applicantTypes =  $this->ApplicantTypes->find('list', ['conditions'=>['status'=>1]]);
        $divisions =  $this->AreaDivisions->find('list');

        $this->set(compact('applicantTypes','divisions','applications'));
        $this->viewBuilder()->layout('citizen_corner');
    }

    /**
     * View method
     *
     * @param string|null $id Citizen Corner id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $citizenCorner = $this->CitizenCorner->get($id, [
            'contain' => []
        ]);
        $this->set('citizenCorner', $citizenCorner);
        $this->set('_serialize', ['citizenCorner']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $citizenCorner = $this->CitizenCorner->newEntity();
        if ($this->request->is('post')) {
            $citizenCorner = $this->CitizenCorner->patchEntity($citizenCorner, $this->request->data);
            if ($this->CitizenCorner->save($citizenCorner)) {
                $this->Flash->success(__('The citizen corner has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The citizen corner could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('citizenCorner'));
        $this->set('_serialize', ['citizenCorner']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Citizen Corner id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $citizenCorner = $this->CitizenCorner->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $citizenCorner = $this->CitizenCorner->patchEntity($citizenCorner, $this->request->data);
            if ($this->CitizenCorner->save($citizenCorner)) {
                $this->Flash->success(__('The citizen corner has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The citizen corner could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('citizenCorner'));
        $this->set('_serialize', ['citizenCorner']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Citizen Corner id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $citizenCorner = $this->CitizenCorner->get($id);
        if ($this->CitizenCorner->delete($citizenCorner)) {
            $this->Flash->success(__('The citizen corner has been deleted.'));
        } else {
            $this->Flash->error(__('The citizen corner could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function ajax($action=null){
        if($action=='get_districts'){

            $division_id = $this->request->data('division_id');

            $this->loadModel('AreaDistricts');
            $districts = $this->AreaDistricts->find('list', ['conditions'=>['divid'=>$division_id]])->toArray();

            $this->response->body(json_encode($districts));
            return $this->response;
        }

        elseif($action=='get_upazilas')
        {
            $district_id = $this->request->data('district_id');
            $this->loadModel('AreaUpazilas');
            $upazilas = $this->AreaUpazilas->find('list',['conditions'=>['zillaid'=>$district_id]])->toArray();

            $this->response->body(json_encode($upazilas));
            return $this->response;
        }
    }
}
