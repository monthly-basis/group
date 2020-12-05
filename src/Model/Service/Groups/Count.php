<?php
namespace MonthlyBasis\Group\Model\Service\Groups;

use Generator;
use MonthlyBasis\Group\Model\Entity as GroupEntity;
use MonthlyBasis\Group\Model\Factory as GroupFactory;
use MonthlyBasis\Group\Model\Table as GroupTable;
use MonthlyBasis\User\Model\Entity as UserEntity;

class Count
{
    public function __construct(
        GroupTable\GroupUser $groupUserTable
    ) {
        $this->groupUserTable = $groupUserTable;
    }

    public function getCount(UserEntity\User $userEntity): int
    {
        return $this->groupUserTable->selectCountWhereUserId(
            $userEntity->getUserId()
        );
    }
}
