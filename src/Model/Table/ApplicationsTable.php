<?php
namespace App\Model\Table;

use App\Model\Entity\Application;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Temporaries
 * @property \Cake\ORM\Association\BelongsTo $ApplicationTypes
 * @property \Cake\ORM\Association\BelongsTo $ApplicantTypes
 * @property \Cake\ORM\Association\BelongsTo $LocationTypes
 */
class ApplicationsTable extends Table
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

        $this->table('applications');
        $this->displayField('id');
        $this->primaryKey(['id', 'temporary_id']);

        $this->belongsTo('Temporaries', [
            'foreignKey' => 'temporary_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ApplicationTypes', [
            'foreignKey' => 'application_type_id'
        ]);
        $this->belongsTo('ApplicantTypes', [
            'foreignKey' => 'applicant_type_id'
        ]);
        $this->belongsTo('LocationTypes', [
            'foreignKey' => 'location_type_id'
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
            ->add('submission_time', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('submission_time');

        $validator
            ->allowEmpty('location_geo_code');

        $validator
            ->allowEmpty('applicant_name_bn');

        $validator
            ->allowEmpty('applicant_name_en');

        $validator
            ->allowEmpty('mother_name_bn');

        $validator
            ->allowEmpty('mother_name_en');

        $validator
            ->allowEmpty('father_name_bn');

        $validator
            ->allowEmpty('father_name_en');

        $validator
            ->allowEmpty('phone');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->allowEmpty('email');

        $validator
            ->allowEmpty('cellphone');

        $validator
            ->allowEmpty('nid');

        $validator
            ->allowEmpty('brn');

        $validator
            ->add('religion', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('religion');

        $validator
            ->allowEmpty('present_address');

        $validator
            ->allowEmpty('permanent_address');

        $validator
            ->allowEmpty('emergency_contact');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('status');

        $validator
            ->add('create_time', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('create_time');

        $validator
            ->add('update_time', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('update_time');

        $validator
            ->add('create_by', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('create_by');

        $validator
            ->add('update_by', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('update_by');

        $validator
            ->add('is_foregin_tour', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('is_foregin_tour');

        $validator
            ->allowEmpty('pasport_number');

        $validator
            ->allowEmpty('foregin_tour_country');

        $validator
            ->add('have_foregin_tour', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('have_foregin_tour');

        $validator
            ->allowEmpty('last_foreign_tour_country');

        $validator
            ->add('last_foreign_tour_time', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('last_foreign_tour_time');

        $validator
            ->allowEmpty('application_reason');

        $validator
            ->allowEmpty('document_file');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['temporary_id'], 'Temporaries'));
        $rules->add($rules->existsIn(['application_type_id'], 'ApplicationTypes'));
        $rules->add($rules->existsIn(['applicant_type_id'], 'ApplicantTypes'));
        $rules->add($rules->existsIn(['location_type_id'], 'LocationTypes'));
        return $rules;
    }
}
