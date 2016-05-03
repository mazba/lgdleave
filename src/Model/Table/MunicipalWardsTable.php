<?php
namespace App\Model\Table;

use App\Model\Entity\MunicipalWard;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MunicipalWards Model
 *
 * @property \Cake\ORM\Association\HasMany $Applications
 */
class MunicipalWardsTable extends Table
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

        $this->table('municipal_wards');
        $this->displayField('wardname');
        $this->primaryKey('rowid');

        $this->hasMany('Applications', [
            'foreignKey' => 'municipal_ward_id'
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
            ->add('wardid', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('wardid');

        $validator
            ->allowEmpty('zillaid');

        $validator
            ->allowEmpty('upazilaid');

        $validator
            ->allowEmpty('municipalid');

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
