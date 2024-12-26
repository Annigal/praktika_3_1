<?php

class Basket {
    private static $items = [];

    public static function init() {
        if (isset($_COOKIE['basket']) && $_COOKIE['basket']) {
            $decoded = json_decode($_COOKIE['basket'], true);
            if (is_array($decoded)) {
                self::$items = $decoded;
            } else {
                self::$items = [];
            }
        } else {
            self::$items = [];
        }
    }

    public static function add($id) {
        if (!isset(self::$items[$id])) {
            self::$items[$id] = 1;
        } else {
            self::$items[$id]++;
        }
        self::save();
    }

    public static function remove($id) {
        if (isset(self::$items[$id])) {
            unset(self::$items[$id]);
            self::save();
        }
    }

    public static function read() {
        return self::$items;
    }

    public static function save() {
        $encoded = json_encode(self::$items);
        setcookie('basket', $encoded, time() + 3600 * 24 * 7, '/');
    }

    public static function clear() {
        self::$items = [];
        setcookie('basket', '', time() - 3600, '/');
    }
}
