<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Interfaces\DayRepositoryInterface;
use App\Interfaces\ActivityRepositoryInterface;

class DayController extends Controller
{
    private $repo;
    private $activityRepo;

    public function __construct(DayRepositoryInterface $repo, ActivityRepositoryInterface $activityRepo)
    {
        $this->repo = $repo;
        $this->activityRepo = $activityRepo;
    }

    /**
     * Validate request and get data based on search criteria.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getSearchData($request)
    {
        $validated = $request->validate([
            'energy_less' => 'nullable|numeric|min:0|max:10',
            'energy_greater' => 'nullable|numeric|min:0|max:10',
            'date_before' => 'nullable|date',
            'date_after' => 'nullable|date',
            'sleep_duration_less' => 'nullable|numeric|min:0|max:24',
            'sleep_duration_greater' => 'nullable|numeric|min:0|max:24',
            'activity_duration_less' => 'nullable|numeric|min:0|max:24',
            'activity_duration_greater' => 'nullable|numeric|min:0|max:24',
        ]); 

        $request->flash();

        return $this->repo->search($request->all());
    }

    /**
     * Get 100 previous days.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getIndexData($request)
    {
        $request->session()->forget([
            'energy_less', 
            'energy_greater', 
            'date_before', 
            'date_after', 
            'sleep_duration_less',
            'sleep_duration_greater',
            'activity_duration_less',
            'activity_duration_greater',
        ]);

        return $this->repo->lastDays(100);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $days = ($request->method() === "POST") ? $this->getSearchData($request) : $this->getIndexData($request);
        $data = $this->repo->setData($days); 

        return view('days_all', [
            'days' => $days,
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $day = $this->repo->create();

        return redirect()->route('days.show', ['id' => $day->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $day = $this->repo->find($id);

        return view('days_show', compact('day'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $day = $this->repo->find($id);

        return view('days_edit', compact('day'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'energy_level' => 'required|numeric'
        ]);

        $day = $this->repo->update($id, $request->all());

        return redirect()->route('days.show', [
                            'id' => $id
                        ])
                        ->with('status', 'success')
                        ->with('message', 'Nivo energije promenjen');
    }
}
