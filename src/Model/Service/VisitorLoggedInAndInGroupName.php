<?php
namespace LeoGalleguillos\Group\Model\Service;

use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Service as GroupService;
use LeoGalleguillos\User\Model\Service as UserService;

class VisitorLoggedInAndInGroupName
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

    public function isVisitorLoggedInAndInGroupName(
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
