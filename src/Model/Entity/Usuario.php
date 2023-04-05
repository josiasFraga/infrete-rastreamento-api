<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Security;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $nome
 * @property string $cnpj
 * @property string $email
 * @property string $senha
 * @property string $nivel
 *
 * @property \App\Model\Entity\Frota[] $frotas
 */
class Usuario extends Entity
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
        'created' => true,
        'modified' => true,
        'nome' => true,
        'cnpj' => true,
        'email' => true,
        'senha' => true,
        'frotas' => true,
        'nivel' => true,
    ];
    protected $_hidden = [
        'senha',
    ];

    protected function _setSenha($password)
    {
        if (strlen($password) > 0) {
          return Security::hash($password, 'sha256', true);
        }
    }
}
