<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * ReceiveApplications Controller
 *
 * @property \App\Model\Table\ReceiveApplicationsTable $ReceiveApplications
 */
class ReceiveApplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        if($this->request->is('ajax')){
            $this->loadModel('Applications');
            $new_applications = $this->Applications->find()
                ->select(
                    [
                        'location_type'=>'LocationTypes.title_bn',
                        'area_district'=>'AreaDistricts.zillaname',
                        'area_division'=>'AreaDivisions.divname',
                        'applicant_type'=>'ApplicantTypes.title_bn',
                        'application_type'=>'ApplicationTypes.title_bn',
                        'applicant_name_bn'=>'Applications.applicant_name_bn',
                        'temporary_id'=>'Applications.temporary_id',
                        'submission'=>"FROM_UNIXTIME(Applications.submission_time,'%D, %M, %Y')",
                    ]
                )
                ->where(['applications.status'=>Configure::read('application_status.Pending')])
                ->contain(['ApplicationTypes','ApplicantTypes','LocationTypes','AreaDivisions','AreaDistricts','AreaUpazilas','CityCorporations','Municipals'])
                ->toArray();
            $this->response->body(json_encode($new_applications));
            return $this->response;
        }
    }

    /**
     * View method
     *
     * @param string|null $id Receive Application id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $receiveApplication = $this->ReceiveApplications->get($id, [
            'contain' => []
        ]);
        $this->set('receiveApplication', $receiveApplication);
        $this->set('_serialize', ['receiveApplication']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function receive()
    {
        $receiveApplication = $this->ReceiveApplications->newEntity();
        if ($this->request->is('post')) {
            $receiveApplication = $this->ReceiveApplications->patchEntity($receiveApplication, $this->request->data);
            if ($this->ReceiveApplications->save($receiveApplication)) {
                $this->Flash->success(__('The receive application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The receive application could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('receiveApplication'));
        $this->set('_serialize', ['receiveApplication']);
    }
}
