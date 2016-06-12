<?php
namespace App\Model\Table;

use App\Model\Entity\Applicant;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applicants Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $ApplicantTypes
 * @property \Cake\ORM\Association\BelongsTo $LocationTypes
 * @property \Cake\ORM\Association\BelongsTo $Divisions
 * @property \Cake\ORM\Association\BelongsTo $Districts
 * @property \Cake\ORM\Association\BelongsTo $Upazilas
 * @property \Cake\ORM\Association\BelongsTo $Unions
 * @property \Cake\ORM\Association\BelongsTo $CityCorporations
 * @property \Cake\ORM\Association\BelongsTo $CityCorporationWards
 * @property \Cake\ORM\Association\BelongsTo $Municipals
 * @property \Cake\ORM\Association\BelongsTo $MunicipalWards
 * @property \Cake\ORM\Association\HasMany $Applications
 */
class ApplicantsTable extends Table
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

        $this->table('applicants');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ApplicantTypes', [
            'foreignKey' => 'applicant_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('LocationTypes', [
            'foreignKey' => 'location_type_id'
        ]);
        $this->belongsTo('AreaDivisions', [
            'foreignKey' => 'division_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AreaDistricts', [
            'foreignKey' => 'district_id'
        ]);
        $this->belongsTo('AreaUpazilas', [
            'foreignKey' => ['district_id','upazila_id']
        ]);
        $this->belongsTo('Unions', [
            'foreignKey' => 'union_id'
        ]);
        $this->belongsTo('CityCorporations', [
            'foreignKey' => ['city_corporation_id','district_id']
        ]);
        $this->belongsTo('CityCorporationWards', [
            'foreignKey' => 'city_corporation_ward_id'
        ]);
        $this->belongsTo('Municipals', [
            'foreignKey' => ['municipal_id','district_id']
        ]);
        $this->belongsTo('MunicipalWards', [
            'foreignKey' => 'municipal_ward_id'
        ]);
        $this->hasMany('Applications', [
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('union_ward');

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
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator

            ->email('email')
            ->notEmpty('email');

        $validator
            ->allowEmpty('cellphone');

        $validator
            ->allowEmpty('nid');

        $validator
            ->integer('religion')
            ->allowEmpty('religion');

        $validator
            ->allowEmpty('present_address');

        $validator
            ->allowEmpty('permanent_address');

        $validator
            ->allowEmpty('emergency_contact');

        $validator
            ->allowEmpty('pasport_number');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->integer('create_time')
            ->allowEmpty('create_time');

        $validator
            ->integer('update_time')
            ->allowEmpty('update_time');

        $validator
            ->integer('create_by')
            ->allowEmpty('create_by');

        $validator
            ->integer('update_by')
            ->allowEmpty('update_by');

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
       // $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['applicant_type_id'], 'ApplicantTypes'));
        $rules->add($rules->existsIn(['location_type_id'], 'LocationTypes'));
        $rules->add($rules->existsIn(['division_id'], 'AreaDivisions'));
        $rules->add($rules->existsIn(['district_id'], 'AreaDistricts'));
      //  $rules->add($rules->existsIn(['district_id','upazila_id'], 'AreaUpazilas'));
      //  $rules->add($rules->existsIn(['union_id'], 'Unions'));
      //  $rules->add($rules->existsIn(['city_corporation_id','district_id'], 'CityCorporations'));
      //  $rules->add($rules->existsIn(['city_corporation_ward_id'], 'CityCorporationWards'));
       // $rules->add($rules->existsIn(['municipal_id','district_id'], 'Municipals'));
      //  $rules->add($rules->existsIn(['municipal_ward_id'], 'MunicipalWards'));
        return $rules;
    }
}
