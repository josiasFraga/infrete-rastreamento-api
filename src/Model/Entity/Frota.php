<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Frota Entity
 *
 * @property int $id
 * @property int $usuario_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $serial
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Trace[] $traces
 */
class Frota extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'usuario_id' => true,
        'created' => true,
        'modified' => true,
        'serial' => true,
        'placa' => true,
        'usuario' => true,
        'traces' => true,
    ];
}
