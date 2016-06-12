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
 * @property \Cake\ORM\Association\BelongsTo $Divsions
 * @property \Cake\ORM\Association\BelongsTo $Districts
 * @property \Cake\ORM\Association\BelongsTo $Upazilas
 * @property \Cake\ORM\Association\BelongsTo $Unions
 * @property \Cake\ORM\Association\BelongsTo $CityCorporations
 * @property \Cake\ORM\Association\BelongsTo $CityCorporationWards
 * @property \Cake\ORM\Association\BelongsTo $Municipals
 * @property \Cake\ORM\Association\BelongsTo $MunicipalWards
 * @property \Cake\ORM\Association\HasMany $LeaveApplicationDetails
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
        $this->primaryKey(['id']);

        $this->belongsTo('ApplicationTypes', [
            'foreignKey' => 'application_type_id',
            'joinType' => 'INNER'
        ]);
//        $this->belongsTo('ApplicantTypes', [
//            'foreignKey' => 'applicant_type_id',
//            'joinType' => 'INNER'
//        ]);
//        $this->belongsTo('LocationTypes', [
//            'foreignKey' => 'location_type_id'
//        ]);
//        $this->belongsTo('AreaDivisions', [
//            'foreignKey' => 'divsion_id',
//            'joinType' => 'INNER'
//        ]);
//        $this->belongsTo('AreaDistricts', [
//            'foreignKey' => 'district_id'
//        ]);
//        $this->belongsTo('AreaUpazilas', [
//            'foreignKey' => ['district_id','upazila_id']
//        ]);
//        $this->belongsTo('CityCorporations', [
//            'foreignKey' => ['city_corporation_id','district_id']
//        ]);
//        $this->belongsTo('CityCorporationWards', [
//            'foreignKey' => 'city_corporation_ward_id'
//        ]);
//        $this->belongsTo('Municipals', [
//            'foreignKey' => ['municipal_id','district_id']
//        ]);
//        $this->belongsTo('MunicipalWards', [
//            'foreignKey' => 'municipal_ward_id'
//        ]);
//        $this->belongsTo('Unions', [
//            'foreignKey' => 'union_id'
//        ]);
        $this->hasMany('ApplicationsFiles', [
            'foreignKey' => 'application_id'
        ]);
        $this->belongsTo('Applicants', [
            'foreignKey' => 'applicant_id'
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
            ->requirePresence('submission_time', 'create')
            ->notEmpty('submission_time');


        $validator
            ->requirePresence('applicant_name_bn', 'create')
            ->notEmpty('applicant_name_bn');

        $validator
            ->allowEmpty('applicant_name_en');

        $validator
            ->requirePresence('mother_name_bn', 'create')
            ->notEmpty('mother_name_bn');

        $validator
            ->allowEmpty('mother_name_en');

        $validator
            ->requirePresence('father_name_bn', 'create')
            ->notEmpty('father_name_bn');

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
            ->add('is_foregin_tour', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('is_foregin_tour');

        $validator
            ->allowEmpty('pasport_number');

        $validator
            ->add('applicant_using_passport_validity', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('applicant_using_passport_validity');

        $validator
            ->allowEmpty('using_passport_issue_place');

        $validator
            ->allowEmpty('foregin_tour_country');

        $validator
            ->add('have_foregin_tour', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('have_foregin_tour');

        $validator
            ->allowEmpty('last_foreign_tour_country');

        $validator
            ->allowEmpty('last_foreign_tour_reason');

        $validator
            ->add('last_foreign_tour_time', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('last_foreign_tour_time');

        $validator
            ->allowEmpty('application_reason');

        $validator
            ->add('start_date', 'valid', ['rule' => 'numeric'])
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->add('end_date', 'valid', ['rule' => 'numeric'])
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

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

        return $validator;
    }
}
