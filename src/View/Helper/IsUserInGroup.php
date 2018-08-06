<?php
namespace LeoGalleguillos\Group\View\Helper;

use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Service as GroupService;
use LeoGalleguillos\User\Model\Entity as UserEntity;
use Zend\View\Helper\AbstractHelper;

class IsUserInGroup extends AbstractHelper
{
    public function __construct(
        GroupService\IsUserInGroup $isUserInGroupService
    ) {
        $this->isUserInGroupService = $isUserInGroupService;
    }

    public function __invoke(
        UserEntity\User $userEntity,
        GroupEntity\Group $groupEntity
    ): bool {
        return $this->isUserInGroupService->isUserInGroup(
            $userEntity,
            $groupEntity
        );
    }
}
