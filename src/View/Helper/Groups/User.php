<?php
namespace MonthlyBasis\Group\View\Helper\Groups;

use Generator;
use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\Group\Model\Entity as GroupEntity;
use MonthlyBasis\Group\Model\Service as GroupService;
use MonthlyBasis\User\Model\Entity as UserEntity;

class User extends AbstractHelper
{
    public function __construct(
        GroupService\Groups\User $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * @yield GroupEntity\Group
     */
    public function __invoke(UserEntity\User $userEntity): Generator
    {
        return $this->userService->getUserGroups(
            $userEntity
        );
    }
}
