<?php
namespace App\Model\Table;

use App\Model\Entity\Union;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Unions Model
 *
 */
class UnionsTable extends Table
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

        $this->table('unions');
        $this->displayField('unionname');
        $this->primaryKey('rowid');

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
            ->allowEmpty('zillaid');

        $validator
            ->allowEmpty('upazilaid');

        $validator
            ->allowEmpty('unionid');

        $validator
            ->allowEmpty('municipalid');

        $validator
            ->allowEmpty('unionname');

        $validator
            ->allowEmpty('unionnameeng');

        $validator
            ->add('visible', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('visible');

        $validator
            ->add('ver_code', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('ver_code');

        return $validator;
    }
}
