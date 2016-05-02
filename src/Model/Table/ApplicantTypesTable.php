<?php
namespace App\Model\Table;

use App\Model\Entity\ApplicantType;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicantTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Applications
 */
class ApplicantTypesTable extends Table
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

        $this->table('applicant_types');
        $this->displayField('title_bn');
        $this->primaryKey('id');

        $this->hasMany('Applications', [
            'foreignKey' => 'applicant_type_id'
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
            ->add('type', 'valid', ['rule' => 'boolean'])
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->add('order', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('order');

        $validator
            ->requirePresence('title_bn', 'create')
            ->notEmpty('title_bn');

        $validator
            ->allowEmpty('title_en');

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
