<?php
namespace LeoGalleguillos\Group\Model\Table;

use Zend\Db\Adapter\Adapter;

class Group
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function insert(string $name): int
    {
        $sql = '
            INSERT
              INTO `group`
                   (`name`)
            VALUES (?)
                 ;
        ';
        $parameters = [
            $name,
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
              FROM `group`
                 ;
        ';
        $row = $this->adapter->query($sql)->execute()->current();
        return (int) $row['count'];
    }

    public function selectWhereName(string $name): array
    {
        $sql = '
            SELECT `group`.`group_id`
                 , `group`.`name`
              FROM `group`
             WHERE `group`.`name` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$name])->current();
    }
}
