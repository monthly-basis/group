<?php
namespace MonthlyBasis\Group\View\Helper;

use MonthlyBasis\Group\Model\Entity as GroupEntity;
use MonthlyBasis\Group\Model\Service as GroupService;
use MonthlyBasis\User\Model\Entity as UserEntity;
use Laminas\View\Helper\AbstractHelper;

class IsUserInGroup extends AbstractHelper
{
    public function __construct(
        GroupService\IsUserInGroup $isUserInGroupService
    ) {
        $this->isUserInGroupService = $isUserInGroupService;
    }

    public function __invoke(
        UserEntity\User $userEntity,
        GroupEntity\Group $groupEntity
    ): bool {
        return $this->isUserInGroupService->isUserInGroup(
            $userEntity,
            $groupEntity
        );
    }
}
