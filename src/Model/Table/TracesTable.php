<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Traces Model
 *
 * @property \App\Model\Table\FrotasTable&\Cake\ORM\Association\BelongsTo $Frotas
 *
 * @method \App\Model\Entity\Trace newEmptyEntity()
 * @method \App\Model\Entity\Trace newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Trace[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Trace get($primaryKey, $options = [])
 * @method \App\Model\Entity\Trace findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Trace patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Trace[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Trace|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Trace saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Trace[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Trace[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Trace[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Trace[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TracesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('traces');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Frotas', [
            'foreignKey' => 'frota_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('frota_id')
            ->notEmptyString('frota_id');

        $validator
            ->scalar('response')
            ->requirePresence('response', 'create')
            ->notEmptyString('response');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('frota_id', 'Frotas'), ['errorField' => 'frota_id']);

        return $rules;
    }
}
