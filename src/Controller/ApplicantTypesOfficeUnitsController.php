<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;
use Cake\ORM\TableRegistry;

/**
 * ApplicantTypesOfficeUnits Controller
 *
 * @property \App\Model\Table\ApplicantTypesOfficeUnitsTable $ApplicantTypesOfficeUnits
 */
class ApplicantTypesOfficeUnitsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $user = $this->Auth->user();
        $unitTable = TableRegistry::get('office_units');
        $units = $unitTable->find()
            ->where(['office_id'=>$user['office_id']]);
        $this->set(compact('units'));
        $this->set('_serialize', ['units']);
    }

    /**
     * View method
     *
     * @param string|null $id Applicant Types Office Unit id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ApplicantTypesOfficeUnits = $this->ApplicantTypesOfficeUnits->find()
            ->where(['office_unit_id'=>$id])
            ->contain(['ApplicantTypes','OfficeUnits']);
        $this->set('applicantTypesOfficeUnit', $ApplicantTypesOfficeUnits);
        $this->set('_serialize', ['applicantTypesOfficeUnit']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Types Office Unit id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function assign($id = null)
    {
        $old_types = $this->ApplicantTypesOfficeUnits->find()
            ->where(['office_unit_id'=>$id]);
        if($old_types) {
            $collection = new Collection($old_types);
            $old_types = $collection->extract('applicant_type_id');
            $old_types = $old_types->toArray();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inputs = $this->request->data;
            //delete old data
            $this->ApplicantTypesOfficeUnits->deleteAllByUnit($id);
            //insert new data
            foreach($inputs['application_types'] as $input){
                $ApplicantTypesOfficeUnits=$this->ApplicantTypesOfficeUnits->newEntity();
                $ApplicantTypesOfficeUnits->applicant_type_id=$input;
                $ApplicantTypesOfficeUnits->office_unit_id=$id;
                if ($this->ApplicantTypesOfficeUnits->save($ApplicantTypesOfficeUnits));
            }
            $this->Flash->success('The Data has been saved.');
            return $this->redirect(['action' => 'index']);
        }
        $applicantTypes = $this->ApplicantTypesOfficeUnits->ApplicantTypes->find();
        $OfficeUnit = $this->ApplicantTypesOfficeUnits->OfficeUnits->get($id);
        $this->set(compact('old_types', 'applicantTypes','OfficeUnit'));
        $this->set('_serialize', ['applicantTypesOfficeUnit']);
    }
}
