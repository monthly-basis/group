<?php
namespace LeoGalleguillos\Group\View\Helper;

use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Service as GroupService;
use LeoGalleguillos\User\Model\Entity as UserEntity;
use Zend\View\Helper\AbstractHelper;

class IsLoggedInUserInGroupName extends AbstractHelper
{
    public function __construct(
        GroupService\IsLoggedInUserInGroupName $isLoggedInUserInGroupNameService
    ) {
        $this->isLoggedInUserInGroupNameService = $isLoggedInUserInGroupNameService;
    }

    public function __invoke(
        string $groupName
    ): bool {
        return $this->isLoggedInUserInGroupNameService->isLoggedInUserInGroupName(
            $groupName
        );
    }
}
