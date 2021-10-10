<?php
namespace MonthlyBasis\GroupsTest\Model\Service\Groups;

use Generator;
use MonthlyBasis\Group\Model\Entity as GroupEntity;
use MonthlyBasis\Group\Model\Factory as GroupFactory;
use MonthlyBasis\Group\Model\Service as GroupService;
use MonthlyBasis\Group\Model\Table as GroupTable;
use MonthlyBasis\User\Model\Entity as UserEntity;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        $this->groupFactoryMock = $this->createMock(
            GroupFactory\Group::class
        );
        $this->groupUserTableMock = $this->createMock(
            GroupTable\GroupUser::class
        );
        $this->userService = new GroupService\Groups\User(
            $this->groupFactoryMock,
            $this->groupUserTableMock
        );
    }

    public function test_getGroups()
    {
        $userEntity = new UserEntity\User();
        $userEntity->setUserId(123);
        $this->groupUserTableMock->method('selectWhereUserId')->willReturn(
            $this->yieldArrays()
        );
        $this->groupFactoryMock->method('buildFromArray')->will(
            $this->onConsecutiveCalls(
                new GroupEntity\Group(),
                new GroupEntity\Group(),
                new GroupEntity\Group()
            )
        );

        $groups = $this->userService->getGroups($userEntity);
        $this->assertInstanceOf(
            Generator::class,
            $groups
        );
        foreach ($groups as $group) {
            $this->assertInstanceOf(
                GroupEntity\Group::class,
                $group
            );
        }
    }

    protected function yieldArrays()
    {
        yield [];
        yield [];
        yield [];
    }
}
