<?php
namespace LeoGalleguillos\Group\Model\Entity;

use LeoGalleguillos\Group\Model\Entity as GroupEntity;

class Group
{
    protected $groupId;
    protected $name;

    public function getGroupId() : int
    {
        return $this->groupId;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setGroupId(int $groupId) : GroupEntity\Group
    {
        $this->groupId = $groupId;
        return $this;
    }

    public function setName(string $name) : GroupEntity\Group
    {
        $this->name = $name;
        return $this;
    }
}
