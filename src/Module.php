<?php
namespace LeoGalleguillos\Group;

use LeoGalleguillos\Group\Model\Factory as GroupFactory;
use LeoGalleguillos\Group\Model\Service as GroupService;
use LeoGalleguillos\Group\Model\Table as GroupTable;
use LeoGalleguillos\Group\View\Helper as GroupHelper;
use LeoGalleguillos\User\Model\Factory as UserFactory;
use LeoGalleguillos\User\Model\Service as UserService;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                    'getGroupFactory' => GroupHelper\Factory\Group::class,
                    'isLoggedInUserInGroupName'   => GroupHelper\IsLoggedInUserInGroupName::class,
                    'isUserInGroup'   => GroupHelper\IsUserInGroup::class,
                    'isVisitorLoggedInAndInGroupName' => GroupHelper\VisitorLoggedInAndInGroupName::class,
                ],
                'factories' => [
                    GroupHelper\Factory\Group::class => function ($serviceManager) {
                        return new GroupHelper\Factory\Group(
                            $serviceManager->get(GroupFactory\Group::class)
                        );

                    },
                    GroupHelper\IsLoggedInUserInGroupName::class => function ($serviceManager) {
                        return new GroupHelper\IsLoggedInUserInGroupName(
                            $serviceManager->get(GroupService\IsLoggedInUserInGroupName::class)
                        );
                    },
                    GroupHelper\IsUserInGroup::class => function ($serviceManager) {
                        return new GroupHelper\IsUserInGroup(
                            $serviceManager->get(GroupService\IsUserInGroup::class)
                        );
                    },
                    GroupHelper\VisitorLoggedInAndInGroupName::class => function ($serviceManager) {
                        return new GroupHelper\VisitorLoggedInAndInGroupName(
                            $serviceManager->get(GroupService\VisitorLoggedInAndInGroupName::class)
                        );
                    },
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
                GroupService\IsLoggedInUserInGroupName::class => function ($serviceManager) {
                    return new GroupService\IsLoggedInUserInGroupName(
                        $serviceManager->get(GroupFactory\Group::class),
                        $serviceManager->get(GroupService\IsUserInGroup::class),
                        $serviceManager->get(UserService\LoggedInUser::class)
                    );
                },
                GroupService\IsUserInGroup::class => function ($serviceManager) {
                    return new GroupService\IsUserInGroup(
                        $serviceManager->get(GroupTable\GroupUser::class)
                    );
                },
                GroupService\Groups\Count::class => function ($serviceManager) {
                    return new GroupService\Groups\Count(
                        $serviceManager->get(GroupTable\GroupUser::class)
                    );
                },
                GroupService\Users::class => function ($serviceManager) {
                    return new GroupService\Users(
                        $serviceManager->get(GroupTable\GroupUser::class),
                        $serviceManager->get(UserFactory\User::class)
                    );
                },
                GroupService\VisitorLoggedInAndInGroupName::class => function ($serviceManager) {
                    return new GroupService\VisitorLoggedInAndInGroupName(
                        $serviceManager->get(GroupFactory\Group::class),
                        $serviceManager->get(GroupService\IsUserInGroup::class),
                        $serviceManager->get(UserService\LoggedIn::class),
                        $serviceManager->get(UserService\LoggedInUser::class)
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
