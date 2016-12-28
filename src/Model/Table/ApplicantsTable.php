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
 * @property \Cake\ORM\Association\HasMany $ApplicationsOldAntu
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
            'foreignKey' => 'location_type_id',
            'joinType' => 'INNER'
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
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('union_ward');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('create_time');

        $validator
            ->allowEmpty('update_time');

        $validator
            ->allowEmpty('create_by');

        $validator
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['applicant_type_id'], 'ApplicantTypes'));
        $rules->add($rules->existsIn(['location_type_id'], 'LocationTypes'));
        $rules->add($rules->existsIn(['division_id'], 'AreaDivisions'));
        $rules->add($rules->existsIn(['district_id'], 'AreaDistricts'));
//        $rules->add($rules->existsIn(['upazila_id'], 'Upazilas'));
//        $rules->add($rules->existsIn(['union_id'], 'Unions'));
//        $rules->add($rules->existsIn(['city_corporation_id'], 'CityCorporations'));
//        $rules->add($rules->existsIn(['city_corporation_ward_id'], 'CityCorporationWards'));
//        $rules->add($rules->existsIn(['municipal_id'], 'Municipals'));
//        $rules->add($rules->existsIn(['municipal_ward_id'], 'MunicipalWards'));
        return $rules;
    }
}
