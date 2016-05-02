<?php
namespace App\Controller;

use App\Controller\AppController;
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
        $applicantTypesOfficeUnit = $this->ApplicantTypesOfficeUnits->get($id, [
            'contain' => ['ApplicantTypes', 'OfficeUnits']
        ]);
        $this->set('applicantTypesOfficeUnit', $applicantTypesOfficeUnit);
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
        $applicantTypesOfficeUnit = $this->ApplicantTypesOfficeUnits->find()
            ;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantTypesOfficeUnit = $this->ApplicantTypesOfficeUnits->patchEntity($applicantTypesOfficeUnit, $this->request->data);
            if ($this->ApplicantTypesOfficeUnits->save($applicantTypesOfficeUnit)) {
                $this->Flash->success(__('The applicant types office unit has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant types office unit could not be saved. Please, try again.'));
            }
        }
        $applicantTypes = $this->ApplicantTypesOfficeUnits->ApplicantTypes->find('list', ['limit' => 200]);
        $officeUnits = $this->ApplicantTypesOfficeUnits->OfficeUnits->find('list', ['limit' => 200]);
        $this->set(compact('applicantTypesOfficeUnit', 'applicantTypes', 'officeUnits'));
        $this->set('_serialize', ['applicantTypesOfficeUnit']);
    }
}
