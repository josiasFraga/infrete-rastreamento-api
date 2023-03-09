<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FrotasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FrotasTable Test Case
 */
class FrotasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FrotasTable
     */
    protected $Frotas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Frotas',
        'app.Usuarios',
        'app.Traces',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Frotas') ? [] : ['className' => FrotasTable::class];
        $this->Frotas = $this->getTableLocator()->get('Frotas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Frotas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FrotasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FrotasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
