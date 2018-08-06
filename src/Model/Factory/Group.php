<?php
namespace LeoGalleguillos\Group\Model\Factory;

use LeoGalleguillos\Group\Model\Entity as GroupEntity;
use LeoGalleguillos\Group\Model\Table as GroupTable;

class Group
{
    public function __construct(GroupTable\Group $groupTable)
    {
        $this->groupTable = $groupTable;
    }

    /**
     * Build from array.
     *
     * @param array $array
     * @return GroupEntity\Group
     */
    public function buildFromArray(array $array): GroupEntity\Group
    {
        $groupEntity = new GroupEntity\Group();

        $groupEntity->setGroupId($array['group_id'])
                    ->setName($array['name']);

        return $groupEntity;
    }

    public function buildFromName(string $name): GroupEntity\Group
    {
        return $this->buildFromArray(
            $this->groupTable->selectWhereName($name)
        );
    }
}
