<?php
namespace App\Model\Table;

use App\Model\Entity\ApplicantTypesOfficeUnit;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicantTypesOfficeUnits Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ApplicantTypes
 * @property \Cake\ORM\Association\BelongsTo $OfficeUnits
 */
class ApplicantTypesOfficeUnitsTable extends Table
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

        $this->table('applicant_types_office_units');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('ApplicantTypes', [
            'foreignKey' => 'applicant_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('OfficeUnits', [
            'foreignKey' => 'office_unit_id',
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
        $rules->add($rules->existsIn(['applicant_type_id'], 'ApplicantTypes'));
        $rules->add($rules->existsIn(['office_unit_id'], 'OfficeUnits'));
        return $rules;
    }
}
