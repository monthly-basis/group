<?php
namespace LeoGalleguillos\Group\Model\Table;

use Zend\Db\Adapter\Adapter;

class GroupUser
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function selectCount(): int
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `group_user`
                 ;
        ';
        $row = $this->adapter->query($sql)->execute()->current();
        return (int) $row['count'];
    }
}
