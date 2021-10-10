<?php
namespace MonthlyBasis\GroupsTest\Model\Service\Groups;

use Generator;
use MonthlyBasis\Group\Model\Entity as GroupEntity;
use MonthlyBasis\Group\Model\Service as GroupService;
use MonthlyBasis\Group\View\Helper as GroupHelper;
use MonthlyBasis\User\Model\Entity as UserEntity;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        $this->groupEntity1 = new GroupEntity\Group();
        $this->groupEntity2 = new GroupEntity\Group();

        $this->userServiceMock = $this->createMock(
            GroupService\Groups\User::class
        );

        $this->userHelper = new GroupHelper\Groups\User(
            $this->userServiceMock
        );
    }

    public function test___invoke_userEntity_groupEntities()
    {
        $userEntity = (new UserEntity\User())
            ->setUserId(123)
            ;
        $this->userServiceMock
             ->expects($this->once())
             ->method('getUserGroups')
             ->with($userEntity)
             ->willReturn($this->yieldGroupEntities());
             ;
        $generator = $this->userHelper->__invoke($userEntity);
        $groupEntities = iterator_to_array($generator);
        $this->assertSame(
            [
                $this->groupEntity1,
                $this->groupEntity2,
            ],
            $groupEntities,
        );
    }

    protected function yieldGroupEntities()
    {
        yield $this->groupEntity1;
        yield $this->groupEntity2;
    }
}
