<?php
namespace MonthlyBasis\Group\Model\Service;

use MonthlyBasis\Group\Model\Entity as GroupEntity;
use MonthlyBasis\Group\Model\Factory as GroupFactory;
use MonthlyBasis\Group\Model\Service as GroupService;
use MonthlyBasis\Group\Model\Table as GroupTable;
use MonthlyBasis\User\Model\Entity as UserEntity;
use MonthlyBasis\User\Model\Service as UserService;

class IsLoggedInUserInGroupName
{
    public function __construct(
        GroupFactory\Group $groupFactory,
        GroupService\IsUserInGroup $isUserInGroupService,
        UserService\LoggedInUser $loggedInUserService
    ) {
        $this->groupFactory         = $groupFactory;
        $this->isUserInGroupService = $isUserInGroupService;
        $this->loggedInUserService  = $loggedInUserService;
    }

    public function isLoggedInUserInGroupName(
        string $groupName
    ): bool {
        $userEntity  = $this->loggedInUserService->getLoggedInUser();
        $groupEntity = $this->groupFactory->buildFromName(
            $groupName
        );

        return $this->isUserInGroupService->isUserInGroup(
            $userEntity,
            $groupEntity
        );
    }
}
