<?php
namespace App\Model\Table;

use App\Model\Entity\ApplicationType;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicationTypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentApplicationTypes
 * @property \Cake\ORM\Association\HasMany $ChildApplicationTypes
 * @property \Cake\ORM\Association\HasMany $Applications
 * @property \Cake\ORM\Association\HasMany $ApplicationsCopy
 */
class ApplicationTypesTable extends Table
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

        $this->table('application_types');
        $this->displayField('title_bn');
        $this->primaryKey('id');

        $this->belongsTo('ParentApplicationTypes', [
            'className' => 'ApplicationTypes',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildApplicationTypes', [
            'className' => 'ApplicationTypes',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'application_type_id'
        ]);
        $this->hasMany('ApplicationsCopy', [
            'foreignKey' => 'application_type_id'
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
            ->allowEmpty('title_bn');

        $validator
            ->allowEmpty('title_en');

        $validator
            ->allowEmpty('description');

        $validator
            ->add('status', 'valid', ['rule' => 'boolean'])
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['parent_id'], 'ParentApplicationTypes'));
        return $rules;
    }
}
