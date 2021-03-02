<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\DayRepositoryInterface;
use App\Interfaces\MealRepositoryInterface;

class MealController extends Controller
{
    private $repo;
    private $dayRepo;

    public function __construct(MealRepositoryInterface $repo, DayRepositoryInterface $dayRepo)
    {
        $this->repo = $repo;
        $this->dayRepo = $dayRepo;
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

        return view('meals_create', compact('day'));
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
            'name' => 'required|max:255',
            'time' => 'date_format:"H:i"',
        ]);   

        $this->repo->store($request->all());

        return redirect()->route('days.show', [
                            'id' => $request->day_id
                        ])
                        ->with('status', 'success')
                        ->with('message', 'Obrok sačuvan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meal = $this->repo->find($id);

        return view('meals_edit', compact('meal'));
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
            'name' => 'required|max:255',
            'time' => 'date_format:"H:i"',
        ]);

        $meal = $this->repo->update($id, $request->all());

        return redirect()->route('days.show', [
                            'id' => $meal->day_id
                        ])
                        ->with('session', 'success')
                        ->with('message', 'Obrok promenjen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $dayId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($dayId, $id)
    {
        $this->repo->destroy($id);
        
        return redirect()->route('days.show', [
                            'id' => $dayId
                        ])
                        ->with('status', 'success')
                        ->with('message', 'Obrok izbrisan');
    }
}
