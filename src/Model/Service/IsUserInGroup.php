<?php
namespace MonthlyBasis\Group\Model\Service;

use MonthlyBasis\Group\Model\Entity as GroupEntity;
use MonthlyBasis\Group\Model\Table as GroupTable;
use MonthlyBasis\User\Model\Entity as UserEntity;

class IsUserInGroup
{
    public function __construct(
        GroupTable\GroupUser $groupUserTable
    ) {
        $this->groupUserTable = $groupUserTable;
    }

    public function isUserInGroup(
        UserEntity\User $userEntity,
        GroupEntity\Group $groupEntity
    ): bool {
        return (bool) $this->groupUserTable->selectCountWhereGroupIdAndUserId(
            $groupEntity->getGroupId(),
            $userEntity->getUserId()
        );
    }
}
