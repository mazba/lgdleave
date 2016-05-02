<?php
namespace App\Model\Table;

use App\Model\Entity\AreaDistrict;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AreaDistricts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AreaDivisions
 * @property \Cake\ORM\Association\BelongsTo $AreaZones
 * @property \Cake\ORM\Association\HasMany $AreaUpazilas
 */
class AreaDistrictsTable extends Table
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

        $this->table('zillas');
        $this->displayField('zillaname');
        $this->primaryKey('zillaid');

        $this->belongsTo('AreaDivisions', [
            'foreignKey' => 'divid',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('AreaUpazilas', [
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
            ->allowEmpty('id', 'create');

        $validator
            ->add('dglr_code', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('dglr_code');

        $validator
            ->requirePresence('name_en', 'create')
            ->notEmpty('name_en');

        $validator
            ->requirePresence('name_bn', 'create')
            ->notEmpty('name_bn');

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
            ->allowEmpty('updated_by');

        $validator
            ->add('updated_date', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('updated_date');

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
        return $rules;
    }
}
