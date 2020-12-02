<?php
namespace LeoGalleguillos\Group\Model\Service;

use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Table as GroupTable;
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
