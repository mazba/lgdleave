<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Applicants Controller
 *
 * @property \App\Model\Table\ApplicantsTable $Applicants
 */
class ApplicantsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if ($this->request->is('ajax')) {
            $applicants = $this->Applicants->find('all', [
                'conditions' => ['Applicants.status =' => 1],
                'contain' => [
                    'Users',
                    'ApplicantTypes',
                    'LocationTypes',
                    'AreaDivisions',
                    'AreaDistricts',
                    'AreaUpazilas',
                ]
            ]);

            $applicants->select([
                'id' => 'Applicants.id',
                'location_type' => 'LocationTypes.title_bn',
                'area_district' => 'AreaDistricts.zillaname',
                'area_division' => 'AreaDivisions.divname',
                'applicant_type' => 'ApplicantTypes.title_bn',
            ]);

            //   echo "<pre>";print_r($applicants->toArray());die();
            $this->response->body(json_encode($applicants->toArray()));
            return $this->response;
        }
    }

    /**
     * View method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicant = $this->Applicants->get($id, [
            'contain' => ['ApplicantTypes',
                'LocationTypes',
                'AreaDivisions',
                'AreaDistricts',
                'AreaUpazilas',
                'Unions',
                'CityCorporations',
                'CityCorporationWards',
                'Municipals',
                'MunicipalWards',
                'Applications'
            ]
        ]);
//echo "<pre>";print_r($applicant);die();
        $this->set('applicant', $applicant);
        $this->set('_serialize', ['applicant']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Users = TableRegistry::get('Users');
        $applicant = $this->Applicants->newEntity();
        $auth = $this->Auth->user();

        if ($this->request->is('post')) {
            $time = time();
            $data = $this->request->data;
            if (!array_key_exists("upazila_id", $data)) {
                $data['upazila_id'] = '';
            }
            if (!array_key_exists("city_corporation_id", $data)) {
                $data['city_corporation_id'] = '';
            }

            //    echo "<pre>";print_r($data);die();

            //  echo "<pre>";print_r($checkApplicant->first());die();
            if ($this->checkApplicant($data)) {
                $this->Flash->error(__('Sorry a applicant already exists in your given location. Please, try again.'));
            } else {
                $userEntity = $Users->newEntity();
                $userEntity->username = $data['user']['username'];
                $userEntity->password = $data['user']['password'];
                $userEntity->user_group_id = 4;
                $userEntity->office_id = 0;
                $userEntity->status = 1;
                $userEntity->create_by = $auth['id'];
                $userEntity->create_date = $time;

                $user_id = $Users->save($userEntity);
                unset($data['user']);
                $data['create_time'] = $time;
                $data['create_by'] = $auth['id'];
                $data['status'] = 1;
                $data['user_id'] = $user_id['id'];

                $applicant = $this->Applicants->patchEntity($applicant, $data);
                //     echo "<pre>";print_r($applicant);die();
                if ($this->Applicants->save($applicant)) {
                    $this->Flash->success(__('The applicant has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
                }
            }
        }
        $applicantTypes = $this->Applicants->ApplicantTypes->find('list', ['limit' => 200]);
        $locationTypes = $this->Applicants->LocationTypes->find('list', ['limit' => 200, 'conditions' => ['status' => 1]]);
        $divisions = $this->Applicants->AreaDivisions->find('list', ['limit' => 200]);
        $districts = $this->Applicants->AreaDistricts->find('list', ['limit' => 200]);
        $upazilas = $this->Applicants->AreaUpazilas->find('list', ['limit' => 200]);
        $unions = $this->Applicants->Unions->find('list', ['limit' => 200]);
        $cityCorporations = $this->Applicants->CityCorporations->find('list', ['limit' => 200]);
        $cityCorporationWards = $this->Applicants->CityCorporationWards->find('list', ['limit' => 200]);
        $municipals = $this->Applicants->Municipals->find('list', ['limit' => 200]);
        $municipalWards = $this->Applicants->MunicipalWards->find('list', ['limit' => 200]);
        $this->set(compact('applicant', 'applicantTypes', 'locationTypes', 'divisions', 'districts', 'upazilas', 'unions', 'cityCorporations', 'cityCorporationWards', 'municipals', 'municipalWards'));
        $this->set('_serialize', ['applicant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Users');
        $applicant = $this->Applicants->get($id, [
            'contain' => []
        ]);

        $user = $this->Users->get($applicant['user_id'], [
            'contain' => []
        ]);

        $auth = $this->Auth->user();
        $time = time();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            //  echo "<pre>";print_r($data);die();

            $data['update_by'] = $auth['id'];
            $data['update_date'] = $time;
            $data['user_group_id'] = 5;

            if ($data['new_password']) {
                $data['password'] = $data['new_password'];
            } else {
                $data['password'] = $user['password'];
            }

            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->save($user)) {
                $applicant_data['status'] = 99;
                $applicant_data['update_time'] = $time;
                $applicant_data['update_by'] = $auth['id'];

                    $applicant = $this->Applicants->patchEntity($applicant, $applicant_data);
                    if ($this->Applicants->save($applicant)) {
                        $this->Flash->success(__('The applicant has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
                    }
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicant = $this->Applicants->get($id);
        if ($this->Applicants->delete($applicant)) {
            $this->Flash->success(__('The applicant has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function transfer($id = null)
    {

        $applicant = $this->Applicants->newEntity();
        $auth = $this->Auth->user();

        $applicant_old = $this->Applicants->get($id);
        $applicant_user_id = $applicant_old['user_id'];

        if ($this->request->is('post')) {
            $time = time();
            $data = $this->request->data;

            if (!array_key_exists("upazila_id", $data)) {
                $data['upazila_id'] = '';
            }
            if (!array_key_exists("city_corporation_id", $data)) {
                $data['city_corporation_id'] = '';
            }


            if ($this->checkApplicant($data)) {
                $this->Flash->error(__('Sorry a applicant already exists in your given location. Please, try again.'));
            } else {

                $old_data['status'] = 99;
                $old_data['update_time'] = $time;
                $old_data['update_by'] = $auth['id'];
                $applicant_old = $this->Applicants->patchEntity($applicant_old, $old_data);

                if ($this->Applicants->save($applicant_old)) {

                    unset($data['status']);
                    unset($data['update_time']);
                    unset($data['update_by']);


                    $data['user_id'] = $applicant_user_id;
                    $data['status'] = 1;
                    $data['create_by'] = $auth['id'];
                    $data['create_time'] = $time;

                    $applicant = $this->Applicants->patchEntity($applicant, $data);
                    if ($this->Applicants->save($applicant)) {
                        $this->Flash->success(__('The applicant has been transferred.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('The applicant could not be transfer. Please, try again.'));
                    }
                }
            }

        }
        $applicantTypes = $this->Applicants->ApplicantTypes->find('list', ['limit' => 200]);
        $locationTypes = $this->Applicants->LocationTypes->find('list', ['limit' => 200, 'conditions' => ['status' => 1]]);
        $divisions = $this->Applicants->AreaDivisions->find('list', ['limit' => 200]);
        $districts = $this->Applicants->AreaDistricts->find('list', ['limit' => 200]);
        $upazilas = $this->Applicants->AreaUpazilas->find('list', ['limit' => 200]);
        $unions = $this->Applicants->Unions->find('list', ['limit' => 200]);
        $cityCorporations = $this->Applicants->CityCorporations->find('list', ['limit' => 200]);
        $cityCorporationWards = $this->Applicants->CityCorporationWards->find('list', ['limit' => 200]);
        $municipals = $this->Applicants->Municipals->find('list', ['limit' => 200]);
        $municipalWards = $this->Applicants->MunicipalWards->find('list', ['limit' => 200]);
        $this->set(compact('applicant', 'applicantTypes', 'locationTypes', 'divisions', 'districts', 'upazilas', 'unions', 'cityCorporations', 'cityCorporationWards', 'municipals', 'municipalWards'));
        $this->set('_serialize', ['applicant']);
    }

    public function checkApplicant($data)
    {
        $checkApplicant = $this->Applicants->find()
            ->where([
                'location_type_id' => $data['location_type_id'],
                'applicant_type_id' => $data['applicant_type_id'],
                'division_id' => $data['division_id'],
                'district_id' => $data['district_id'],
                'upazila_id' => $data['upazila_id'],
                'city_corporation_id' => $data['city_corporation_id'],
                'status' => 1
            ]);
        if ($checkApplicant->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function ajax($action = null)
    {
        if ($action == 'get_applicantTypes') {

            $location_type_id = $this->request->data('location_type_id');
            $this->loadModel('ApplicantTypes');
            $application_types = $this->ApplicantTypes->find('list')
                ->where(['type' => $location_type_id, 'status' => 1])
                ->toArray();
            $this->response->body(json_encode($application_types));
            return $this->response;
        } elseif ($action == 'get_districts') {

            $division_id = $this->request->data('division_id');
            $this->loadModel('AreaDistricts');
            $districts = $this->AreaDistricts->find('list', ['keyField' => 'zillaid', 'keyValue' => 'zillaname'])
                ->where(['divid' => $division_id])
                ->toArray();
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
