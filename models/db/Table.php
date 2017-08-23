<?php
namespace Models\db;
use Doctrine\DBAL\DriverManager;

class Table {
    static protected $_tableName;

    public static function getTableName() {
        return isset(static::$_tableName) ? static::$_tableName : null;
    }

    /**
     *
     * @return QueryBuilder
     */
    public static function find() {
        return self::getConnection()->createQueryBuilder()
        ->from(self::getTableName());
    }

    public static function getConnection() {
        $config = new \Doctrine\DBAL\Configuration();
        return DriverManager::getConnection([
                'driver'   => 'pdo_sqlite',
                'path'     => '../app.db',
            ],
            $config
        );
    }
}
?>