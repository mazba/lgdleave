<?php
namespace App\Model\Table;

use App\Model\Entity\CityCorporationWard;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CityCorporationWards Model
 *
 * @property \Cake\ORM\Association\HasMany $Applications
 */
class CityCorporationWardsTable extends Table
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

        $this->table('city_corporation_wards');
        $this->displayField('wardname');
        $this->primaryKey('rowid');

        $this->hasMany('Applications', [
            'foreignKey' => 'city_corporation_ward_id'
        ]);
        $this->belongsTo('AreaDivisions',[
            'foreignKey'=>'divid'
        ]);
        $this->belongsTo('AreaDistricts',[
            'foreignKey'=>'zillaid'
        ]);
        $this->belongsTo('CityCorporations',[
            'foreignKey'=>'citycorporationid'
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
            ->add('rowid', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('rowid', 'create');

        $validator
            ->allowEmpty('citycorporationwardid');

        $validator
            ->allowEmpty('divid');

        $validator
            ->allowEmpty('zillaid');

        $validator
            ->allowEmpty('citycorporationid');

        $validator
            ->allowEmpty('upazilaid');

        $validator
            ->allowEmpty('wardname');

        $validator
            ->allowEmpty('wardnameeng');

        $validator
            ->add('visible', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('visible');

        $validator
            ->allowEmpty('ver_code');

        return $validator;
    }
}
