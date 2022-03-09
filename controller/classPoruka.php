<?php

class Poruka {

    public static function greska($str)
    {
        return "<div class='poruka' style='background-color: #e74c3c; color: white'>{$str}</div>";
    }

    public static function uspeh($str)
    {
        return "<div class='poruka' style='background-color: #18bc9c; color: white'>{$str}</div>";
    }

    public static function info($str)
    {
        return "<div class='poruka' style='background-color: #3498db; color: white';>{$str}</div>";
    }
}