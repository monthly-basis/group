<?php
namespace LeoGalleguillos\Group;

use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Table as GroupTable;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                ],
                'factories' => [
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                GroupFactory\Group::class => function ($serviceManager) {
                    return new GroupFactory\Group(
                        $serviceManager->get(GroupTable\Group::class)
                    );
                },
                GroupTable\Group::class => function ($serviceManager) {
                    return new GroupTable\Group(
                        $serviceManager->get('group')
                    );
                },
            ],
        ];
    }
}
