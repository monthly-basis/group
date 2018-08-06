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

    public function insert(int $groupId, int $userId): int
    {
        $sql = '
            INSERT
              INTO `group_user`
                   (`group_id`, `user_id`)
            VALUES (?, ?)
                 ;
        ';
        $parameters = [
            $groupId,
            $userId,
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
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

    public function selectCountWhereUserId(int $userId): int
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `group_user`
             WHERE `user_id` = ?
                 ;
        ';
        $row = $this->adapter->query($sql)->execute([$userId])->current();
        return (int) $row['count'];
    }

    public function selectCountWhereGroupIdAndUserId(
        int $groupId,
        int $userId
    ): int {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `group_user`
             WHERE `group_id` = ?
               AND `user_id` = ?
                 ;
        ';
        $row = $this->adapter->query($sql)->execute([$userId])->current();
        return (int) $row['count'];
    }

    /**
     * @return Generator
     */
    public function selectWhereUserId(int $userId): Generator
    {
        $sql = '
            SELECT `group`.`group_id`
                 , `group`.`name`
                 , `group_user`.`group_user_id`
                 , `group_user`.`user_id`
              FROM `group`
              JOIN `group_user`
             USING (`group_id`)
             WHERE `user_id` = ?
             ORDER
                BY `group`.`name` ASC
                 ;
        ';
        $result = $this->adapter->query($sql)->execute([$userId]);
        foreach ($result as $row) {
            yield $row;
        }
    }
}
