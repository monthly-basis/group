<?php
namespace LeoGalleguillos\Group\Model\Service;

use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\User\Model\Entity as UserEntity;

class Groups
{
    public function __construct(
        GroupFactory\Group $groupFactory,
        GroupTable\GroupUser $groupUserTable
    ) {
        $this->groupFactory   = $groupFactory;
        $this->groupUserTable = $groupUserTable;
    }

    public function getGroups(UserEntity\User $userEntity): array
    {
        $generator = $this->groupUserTable->selectWhereUserId(
            $userEntity->getUserId()
        );

        foreach ($generator as $array) {
            var_dump($array);
        }
    }
}
