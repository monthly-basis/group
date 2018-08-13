<?php
namespace LeoGalleguillos\Group\Model\Service;

use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Service as GroupService;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\User\Model\Entity as UserEntity;
use LeoGalleguillos\User\Model\Service as UserService;

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
