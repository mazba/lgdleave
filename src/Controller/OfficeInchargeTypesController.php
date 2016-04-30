<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OfficeInchargeTypes Controller
 *
 * @property \App\Model\Table\OfficeInchargeTypesTable $OfficeInchargeTypes
 */
class OfficeInchargeTypesController extends AppController
{

	public $paginate = [
        'limit' => 15,
        'order' => [
            'OfficeInchargeTypes.title' => 'desc'
        ]
    ];

/**
* Index method
*
* @return void
*/
public function index()
{
$officeInchargeTypes = $this->OfficeInchargeTypes->find('all', [
'conditions' =>['OfficeInchargeTypes.status !=' => 99]
]);
$this->set('officeInchargeTypes', $this->paginate($officeInchargeTypes) );
$this->set('_serialize', ['officeInchargeTypes']);
}

    /**
     * View method
     *
     * @param string|null $id Office Incharge Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user=$this->Auth->user();
        $officeInchargeType = $this->OfficeInchargeTypes->get($id, [
            'contain' => []
        ]);
        $this->set('officeInchargeType', $officeInchargeType);
        $this->set('_serialize', ['officeInchargeType']);
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
        $officeInchargeType = $this->OfficeInchargeTypes->newEntity();
        if ($this->request->is('post'))
        {

            $data=$this->request->data;
            $data['create_by']=$user['id'];
            $data['create_date']=$time;
            $officeInchargeType = $this->OfficeInchargeTypes->patchEntity($officeInchargeType, $data);
            if ($this->OfficeInchargeTypes->save($officeInchargeType))
            {
                $this->Flash->success('The office incharge type has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The office incharge type could not be saved. Please, try again.');
            }
        }
        $this->set(compact('officeInchargeType'));
        $this->set('_serialize', ['officeInchargeType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office Incharge Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user=$this->Auth->user();
        $time=time();
        $officeInchargeType = $this->OfficeInchargeTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $data=$this->request->data;
            $data['update_by']=$user['id'];
            $data['update_date']=$time;
            $officeInchargeType = $this->OfficeInchargeTypes->patchEntity($officeInchargeType, $data);
            if ($this->OfficeInchargeTypes->save($officeInchargeType))
            {
                $this->Flash->success('The office incharge type has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('The office incharge type could not be saved. Please, try again.');
            }
        }
        $this->set(compact('officeInchargeType'));
        $this->set('_serialize', ['officeInchargeType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office Incharge Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $officeInchargeType = $this->OfficeInchargeTypes->get($id);

        $user=$this->Auth->user();
        $data=$this->request->data;
        $data['updated_by']=$user['id'];
        $data['updated_date']=time();
        $data['status']=99;
        $officeInchargeType = $this->OfficeInchargeTypes->patchEntity($officeInchargeType, $data);
        if ($this->OfficeInchargeTypes->save($officeInchargeType))
        {
            $this->Flash->success('The office incharge type has been deleted.');
        }
        else
        {
            $this->Flash->error('The office incharge type could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
