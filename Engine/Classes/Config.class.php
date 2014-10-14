<?php

class Config {

    public static function get($key)
    {

        global $db;

        $config = $db->query(

            "SELECT `val`
            FROM `config`
            WHERE `key`=?",
            strtolower($key)

        )->fetch(PDO::FETCH_ASSOC);

        if ($config === false) {

            return null;

        }

        return $config['val'];

    }

    public static function set($key, $value)
    {

        global $db;

        if (self::get($key) === null) {

            return $db->query(
                "INSERT INTO `config`(`key`, `val`)
                VALUES (?,?)",
                $key,
                $value
            )->execute();

        }

        return $db->query(
            "UPDATE `config`
            SET `val`=?
            WHERE `key`=?",
            $value,
            $key
        )->execute();

    }

}