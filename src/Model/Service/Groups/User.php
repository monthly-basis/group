<?php
namespace MonthlyBasis\Group\Model\Service\Groups;

use Generator;
use MonthlyBasis\Group\Model\Entity as GroupEntity;
use MonthlyBasis\Group\Model\Factory as GroupFactory;
use MonthlyBasis\Group\Model\Table as GroupTable;
use MonthlyBasis\User\Model\Entity as UserEntity;

class User
{
    public function __construct(
        GroupFactory\Group $groupFactory,
        GroupTable\GroupUser $groupUserTable
    ) {
        $this->groupFactory   = $groupFactory;
        $this->groupUserTable = $groupUserTable;
    }

    /**
     * @yield GroupEntity\Group
     */
    public function getUserGroups(UserEntity\User $userEntity): Generator
    {
        $generator = $this->groupUserTable->selectWhereUserId(
            $userEntity->getUserId()
        );

        foreach ($generator as $array) {
            yield $this->groupFactory->buildFromArray($array);
        }
    }
}
