<?php
namespace MonthlyBasis\Group\View\Helper\Factory;

use MonthlyBasis\Group\Model\Factory as GroupFactory;
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
