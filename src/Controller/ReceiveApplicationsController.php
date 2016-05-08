<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Collection\Collection;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;


/**
 * ReceiveApplications Controller
 *
 * @property \App\Model\Table\ReceiveApplicationsTable $ReceiveApplications
 */
class ReceiveApplicationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        if($this->request->is('ajax')){
            $user = $this->Auth->user();
            $usrUnits = TableRegistry::get('user_designations');
            $userUnits = $usrUnits->find()
                ->select(['office_unit_id'])
                ->where(['user_id'=>$user['id'],'is_basic IS'=>null]);
            $collection = new Collection($userUnits);
            $userUnits = $collection->extract('office_unit_id');
            $userUnits = $userUnits->toArray();

            $applicantType = TableRegistry::get('applicant_types_office_units');
            $applicantType = $applicantType->find()
                ->where(['office_unit_id IN'=>$userUnits]);
            $collection = new Collection($applicantType);
            $applicantType = $collection->extract('applicant_type_id');
            $applicantTypes = $applicantType->toArray();
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
                        'id'=>'Applications.id',
                        'temporary_id'=>'Applications.temporary_id',
                        'submission'=>"FROM_UNIXTIME(Applications.submission_time,'%D, %M, %Y')",
                    ]
                )
                ->where(
                    [
                        'Applications.status'=>Configure::read('application_status.Pending'),
                        'Applications.applicant_type_id IN'=>$applicantTypes
                    ]
                )
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
        $this->loadModel('Applications');
        $Application = $this->Applications->get($id, [
            'contain' => []
        ]);
        $this->set('Application', $Application);
        $this->set('_serialize', ['Application']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function receive($id)
    {
        $this->loadModel('Applications');
        $application = $this->Applications->get($id, [
            'contain' => [
                'ApplicationTypes',
                'ApplicantTypes',
                'LocationTypes',
                'AreaDivisions',
                'AreaDistricts',
                'AreaUpazilas',
                'CityCorporations',
                'Municipals',
                'Unions',
                'ApplicationsFiles'
            ]
        ]);
        if ($this->request->is('post')) {
            $inputs = $this->request->data;

            $receiveApplication = $this->Applications->patchEntity($application,['status'=>$inputs['status']]);
            if ($this->Applications->save($receiveApplication)) {
                $this->Flash->success(__('The receive application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The receive application could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('application'));
        $this->set('_serialize', ['application']);
    }
    /*
     * pdf view
     */
    public function pdfView($id){
        $this->loadModel('Applications');
        $application = $this->Applications->get($id, [
            'contain' => [
                'ApplicationTypes',
                'ApplicantTypes',
                'LocationTypes',
                'AreaDivisions',
                'AreaDistricts',
                'AreaUpazilas',
                'CityCorporations',
                'Municipals',
                'Unions',
                'ApplicationsFiles'
            ]
        ]);
        //generating the pdf
        Configure::write('CakePdf', [
            'engine' => [
                'className'=>'CakePdf.Mpdf',
//                'binary' => 'C:\\wkhtmltopdf2\\bin\\wkhtmltopdf.exe',
                'options' => [
                    'print-media-type' => false,
                    'outline' => true,
                    'dpi' => 96
                ],
            ]
        ]);
        $this->RequestHandler->renderAs($this,'pdf');
        $this->request->env('HTTP_ACCEPT','application/pdf');
        $this->set(compact('application'));
        $this->set('_serialize', ['application']);
    }
}
