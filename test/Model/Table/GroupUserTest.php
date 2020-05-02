<?php
namespace LeoGalleguillos\GroupTest\Model\Table;

use Generator;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\Test\TableTestCase;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;
use Zend\Db\Adapter\Exception\InvalidQueryException;

class GroupUserTest extends TableTestCase
{
    protected function setUp()
    {
        $this->dropAndCreateTables(['group', 'group_user']);

        $this->groupTable     = new GroupTable\Group($this->getAdapter());
        $this->groupUserTable = new GroupTable\GroupUser($this->getAdapter());
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

    public function test_selectCountWhereGroupNameAndUserId_multipleRows_variousResults()
    {
        $this->assertSame(
            '0',
            $this->groupUserTable
                ->selectCountWhereGroupNameAndUserId('Tutor', 123)
                ->current()['count']
        );

        $this->groupTable->insert('Webmaster');
        $this->groupTable->insert('Admin');
        $this->groupUserTable->insert(1, 123);
        $this->groupUserTable->insert(2, 123);
        $this->groupUserTable->insert(2, 456);

        $this->assertSame(
            '1',
            $this->groupUserTable
                ->selectCountWhereGroupNameAndUserId('Webmaster', 123)
                ->current()['count']
        );
        $this->assertSame(
            '1',
            $this->groupUserTable
                ->selectCountWhereGroupNameAndUserId('Admin', 123)
                ->current()['count']
        );
        $this->assertSame(
            '0',
            $this->groupUserTable
                ->selectCountWhereGroupNameAndUserId('Webmaster', 456)
                ->current()['count']
        );
        $this->assertSame(
            '1',
            $this->groupUserTable
                ->selectCountWhereGroupNameAndUserId('Admin', 456)
                ->current()['count']
        );
    }

    public function testSelectWhereUserId()
    {
        $this->groupTable->insert('foo');
        $this->groupTable->insert('bar');
        $this->groupTable->insert('baz');
        $this->groupUserTable->insert(
            1,
            1
        );
        $this->groupUserTable->insert(
            2,
            1
        );
        $this->groupUserTable->insert(
            3,
            2
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
            [2, 1],
            $groupIds
        );
    }
}
