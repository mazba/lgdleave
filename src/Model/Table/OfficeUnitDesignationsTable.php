<?php
namespace App\Model\Table;

use App\Model\Entity\OfficeUnitDesignation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OfficeUnitDesignations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentOfficeUnitDesignations
 * @property \Cake\ORM\Association\BelongsTo $Offices
 * @property \Cake\ORM\Association\BelongsTo $OfficeUnits
 * @property \Cake\ORM\Association\HasMany $ChildOfficeUnitDesignations
 */
class OfficeUnitDesignationsTable extends Table
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

        $this->table('office_unit_designations');
        $this->displayField('name_bn');
        $this->primaryKey('id');

        $this->belongsTo('ParentOfficeUnitDesignations', [
            'className' => 'OfficeUnitDesignations',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('OfficeUnits', [
            'foreignKey' => 'office_unit_id'
        ]);
        $this->hasMany('ChildOfficeUnitDesignations', [
            'className' => 'OfficeUnitDesignations',
            'foreignKey' => 'parent_id'
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
            ->requirePresence('name_en', 'create')
            ->notEmpty('name_en');

        $validator
            ->requirePresence('name_bn', 'create')
            ->notEmpty('name_bn');

        $validator
            ->add('level_number', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('level_number');

        $validator
            ->add('sequence_number', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('sequence_number');

        $validator
            ->add('post_number', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('post_number');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('status');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['parent_id'], 'ParentOfficeUnitDesignations'));
        $rules->add($rules->existsIn(['office_id'], 'Offices'));
        $rules->add($rules->existsIn(['office_unit_id'], 'OfficeUnits'));
        return $rules;
    }
}
