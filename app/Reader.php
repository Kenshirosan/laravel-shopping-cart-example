<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    public static function readFiles($file)
    {
        $lines = file($file);
        echo '<p>' . $file . '</p>';

        foreach($lines as $line) {
            if ($file == '../logs/errorlog.txt') {
                echo '<p style="color: red">' . $line . '</p>';
            } else {
                echo '<p>' . $line . '</p>';
            }
        }
    }
}
