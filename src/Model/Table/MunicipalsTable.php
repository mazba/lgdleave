<?php
namespace App\Model\Table;

use App\Model\Entity\Municipal;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Municipals Model
 *
 * @property \Cake\ORM\Association\HasMany $Applications
 */
class MunicipalsTable extends Table
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

        $this->table('municipals');
        $this->displayField('municipalname');
        $this->primaryKey('rowid');

        $this->hasMany('Applications', [
            'foreignKey' => 'municipal_id'
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
            ->allowEmpty('municipalid');

        $validator
            ->allowEmpty('zillaid');

        $validator
            ->allowEmpty('upazilaid');

        $validator
            ->allowEmpty('municipalname');

        $validator
            ->allowEmpty('municipaleng');

        $validator
            ->add('visible', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('visible');

        $validator
            ->requirePresence('ver_code', 'create')
            ->notEmpty('ver_code');

        return $validator;
    }
}
