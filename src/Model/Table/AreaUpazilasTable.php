<?php
namespace App\Model\Table;

use App\Model\Entity\AreaUpazila;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AreaUpazilas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AreaDivisions
 * @property \Cake\ORM\Association\BelongsTo $AreaZones
 * @property \Cake\ORM\Association\BelongsTo $AreaDistricts
 */
class AreaUpazilasTable extends Table
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

        $this->table('upa_zilas');
        $this->displayField('upazilaname');
        $this->primaryKey('id');


        $this->belongsTo('AreaDistricts', [
            'foreignKey' => 'zillaid'
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

        $validator
            ->add('dglr_code', 'valid', ['rule' => 'numeric'])
            ->requirePresence('dglr_code', 'create')
            ->notEmpty('dglr_code');

        $validator
            ->requirePresence('name_bn', 'create')
            ->notEmpty('name_bn');

        $validator
            ->allowEmpty('name_en');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->add('created_by', 'valid', ['rule' => 'numeric'])
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->add('created_date', 'valid', ['rule' => 'numeric'])
            ->requirePresence('created_date', 'create')
            ->notEmpty('created_date');

        $validator
            ->add('updated_by', 'valid', ['rule' => 'numeric'])
            ->requirePresence('updated_by', 'create')
            ->notEmpty('updated_by');

        $validator
            ->add('updated_date', 'valid', ['rule' => 'numeric'])
            ->requirePresence('updated_date', 'create')
            ->notEmpty('updated_date');

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
        $rules->add($rules->existsIn(['area_division_id'], 'AreaDivisions'));
        $rules->add($rules->existsIn(['area_zone_id'], 'AreaZones'));
        $rules->add($rules->existsIn(['area_district_id'], 'AreaDistricts'));
        return $rules;
    }
}
