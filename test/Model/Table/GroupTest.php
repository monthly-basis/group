<?php
namespace LeoGalleguillos\GroupTest\Model\Table;

use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\Test\TableTestCase;
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
