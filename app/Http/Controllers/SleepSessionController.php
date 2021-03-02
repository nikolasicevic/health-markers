<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Day;
use App\Interfaces\SleepSessionRepositoryInterface;
use Carbon\Carbon;

class SleepSessionController extends Controller
{
    private $repo;

    public function __construct(SleepSessionRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sleepSession = $this->repo->find($id);
        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::today()->subDay()->format('Y-m-d');
        $defaultStart = Carbon::create($yesterday . ' 23:00');
        $defaultEnd = Carbon::create($today . ' 07:00');

        return view('sleep_session_edit', [
            'sleepSession' => $sleepSession,
            'defaultStart' => $defaultStart,
            'defaultEnd' => $defaultEnd,
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
            'start' => 'date|before:end',
            'end' => 'date|after:start',
        ]);

        $sleepSession = $this->repo->update($id, $request->only('start', 'end'));

        return redirect()->route('days.show', [
                            'id' => $sleepSession->day->id
                        ])
                        ->with('status', 'success')
                        ->with('message', 'Promenjeni podaci o snu');
    }
}
