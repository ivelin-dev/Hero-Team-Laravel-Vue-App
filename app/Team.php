<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'team';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The heroes that belong to the team.
     */
    public function heroes()
    {
        return $this->belongsToMany('App\Superhero', 'hero_team');
    }
}
