<?php


namespace App\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsRepository
{
    protected $now;
    protected $dateString;
    protected $date;
    protected $year;
    protected $lastYear;
    protected $lastYearDateString;
    protected $lastYearDate;

    public function __construct()
    {
        $this->now = Carbon::now();
        $this->dateString = $this->now->year . '-' . $this->now->month;
        $this->date = substr(Carbon::createFromFormat('Y-m', $this->dateString)->toDateString(), 0, 7);
        $this->year = $this->now->year;
        $this->lastYear = $this->now->year - 1;
        $this->lastYearDateString = $this->lastYear . '-' . $this->now->month;
        $this->lastYearDate = substr(Carbon::createFromFormat('Y-m', $this->lastYearDateString)->toDateString(), 0, 7);
    }

    public function export($year)
    {
        header("Content-type: text/csv");
        header("Cache-Control: no-store, no-cache");
        header('Content-Disposition: attachment; filename="data.csv"');

        $query = "SELECT * FROM sort_orders_by_times WHERE substr(date, 1, 4) = {$year}";
        $res = DB::select($query);

        $file = fopen('php://output','w');
        $headers  = ['id', 'time', 'date', 'day', 'type', 'moment', 'created_at', 'updated_at'];
        fputcsv($file, $headers);
        foreach ($res as $fields) {
            fputcsv($file, (array)$fields);
        }

        fclose($file);
        echo $file;
        die();

    }

    public function query($moment, $date, $type)
    {
        $dateParam = $date === 'lastYear' ? $this->lastYearDate : $this->date;

        if( (substr($type, 0, 3) === 'all')) {
            if($type !== 'all') {
                $type = substr($type, 3, strlen($type));
            }

            return $this->selectAll($moment, $date, $type);
        }

        $query = '
            SELECT COUNT(date) AS count, day
            FROM sort_orders_by_times
            WHERE moment = \'' . $moment . '\' AND date LIKE \'' . $dateParam . '%\' AND type = \'' . $type . '\'
            GROUP BY day;
        ';

        return DB::select($query);
    }

    public function selectAll($moment, $dateParam, $type)
    {
        $date = $dateParam === 'lastYear' ? $this->lastYear : $this->year;

        $query = '
            SELECT COUNT(date) AS count, day
            FROM sort_orders_by_times
            WHERE moment = \'' . $moment . '\' AND date LIKE \'' . $date . '%\' AND type = \'' . $type . '\'
            GROUP BY day;
        ';

        if($type === 'all') {
            $query = '
                SELECT COUNT(date) AS total, substr(date, 1, 4) AS annee 
                FROM sort_orders_by_times 
                GROUP BY annee';
        }

        return DB::select($query);
    }

    public function getYears()
    {
        $query = '
            SELECT substr(date, 1, 4) AS annee 
            FROM sort_orders_by_times 
            GROUP BY annee;';

        return DB::select($query);
    }
}
