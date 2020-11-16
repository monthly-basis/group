<?php
namespace LeoGalleguillos\GroupsTest\Model\Service;

use Exception;
use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Service as GroupService;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\User\Model\Entity as UserEntity;
use LeoGalleguillos\User\Model\Service as UserService;
use PHPUnit\Framework\TestCase;

class VisitorLoggedInAndInGroupNameTest extends TestCase
{
    protected function setUp(): void
    {
        $this->groupFactoryMock = $this->createMock(
            GroupFactory\Group::class
        );
        $this->isUserInGroupServiceMock = $this->createMock(
            GroupService\IsUserInGroup::class
        );
        $this->loggedInUserServiceMock = $this->createMock(
            UserService\LoggedInUser::class
        );

        $this->visitorLoggedInAndInGroupNameService = new GroupService\VisitorLoggedInAndInGroupName(
            $this->groupFactoryMock,
            $this->isUserInGroupServiceMock,
            $this->loggedInUserServiceMock
        );
    }

    public function test_isVisitorLoggedInAndInGroupName_visitorNotLoggedIn_false()
    {
        $this->loggedInUserServiceMock
            ->expects($this->once())
            ->method('getLoggedInUser')
            ->will($this->throwException(new Exception()));

        $this->assertFalse(
            $this->visitorLoggedInAndInGroupNameService->isVisitorLoggedInAndInGroupName(
                'Tutor'
            )
        );
    }

    public function test_isVisitorLoggedInAndInGroupName_visitorLoggedInAndNotInGroup_false()
    {
        $this->loggedInUserServiceMock
            ->expects($this->once())
            ->method('getLoggedInUser');
        $this->isUserInGroupServiceMock
            ->expects($this->once())
            ->method('isUserInGroup')
            ->willReturn(false);

        $this->assertFalse(
            $this->visitorLoggedInAndInGroupNameService->isVisitorLoggedInAndInGroupName(
                'Tutor'
            )
        );
    }

    public function test_isVisitorLoggedInAndInGroupName_visitorLoggedInAndInGroup_true()
    {
        $this->loggedInUserServiceMock
            ->expects($this->once())
            ->method('getLoggedInUser');
        $this->isUserInGroupServiceMock
            ->expects($this->once())
            ->method('isUserInGroup')
            ->willReturn(true);

        $this->assertTrue(
            $this->visitorLoggedInAndInGroupNameService->isVisitorLoggedInAndInGroupName(
                'Tutor'
            )
        );
    }
}
