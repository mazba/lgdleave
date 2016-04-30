<?php
namespace App\Model\Table;

use App\Model\Entity\UserDesignation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserDesignations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Offices
 * @property \Cake\ORM\Association\BelongsTo $OfficeUnits
 * @property \Cake\ORM\Association\BelongsTo $Designations
 */
class UserDesignationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('user_designations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('OfficeUnits', [
            'foreignKey' => 'office_unit_id'
        ]);
        $this->belongsTo('Designations', [
            'foreignKey' => 'designation_id',
            'joinType' => 'INNER'
        ]);
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
//
//        $validator
//            ->add('is_basic', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('is_basic');
//
//        $validator
//            ->add('designation_order', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('designation_order');
//
//        $validator
//            ->add('starting_date', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('starting_date');
//
//        $validator
//            ->add('ending_date', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('ending_date');
//
//        $validator
//            ->add('status', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('status');
//
//        $validator
//            ->add('create_time', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('create_time');
//
//        $validator
//            ->add('update_time', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('update_time');
//
//        $validator
//            ->add('create_by', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('create_by');
//
//        $validator
//            ->add('update_by', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('update_by');
//
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['office_id'], 'Offices'));
        $rules->add($rules->existsIn(['office_unit_id'], 'OfficeUnits'));
        $rules->add($rules->existsIn(['designation_id'], 'Designations'));
        return $rules;
    }
}
