<?php
namespace App\Model\Table;

use App\Model\Entity\AreaDivision;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AreaDivisions Model
 *
 * @property \Cake\ORM\Association\HasMany $AreaDistricts
 * @property \Cake\ORM\Association\HasMany $AreaUpazilas
 */
class AreaDivisionsTable extends Table
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

        $this->table('divisions');
        $this->displayField('divname');
        $this->primaryKey('divid');

        $this->hasMany('AreaDistricts', [
            'foreignKey' => 'divid'
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
}
