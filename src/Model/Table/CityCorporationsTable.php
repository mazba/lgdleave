<?php
namespace App\Model\Table;

use App\Model\Entity\CityCorporation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CityCorporations Model
 *
 * @property \Cake\ORM\Association\HasMany $Applications
 */
class CityCorporationsTable extends Table
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

        $this->table('city_corporations');
        $this->displayField('citycorporationname');
        $this->primaryKey(['citycorporationid','zillaid']);

        $this->hasMany('Applications', [
            'foreignKey' => 'city_corporation_id'
        ]);
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
            ->add('rowid', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('rowid', 'create');

        $validator
            ->allowEmpty('citycorporationid');

        $validator
            ->allowEmpty('upazilaid');

        $validator
            ->allowEmpty('zillaid');

        $validator
            ->allowEmpty('citycorporationname');

        $validator
            ->allowEmpty('citycorporationnameeng');

        $validator
            ->add('visible', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('visible');

        $validator
            ->add('divid', 'valid', ['rule' => 'numeric'])
            ->requirePresence('divid', 'create')
            ->notEmpty('divid');

        return $validator;
    }
}
