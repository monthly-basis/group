<?php
namespace LeoGalleguillos\GroupTest\Model\Table;

use Generator;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\GroupTest\TableTestCase;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;
use Zend\Db\Adapter\Exception\InvalidQueryException;

class GroupUserTest extends TableTestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/leogalle_test/group/';

    protected function setUp()
    {
        $configArray     = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray     = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter   = new Adapter($configArray);

        $this->setForeignKeyChecks0();
        $this->dropTables();
        $this->createTables();
        $this->setForeignKeyChecks1();

        $this->groupUserTable = new GroupTable\GroupUser($this->adapter);
    }

    protected function dropTables()
    {
        $sql = file_get_contents($this->sqlDirectory . '/leogalle_test/group_user/drop.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    protected function createTables()
    {
        $sql = file_get_contents($this->sqlDirectory . '/leogalle_test/group_user/create.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            GroupTable\GroupUser::class,
            $this->groupUserTable
        );
    }

    public function testInsertAndSelectCount()
    {
        $this->assertSame(
            0,
            $this->groupUserTable->selectCount()
        );

        $this->groupUserTable->insert(1, 1);
        $this->assertSame(
            1,
            $this->groupUserTable->selectCount()
        );

        $this->groupUserTable->insert(1, 2);
        $this->assertSame(
            2,
            $this->groupUserTable->selectCount()
        );
    }

    public function testSelectWhereUserId()
    {
        $this->groupUserTable->insert(
            1,
            1
        );
        $this->groupUserTable->insert(
            16,
            1
        );
        $this->groupUserTable->insert(
            32,
            2
        );
        $this->groupUserTable->insert(
            64,
            1
        );

        $rows = $this->groupUserTable->selectWhereUserId(1);
        $this->assertInstanceOf(
            Generator::class,
            $rows
        );

        $groupIds = [];
        foreach ($rows as $row) {
            $groupIds[] = $row['group_id'];
        }
        $this->assertEquals(
            [1, 16, 64],
            $groupIds
        );
    }
}
