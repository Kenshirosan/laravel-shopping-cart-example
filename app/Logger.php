<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use App\Mail\ErrorMail;
use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    protected $string = null;
    protected $error = null;

    public function __construct($param, $error = null)
    {
        parent::__construct();

        if($error) {
            return $this->logError($param, $error);
        }

        return $this->log($param);
    }

    public function format($param, $error = null)
    {
        $date = date('Y-M-D H:i:s');
        $string = '[' . $date . ']' . ' ' . $param . "\r\n";

        if($error) {
            $string = '[' . $date . ']' . ' ' . $param . ' ' . $error . "\r\n";
        }

        $this->string = $string;
        return $this;
    }

    public function log($param)
    {
        $this->format($param);

        if (file_put_contents('logs/log.txt', $this->string, FILE_APPEND)) {
            echo 'Done';
        }

    }

    public function logError($param, $error)
    {
        return $this->format($param, $error)->emailError($param, $error);
    }

    public function emailError($param, $error)
    {
        $args = func_get_args();

        if(file_put_contents('logs/errorlog.txt', $this->string, FILE_APPEND)) {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ErrorMail($args));
            return response(['Message' => 'An email has been sent to the site admin'], 200);

        }
    }

    public static function readLogs()
    {
        $logs = [];
        $no_of_lines = [];

        foreach (glob("logs/*.txt") as $filename) {
            if(count(file($filename))) {
                $logs[] = $filename;
            }
        }

        foreach($logs as $log) {
            Reader::readFiles($log);
        }

        return ['logs' => $logs, 'count' => $no_of_lines];
    }
}
