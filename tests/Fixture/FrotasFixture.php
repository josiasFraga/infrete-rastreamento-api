<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FrotasFixture
 */
class FrotasFixture extends TestFixture
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
                'usuario_id' => 1,
                'created' => '2023-02-06 19:50:25',
                'modified' => '2023-02-06 19:50:25',
                'serial' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
