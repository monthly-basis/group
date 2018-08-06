<?php
namespace LeoGalleguillos\Group\View\Helper\Factory;

use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use Zend\View\Helper\AbstractHelper;

class Group extends AbstractHelper
{
    public function __construct(
        GroupFactory\Group $groupFactory
    ) {
        $this->groupFactory = $groupFactory;
    }

    public function __invoke()
    {
        return $this->groupFactory;
    }
}
