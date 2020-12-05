<?php
namespace MonthlyBasis\Group\Model\Service;

use Exception;
use MonthlyBasis\Group\Model\Factory as GroupFactory;
use MonthlyBasis\Group\Model\Service as GroupService;
use MonthlyBasis\User\Model\Service as UserService;

class VisitorLoggedInAndInGroupName
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

    public function isVisitorLoggedInAndInGroupName(
        string $groupName
    ): bool {
        try {
            $userEntity = $this->loggedInUserService->getLoggedInUser();
        } catch (Exception $exception) {
            return false;
        }

        $groupEntity = $this->groupFactory->buildFromName(
            $groupName
        );

        return $this->isUserInGroupService->isUserInGroup(
            $userEntity,
            $groupEntity
        );
    }
}
