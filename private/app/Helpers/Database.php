<?php

namespace App\Helpers;

use DB;

class Database
{
    public static function getInfo()
    {
        $pdo = DB::getPdo();

        $info = $pdo->query("SELECT version();")->fetchColumn();

        preg_match("/^[0-9\.]+/", $info, $match);
        $version = $match[0];

        $name = 'MySQL';
        if (stripos($info, 'MariaDB') !== false) {
            $name = 'MariaDB';
        } elseif (stripos($info, 'Percona') !== false) {
            //$name = 'Percona';
        }

        return [
            'name' => $name,
            'version' => $version,
        ];
    }

    public static function supportInnoDBFullTextIndex()
    {
        $info = self::getInfo();

        if ($info['name'] === 'MySQL') {
            if (version_compare($info['version'], '5.6.4', '>=')) {
                return true;
            }
        }

        if ($info['name'] === 'MariaDB') {
            if (version_compare($info['version'], '10.0.5', '>=')) {
                return true;
            }
        }

        return false;
    }

    public static function getCollations($connection = null)
    {
        $collations = DB::connection($connection)->select('SHOW COLLATION;');

        return array_column($collations, 'Collation');
    }

    public static function getRecommendedCollation($connection = null)
    {
        $collations = self::getCollations($connection);

        $recommended_collations = [
            'utf8mb4_unicode_520_ci',
            'utf8mb4_unicode_ci',
            'utf8_unicode_520_ci',
            'utf8_unicode_ci',
            'utf8mb4_general_ci',
            'utf8_general_ci',
        ];

        $recommended_collation = 'utf8_unicode_ci';

        foreach ($recommended_collations as $collation) {
            if (in_array($collation, $collations)) {
                $recommended_collation = $collation;
                break;
            }
        }

        return $recommended_collation;
    }

    public static function getCharsets($connection = null)
    {
        $charsets = DB::connection($connection)->select('SHOW CHARACTER SET;');

        return array_column($charsets, 'Charset');
    }

    public static function getEngines($connection = null)
    {
        $rows = DB::connection($connection)->select('SHOW ENGINES;');

        $engines = [];

        foreach ($rows as $row) {
            if (in_array(strtolower($row->Support), array_map('strtolower', ['YES', 'DEFAULT']))) {
                $engines[] = $row->Engine;
            }
        }

        return $engines;
    }

    public static function getRecommendedEngine($connection = null)
    {
        $engines = self::getEngines($connection);

        $recommended_engines = [
            'InnoDB',
            'MyISAM',
        ];

        $recommended_engine = 'InnoDB';

        foreach ($recommended_engines as $engine) {
            if (in_array($engine, $engines)) {
                $recommended_engine = $engine;
                break;
            }
        }

        return $recommended_engine;
    }

    public static function isIndexExists($table, $index = null, $connection = null)
    {
        //$indexes = DB::connection($connection)->getDoctrineSchemaManager()->listTableIndexes($table);

        $table = DB::connection($connection)->getTablePrefix() . $table;

        $rows = DB::connection($connection)->select("SHOW INDEX FROM {$table};");

        $indexes = array_column($rows, 'Key_name');

        if (!$index) {
            return $indexes;
        }

        return in_array($index, $indexes);
    }
}
