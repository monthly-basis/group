<?php
namespace LeoGalleguillos\Group;

use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Service as GroupService;
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
                GroupService\Groups::class => function ($serviceManager) {
                    return new GroupService\Groups(
                        $serviceManager->get(GroupFactory\Group::class),
                        $serviceManager->get(GroupTable\GroupUser::class)
                    );
                },
                GroupService\Groups\Count::class => function ($serviceManager) {
                    return new GroupService\Groups\Count(
                        $serviceManager->get(GroupTable\GroupUser::class)
                    );
                },
                GroupTable\Group::class => function ($serviceManager) {
                    return new GroupTable\Group(
                        $serviceManager->get('group')
                    );
                },
                GroupTable\GroupUser::class => function ($serviceManager) {
                    return new GroupTable\GroupUser(
                        $serviceManager->get('group')
                    );
                },
            ],
        ];
    }
}
