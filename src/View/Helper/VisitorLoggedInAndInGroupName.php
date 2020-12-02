<?php
namespace LeoGalleguillos\Group\View\Helper;

use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Service as GroupService;
use MonthlyBasis\User\Model\Entity as UserEntity;
use Zend\View\Helper\AbstractHelper;

class VisitorLoggedInAndInGroupName extends AbstractHelper
{
    public function __construct(
        GroupService\VisitorLoggedInAndInGroupName $visitorLoggedInAndInGroupNameService
    ) {
        $this->visitorLoggedInAndInGroupNameService = $visitorLoggedInAndInGroupNameService;
    }

    public function __invoke(
        string $groupName
    ): bool {
        return $this->visitorLoggedInAndInGroupNameService->isVisitorLoggedInAndInGroupName(
            $groupName
        );
    }
}
