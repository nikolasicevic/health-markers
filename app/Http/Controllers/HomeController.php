<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\DayRepositoryInterface;

class HomeController extends Controller
{
    private $dayRepo;

    public function __construct(DayRepositoryInterface $dayRepo)
    {
        $this->dayRepo = $dayRepo;
    }

    /**
     * Set data array with weekly, monthly and quarterly data.
     *
     * @param \Illuminate\Support\Collection $week
     * @return array
     */
    public function setData($week, $month, $quarter)
    {
        return [
            'weekly' => $this->dayRepo->setData($week, true),
            'monthly' => $this->dayRepo->setData($month, true),
            'quarterly' => $this->dayRepo->setData($quarter, true),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $week = $this->dayRepo->lastDays(self::WEEK);
        $month = $this->dayRepo->lastDays(self::MONTH);
        $quarter = $this->dayRepo->lastDays(self::QUARTER);
        $data = $this->setData($week, $month, $quarter);

        return view('index', [
            'days' => $week,
            'chartData' => $data,
        ]);
    }
}
