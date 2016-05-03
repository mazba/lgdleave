<?php
namespace App\Model\Table;

use App\Model\Entity\LocationType;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LocationTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Applications
 * @property \Cake\ORM\Association\HasMany $ApplicationsCopy
 */
class LocationTypesTable extends Table
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

        $this->table('location_types');
        $this->displayField('title_bn');
        $this->primaryKey('id');

        $this->hasMany('Applications', [
            'foreignKey' => 'location_type_id'
        ]);
        $this->hasMany('ApplicationsCopy', [
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
            ->requirePresence('title_bn', 'create')
            ->notEmpty('title_bn');

        $validator
            ->allowEmpty('title_en');

        $validator
            ->requirePresence('code_format', 'create')
            ->notEmpty('code_format');

        $validator
            ->allowEmpty('description');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('status');

        $validator
            ->add('create_time', 'valid', ['rule' => 'numeric'])
            ->requirePresence('create_time', 'create')
            ->notEmpty('create_time');

        $validator
            ->add('update_time', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('update_time');

        $validator
            ->add('create_by', 'valid', ['rule' => 'numeric'])
            ->requirePresence('create_by', 'create')
            ->notEmpty('create_by');

        $validator
            ->add('update_by', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('update_by');

        return $validator;
    }
}
