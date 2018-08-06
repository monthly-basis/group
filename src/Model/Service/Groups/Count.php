<?php
namespace LeoGalleguillos\Group\Model\Service\Groups;

use Generator;
use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\User\Model\Entity as UserEntity;

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
