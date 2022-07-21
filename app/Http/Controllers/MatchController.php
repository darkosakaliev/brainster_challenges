<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;
use App\Models\Team;
use App\Models\TeamMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = TeamMatch::all();
        return view('dashboard', compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        return view('matches.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatchRequest $request)
    {
        $match = TeamMatch::create([
            'home_team_id' => $request->home_team_id,
            'guest_team_id' => $request->guest_team_id,
            'date' => $request->date
        ]);

        if($match) {
            return redirect()->route('matches')->with(['message' => 'You successfully added a match!', 'status' => 'success']);
        } else {
            return redirect()->route('matches')->with(['message' => 'There was a problem adding a match!', 'status' => 'danger']);
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
        $match = TeamMatch::find($id);
        $teams = Team::all();
        return view('matches.edit', compact('match', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatchRequest $request, $id)
    {
        $match = TeamMatch::find($id);
        $match->home_team_id = $request->home_team_id;
        $match->guest_team_id = $request->guest_team_id;
        $match->date = $request->date;
        if($match->save()) {
            return redirect()->route('matches')->with(['message' => 'You successfully edited the match!', 'status' => 'success']);
        } else {
            return redirect()->route('matches')->with(['message' => 'There was a problem editing the match!', 'status' => 'danger']);
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
        $match = TeamMatch::find($id);

        if($match->delete()) {
            return redirect()->route('matches')->with(['message' => 'You successfully deleted a match!', 'status' => 'success']);
        } else {
            return redirect()->route('matches')->with(['message' => 'There was a problem deleting a match!', 'status' => 'danger']);
        }
    }
}
