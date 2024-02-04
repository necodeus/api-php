<?php

namespace Libraries;

class Color
{
    public static function print($string, $foregroundColor, $backgroundColor = null): void
    {
        $foregroundColors = [
            'black' => '0;30',
            'red' => '0;31',
            'green' => '0;32',
            'yellow' => '0;33',
            'blue' => '0;34',
            'magenta' => '0;35',
            'cyan' => '0;36',
            'white' => '1;37',
            'lightgreen' => '1;32',
            'lightorange' => '1;33',
            'lightred' => '1;31',
        ];

        $backgroundColors = [
            'black' => '40',
            'red' => '41',
            'green' => '42',
            'yellow' => '43',
            'blue' => '44',
            'magenta' => '45',
            'cyan' => '46',
            'white' => '47',
            'lightgreen' => '42',
            'lightorange' => '43',
            'lightred' => '41',
        ];

        $resetColor = "\033[0m";

        $coloredString = '';

        if (isset($foregroundColors[$foregroundColor])) {
            $coloredString .= "\033[" . $foregroundColors[$foregroundColor] . "m";
        }

        if (isset($backgroundColors[$backgroundColor])) {
            $coloredString .= "\033[" . $backgroundColors[$backgroundColor] . "m";
        }

        echo $coloredString . $string . $resetColor;
    }
}
