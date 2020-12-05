<?php
namespace MonthlyBasis\Group\Model\Service;

use Generator;
use MonthlyBasis\Group\Model\Entity as GroupEntity;
use MonthlyBasis\Group\Model\Factory as GroupFactory;
use MonthlyBasis\Group\Model\Table as GroupTable;
use MonthlyBasis\User\Model\Entity as UserEntity;

class Groups
{
    public function __construct(
        GroupFactory\Group $groupFactory,
        GroupTable\GroupUser $groupUserTable
    ) {
        $this->groupFactory   = $groupFactory;
        $this->groupUserTable = $groupUserTable;
    }

    public function getGroups(UserEntity\User $userEntity): Generator
    {
        $generator = $this->groupUserTable->selectWhereUserId(
            $userEntity->getUserId()
        );

        foreach ($generator as $array) {
            yield $this->groupFactory->buildFromArray($array);
        }
    }
}
