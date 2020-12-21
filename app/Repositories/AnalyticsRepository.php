<?php


namespace App\Repositories;


use App\Models\SortOrdersByTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use League\Csv\CannotInsertRecord;
use League\Csv\Writer;
use SplTempFileObject;

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

    //TODO: fix this shit
    public function export($query)
    {
        $data = $this->$query();

        $csv = Writer::createFromFileObject(new SplTempFileObject());

        try {
            $csv->insertOne(['count', 'day']);
        } catch (CannotInsertRecord $e) {
            die($e->getMessage());
        }

        foreach ($data as $sale) {
            try {
                //$csv->insertAll();
                $csv->insertOne($sale);
            } catch (CannotInsertRecord $e) {
                die($e->getMessage());
            }
        }

        $csv->output('data.csv');

        return response([], 200);

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
}
