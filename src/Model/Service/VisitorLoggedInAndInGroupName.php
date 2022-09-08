<?php
namespace MonthlyBasis\Group\Model\Service;

use Exception;
use MonthlyBasis\Group\Model\Factory as GroupFactory;
use MonthlyBasis\Group\Model\Service as GroupService;
use MonthlyBasis\User\Model\Service as UserService;

class VisitorLoggedInAndInGroupName
{
    protected array $cache = [];

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
        if (isset($this->cache[$groupName])) {
            return $this->cache[$groupName];
        }

        try {
            $userEntity = $this->loggedInUserService->getLoggedInUser();
        } catch (Exception $exception) {
            return false;
        }

        $groupEntity = $this->groupFactory->buildFromName(
            $groupName
        );

        $bool = $this->isUserInGroupService->isUserInGroup(
            $userEntity,
            $groupEntity
        );
        $this->cache[$groupName] = $bool;
        return $bool;
    }
}
