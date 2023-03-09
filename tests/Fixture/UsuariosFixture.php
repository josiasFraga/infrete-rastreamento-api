<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsuariosFixture
 */
class UsuariosFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'created' => '2023-02-06 19:50:41',
                'modified' => '2023-02-06 19:50:41',
                'nome' => 'Lorem ipsum dolor sit amet',
                'cnpj' => 'Lorem ipsum dolor ',
                'email' => 'Lorem ipsum dolor sit amet',
                'senha' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
