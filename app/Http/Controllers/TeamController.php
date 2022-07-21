<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        $team = Team::create([
            'name' => $request->name,
            'foundation_year' => $request->foundation_year
        ]);

        if($team) {
            return redirect()->route('teams.index')->with(['message' => 'You successfully added the team!', 'status' => 'success']);
        } else {
            return redirect()->route('teams.index')->with(['message' => 'There was a problem adding the team!', 'status' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {
        $team = Team::find($id);
        $team->name = $request->name;
        $team->foundation_year = $request->foundation_year;
        if($team->save()) {
            return redirect()->route('teams.index')->with(['message' => 'You successfully edited the team!', 'status' => 'success']);
        } else {
            return redirect()->route('teams.index')->with(['message' => 'There was a problem editing the team!', 'status' => 'danger']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);

        if($team->delete()) {
            return redirect()->route('teams.index')->with(['message' => 'You successfully deleted a team!', 'status' => 'success']);
        } else {
            return redirect()->route('teams.index')->with(['message' => 'There was a problem deleting a team!', 'status' => 'danger']);
        }
    }
}
