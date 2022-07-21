<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'guest_team_id',
        'date'
    ];

    public function hometeam() {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function guesteam() {
        return $this->belongsTo(Team::class, 'guest_team_id');
    }
}
