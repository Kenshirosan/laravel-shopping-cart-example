<?php

namespace App\Http\Controllers;

use App\Models\SortOrdersByTime;
use App\Repositories\AnalyticsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    protected $repository;

    public function __construct(AnalyticsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        //TODO: implement private analytics with apache.

        return view('admin.analytics');
    }

    public function query($moment, $date, $type)
    {
        $data = $this->repository->query($moment, $date, $type);

        return response($data, 200);
    }

    public function export($params)
    {
        $data = $this->repository->export($params);

        return response($data, 200);
    }

    public function getYears()
    {
        $years = $this->repository->getYears();

        return response($years, 200);
    }
}
