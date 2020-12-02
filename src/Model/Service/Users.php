<?php
namespace LeoGalleguillos\Group\Model\Service;

use Generator;
use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use MonthlyBasis\User\Model\Entity as UserEntity;
use MonthlyBasis\User\Model\Factory as UserFactory;

class Users
{
    public function __construct(
        GroupTable\GroupUser $groupUserTable,
        UserFactory\User $userFactory
    ) {
        $this->groupUserTable = $groupUserTable;
        $this->userFactory    = $userFactory;
    }

    /**
     * Get users in group.
     *
     * @param GroupEntity\Group $groupEntity
     * @return Generator
     * @yield UserEntity\User
     */
    public function getUsers(
        GroupEntity\Group $groupEntity
    ): Generator {
        $generator = $this->groupUserTable->selectWhereGroupId(
            $groupEntity->getGroupId()
        );
        foreach ($generator as $array) {
            yield $this->userFactory->buildFromUserId(
                $array['user_id']
            );
        }
    }
}
