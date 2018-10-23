<?php
namespace LeoGalleguillos\Group\Model\Service;

use Generator;
use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\User\Model\Entity as UserEntity;

class Users
{
    public function __construct(
        GroupTable\GroupUser $groupUserTable
    ) {
        $this->groupUserTable = $groupUserTable;
    }

    public function getUsers(
        GroupEntity\Group $groupEntity
    ): Generator {
        $this->groupUserTable->selectWhereGroupId(
            $groupEntity->getGroupIp()
        );
    }
}
