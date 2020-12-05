<?php
namespace MonthlyBasis\GroupTest\Model\Table;

use MonthlyBasis\Group\Model\Table as GroupTable;
use MonthlyBasis\LaminasTest\TableTestCase;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;
use Zend\Db\Adapter\Exception\InvalidQueryException;

class GroupTest extends TableTestCase
{
    protected function setUp(): void
    {
        $this->dropAndCreateTable('group');

        $this->groupTable = new GroupTable\Group($this->getAdapter());
    }

    public function testSelectCount()
    {
        $this->assertSame(
            0,
            $this->groupTable->selectCount()
        );
    }
}
