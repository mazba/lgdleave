<?php
namespace App\Model\Table;

use App\Model\Entity\UserLeave;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserLeaves Model
 */
class UserLeavesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('user_leaves');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ResponsibleUsers', [
            'className'=>'Users',
            'foreignKey' => 'responsible_user_id'
        ]);
        $this->belongsTo('ApprovalUsers', [
            'className'=>'Users',
            'foreignKey' => 'approval_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('LeaveStatuses', [
            'foreignKey' => 'leave_status_id',
            'joinType' => 'INNER'
        ]);
        $this->addBehavior('FileUpload',['upload_path'=>'u_load/usr_leaves','field'=>'attach_file']);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->add('start_date', 'valid', ['rule' => 'numeric'])
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');
            
        $validator
            ->add('end_date', 'valid', ['rule' => 'numeric'])
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');
            
        $validator
            ->add('duration', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('duration');

        $validator
            ->add('attach_file', 'valid', ['rule' => ['mimeType', ['image/jpeg', 'image/png','application/msword','application/vnd.ms-excel','application/vnd.ms-powerpoint','application/vnd.oasis.opendocument.text','application/vnd.oasis.opendocument.spreadsheet','application/pdf']]])
            ->allowEmpty('attach_file');
            
        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['office_id'], 'Offices'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['responsible_user_id'], 'ResponsibleUsers'));
        $rules->add($rules->existsIn(['approval_user_id'], 'ApprovalUsers'));
        $rules->add($rules->existsIn(['leave_status_id'], 'LeaveStatuses'));
        return $rules;
    }
}
