<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ActivitySessionRepositoryInterface;
use App\Interfaces\DayRepositoryInterface;
use App\Interfaces\ActivityRepositoryInterface;

class ActivitySessionController extends Controller
{
    private $repo;
    private $dayRepo;
    private $activityRepo;

    public function __construct(
        ActivitySessionRepositoryInterface $repo, DayRepositoryInterface $dayRepo, ActivityRepositoryInterface $activityRepo)
    {
        $this->repo = $repo;
        $this->dayRepo = $dayRepo;
        $this->activityRepo = $activityRepo;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $dayId
     * @return \Illuminate\Http\Response
     */
    public function create($dayId)
    {
        $day = $this->dayRepo->find($dayId);
        $activities = $this->activityRepo->all();

        return view('activity_session_create', [
            'day' => $day,
            'activities' => $activities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_id' => 'required|numeric',
            'activity_id' => 'required|numeric',
            'duration_hrs' => 'numeric',
        ]);

        $activitySession = $this->repo->store($request->all());

        return redirect()->route('days.show', [
                            'id' => $activitySession->day_id
                        ])
                        ->with('status', 'success')
                        ->with('message', 'Aktivnost sačuvana');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activitySession = $this->repo->find($id);
        $activities = $this->activityRepo->all();

        return view('activity_session_edit', [
            'activitySession' => $activitySession,
            'activities' => $activities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'activity_id' => 'required|numeric',
            'duration_hrs' => 'numeric',
        ]);

        $activitySession = $this->repo->update($id, $request->all());

        return redirect()->route('days.show', [
                            'id' => $activitySession->day->id
                        ])
                        ->with('status', 'success')
                        ->with('message', 'Aktivnost promenjena');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $dayId
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($dayId, $id)
    {
        $this->repo->destroy($id);

        return redirect()->route('days.show', [
                            'id' => $dayId
                        ])
                        ->with('status', 'success')
                        ->with('message', 'Aktivnost izbrisana');
    }
}
