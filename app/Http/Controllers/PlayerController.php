<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();
        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        return view('players.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerRequest $request)
    {
        $player = Player::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'date_of_birth' => $request->date_of_birth,
            'team_id' => $request->team_id
        ]);

        if($player) {
            return redirect()->route('players.index')->with(['message' => 'You successfully added a player!', 'status' => 'success']);
        } else {
            return redirect()->route('players.index')->with(['message' => 'There was a problem adding a player!', 'status' => 'danger']);
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
        $player = Player::find($id);
        $teams = Team::all();
        return view('players.edit', compact('player', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerRequest $request, $id)
    {
        $player = Player::find($id);
        $player->name = $request->name;
        $player->surname = $request->surname;
        $player->date_of_birth = $request->date_of_birth;
        $player->team_id = $request->team_id;
        if($player->save()) {
            return redirect()->route('players.index')->with(['message' => 'You successfully edited the player!', 'status' => 'success']);
        } else {
            return redirect()->route('players.index')->with(['message' => 'There was a problem editing the player!', 'status' => 'danger']);
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
        $player = Player::find($id);

        if($player->delete()) {
            return redirect()->route('players.index')->with(['message' => 'You successfully deleted a player!', 'status' => 'success']);
        } else {
            return redirect()->route('players.index')->with(['message' => 'There was a problem deleting a player!', 'status' => 'danger']);
        }
    }
}
