<?php
namespace LeoGalleguillos\Group\Model\Table;

use Generator;
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

    public function selectWhereUserId(int $userId): Generator
    {
        $sql = '
            SELECT `group_user_id`
                 , `group_id`
                 , `user_id`
              FROM `group_user`
             WHERE `user_id` = ?
                 ;
        ';
        $result = $this->adapter->query($sql)->execute([$userId]);
        foreach ($result as $row) {
            yield $row;
        }
    }
}
