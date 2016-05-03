<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Phinx\Config\Config;

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
        $this->loadComponent('FileUpload');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadModel('LocationTypes');
        $this->loadModel('AreaDivisions');
        $this->loadModel('Applications');
        $this->loadModel('ApplicationTypes');
        $this->loadModel('ApplicationsFiles');

        $time = time();

        $applications = $this->Applications->newEntity();
        $applcationFile = $this->ApplicationsFiles->newEntity();

        if ($this->request->is('post')) {


            try {
                $data = $this->request->data;
                $conn = ConnectionManager::get('default');
                $conn->transactional(function () use ($data, $applications, $time) {
                    $data['create_time'] = $time;
                    $data['submission_time'] = $time;
                    $data['temporary_id'] = 63;
                    $data['status'] = Configure::read('application_status.Pending');
                    $data['start_date'] = strtotime($data['start_date']);
                    $data['end_date'] = strtotime($data['end_date']);
                    $data['last_foreign_tour_time'] = $data['last_foreign_tour_time'] ? strtotime($data['last_foreign_tour_time']) : 0;
                    $files = $data['document_file'];
                    unset($data['document_file']);
                    $applications = $this->Applications->patchEntity($applications, $data);
                    if ($this->Applications->save($applications)) {
                        //
                        $fileTable = TableRegistry::get('applications_files');

                        if(is_array($files)){
                        foreach ($files as $file) {
                            $result = $this->FileUpload->upload_file($file, 'u_load/application_file', ['jpg', 'png']);
                            if ($result['status'] === true) {
                                $fileEntity = $fileTable->newEntity();
                                $fileEntity->file = $result['file_path'];
                                $fileEntity->application_id = $applications['id'];
                                $fileTable->save($fileEntity);
                            } else {
                                throw new Exception('error');
                            }
                        }}else{
                            $result = $this->FileUpload->upload_file($files, 'u_load/application_file', ['jpg', 'png']);
                            if ($result['status'] === true) {
                                $fileEntity = $fileTable->newEntity();
                                $fileEntity->file = $result['file_path'];
                                $fileEntity->application_id = $applications['id'];
                                $fileTable->save($fileEntity);
                            } else {
                                throw new Exception('error');
                            }
                        }
                    } else {
                        throw  new Exception('error');
                    }
                });
                $this->Flash->success(__('The citizen corner has been saved.'));
                return $this->redirect(['action' => 'index']);

            } catch (\Exception $e) {
                $this->Flash->error(__('The citizen corner could not be saved. Please, try again.'));
            }
        }


       // $applicantTypes = $this->ApplicantTypes->find('list', ['conditions' => ['status' => 1]]);
        $applicationTypes =  $this->ApplicationTypes->find('list', ['conditions'=>['status'=>1]]);
        $locationTypes = $this->LocationTypes->find('list', ['conditions' => ['status' => 1]]);
        $divisions = $this->AreaDivisions->find('list');

        $this->set(compact('locationTypes', 'applicationTypes', 'divisions', 'applications'));
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


    public function ajax($action = null)
    {
        if ($action == 'get_applicantTypes') {

            $location_type_id = $this->request->data('location_type_id');
            $this->loadModel('ApplicantTypes');
            $application_types = $this->ApplicantTypes->find('list')
                                                                    ->where(['type' => $location_type_id,'status'=>1])
                                                                    ->toArray();
            $this->response->body(json_encode($application_types));
            return $this->response;
        }  elseif ($action == 'get_districts') {

            $division_id = $this->request->data('division_id');

            $this->loadModel('AreaDistricts');
            $districts = $this->AreaDistricts->find('list', ['conditions' => ['divid' => $division_id]])->toArray();

            $this->response->body(json_encode($districts));
            return $this->response;
        } elseif ($action == 'get_upazilas') {
            $district_id = $this->request->data('district_id');
            $this->loadModel('AreaUpazilas');
            $upazilas = $this->AreaUpazilas->find('list', ['keyField' => 'upazilaid', 'keyValue' => 'upazilaname'])
                ->where(['zillaid' => $district_id])
                ->toArray();

            $this->response->body(json_encode($upazilas));
            return $this->response;
        } elseif ($action == 'get_city_corporations') {
            $district_id = $this->request->data('district_id');
            $this->loadModel('CityCorporations');
            $cityCorporations = $this->CityCorporations->find('list', ['keyField' => 'citycorporationid', 'keyValue' => 'citycorporationname'])
                ->where(['zillaid' => $district_id])
                ->toArray();

            $this->response->body(json_encode($cityCorporations));
            return $this->response;

        } elseif ($action == 'get_municipals') {
            $district_id = $this->request->data('district_id');
            $this->loadModel('Municipals');
            $municipals = $this->Municipals->find('list', ['keyField' => 'municipalid', 'keyValue' => 'municipalname'])
                ->where(['zillaid' => $district_id])
                ->toArray();

            $this->response->body(json_encode($municipals));
            return $this->response;
        } elseif ($action == 'get_unions') {
            $district_id = $this->request->data('district_id');
            $upazila_id = $this->request->data('upazila_id');

            $this->loadModel('Unions');
            $unions = $this->Unions->find('list', ['conditions' => ['upazilaid' => $upazila_id, 'zillaid' => $district_id]])->toArray();

            $this->response->body(json_encode($unions));
            return $this->response;
        } elseif ($action == 'get_city_corporation_wards') {
            $district_id = $this->request->data('district_id');
            $city_corporation_id = $this->request->data('city_corporation_id');

            $this->loadModel('CityCorporationWards');

            $cityCorporationWards = $this->CityCorporationWards->find('list', ['keyField' => 'citycorporationwardid', 'keyValue' => 'wardname'])
                ->where(['zillaid' => $district_id, 'citycorporationid' => $city_corporation_id])
                ->toArray();


            $this->response->body(json_encode($cityCorporationWards));
            return $this->response;
        } elseif ($action == 'get_municipal_wards') {
            $district_id = $this->request->data('district_id');
            $municipal_id = $this->request->data('municipal_id');

            $this->loadModel('MunicipalWards');

            $municipalWards = $this->MunicipalWards->find('list', ['keyField' => 'wardid', 'keyValue' => 'wardname'])
                ->where(['zillaid' => $district_id, 'municipalid' => $municipal_id])
                ->toArray();

            $this->response->body(json_encode($municipalWards));
            return $this->response;
        }
    }
}
