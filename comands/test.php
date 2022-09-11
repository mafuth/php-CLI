<?php
class SomeClass
{
    private static $a = 1;

    public static function a() {
        self::$a = 2;
    }

    public static function b() {
        echo self::$a;
    }
}

SomeClass::a();
SomeClass::b();