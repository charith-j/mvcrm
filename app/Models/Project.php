<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'projects';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

    public function coordinator()
    {
        return $this->belongsTo('App\Models\Coordinator');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'sponsor_child');
    }

    public function children()
    {
        return $this->belongsToMany(Child::class, 'sponsor_child');
    }

    public function leavingnotice()
    {
        return $this->hasMany('App\Models\LeavingNotice');
    }
    /*
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
  
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
