<?php
namespace LeoGalleguillos\Group\Model\Service;

use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Service as GroupService;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\User\Model\Entity as UserEntity;
use LeoGalleguillos\User\Model\Service as UserService;

class IsUserLoggedInAndInGroupName
{
    public function __construct(
        GroupFactory\Group $groupFactory,
        GroupService\IsUserInGroup $isUserInGroupService,
        UserService\LoggedIn $loggedInService,
        UserService\LoggedInUser $loggedInUserService
    ) {
        $this->groupFactory         = $groupFactory;
        $this->isUserInGroupService = $isUserInGroupService;
        $this->loggedInService      = $loggedInService;
        $this->loggedInUserService  = $loggedInUserService;
    }

    public function isUserLoggedInAndInGroupName(
        string $groupName
    ): bool {
        if (!$this->loggedInService->isLoggedIn()) {
            return false;
        }

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
