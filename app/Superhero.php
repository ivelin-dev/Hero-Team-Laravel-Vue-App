<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Superhero extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'superhero';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The teams that belong to the hero.
     */
    public function teams()
    {
        return $this->belongsToMany('App\Team', 'hero_team');
    }
}
