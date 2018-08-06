<?php
namespace LeoGalleguillos\GroupTest\Model\Table;

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

    public function testSelectCount()
    {
        $this->assertSame(
            0,
            $this->groupUserTable->selectCount()
        );
    }
}
