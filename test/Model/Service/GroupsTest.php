<?php
namespace LeoGalleguillos\GroupsTest\Model\Service;

use Generator;
use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Service as GroupService;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\User\Model\Entity as UserEntity;
use PHPUnit\Framework\TestCase;

class GroupsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->groupFactoryMock = $this->createMock(
            GroupFactory\Group::class
        );
        $this->groupUserTableMock = $this->createMock(
            GroupTable\GroupUser::class
        );
        $this->groupsService = new GroupService\Groups(
            $this->groupFactoryMock,
            $this->groupUserTableMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            GroupService\Groups::class,
            $this->groupsService
        );
    }

    public function testGetGroups()
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

        $groups = $this->groupsService->getGroups($userEntity);
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
