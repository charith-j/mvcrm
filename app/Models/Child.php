<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Str;
use Image;
use Storage;
class Child extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'children';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $keyType = 'int';


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

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_child');
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'sponsor_child');
    }

    public function bio()
    {
        return $this->hasMany('App\Models\Bio');
    }

    public function leavingnotice()
    {
        return $this->hasMany('App\Models\LeavingNotice');
    }
    
    public function gifts()
    {
        return $this->hasMany('App\Gift');
    }
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

    public function getFullNameAttribute($value) {
        return $this->ref_number.' '.$this->name;
     }                                      
     
     public function getAgeAttribute() {
    return $this->dob->diffInYears(\Carbon\Carbon::now());
}

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setImageAttribute($value)
    {
        $image=$value;
        $input['picture'] = $image->getClientOriginalName();
        $img = \Image::make($image->getRealPath());

        $destinationPath = public_path('/uploads/photos');
        $img->resize(750, 450, function ($constraint) {
        $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['picture']);

        $destinationPath = public_path('/uploads/photos');

        $img->resize(100, 100, function ($constraint) {
        $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['picture']);

        $image->move($destinationPath, $input['picture']);
        $this->attributes['picture'] = $input['picture'];
}

public static function boot()
{
    parent::boot();
    static::deleting(function($obj) {
        Storage::delete(Str::replaceFirst('storage/','photos/', $obj->image));
    });
}



public function setPictureAttribute($value)
{
    $attribute_name = "picture";
    // destination path relative to the disk above
    $destination_path = "photos";

    // if the image was erased
    if ($value==null) {
        // delete the image from disk
        Storage::delete($this->{$attribute_name});

        // set null in the database column
        $this->attributes[$attribute_name] = null;
    }

    // if a base64 was sent, store it in the db
    if (Str::startsWith($value, 'data:image'))
    {
        $disk = Storage::build([
    'driver' => 'local',
    'root' => 'photos',
]);
        // 0. Make the image
        $image = Image::make($value)->encode('jpg', 90);

        // 1. Generate a filename.
        $filename = md5($value.time()).'.jpg';

        // 2. Store the image on disk.
        $disk->put($filename, $image->stream());

        // 3. Delete the previous image, if there was one.
        $disk->delete(Str::replaceFirst('public','public', $this->{$attribute_name}));

        // 4. Save the public path to the database
        // but first, remove "public/" from the path, since we're pointing to it
        // from the root folder; that way, what gets saved in the db
        // is the public URL (everything that comes after the domain name)
        $public_destination_path = Str::replaceFirst('public', 'public', $destination_path);
       // dd(base_path($public_destination_path));
        $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
    }
}


public function setPicture2Attribute($value)
{
    $attribute_name = "picture2";
    // destination path relative to the disk above
    $destination_path = "photos";

    // if the image was erased
    if ($value==null) {
        // delete the image from disk
        Storage::delete($this->{$attribute_name});

        // set null in the database column
        $this->attributes[$attribute_name] = null;
    }

    // if a base64 was sent, store it in the db
    if (Str::startsWith($value, 'data:image'))
    {
                $disk = Storage::build([
    'driver' => 'local',
    'root' => 'photos',
]);
        // 0. Make the image
        $image = Image::make($value)->encode('jpg', 90);

        // 1. Generate a filename.
        $filename = md5($value.time()).'.jpg';

        // 2. Store the image on disk.
        $disk->put($filename, $image->stream());
   // dd(base_path($destination_path));
        // 3. Delete the previous image, if there was one.
        $disk->delete(Str::replaceFirst('public','public', $this->{$attribute_name}));

        // 4. Save the public path to the database
        // but first, remove "public/" from the path, since we're pointing to it
        // from the root folder; that way, what gets saved in the db
        // is the public URL (everything that comes after the domain name)
        $public_destination_path = Str::replaceFirst('public', 'public', $destination_path);
        $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
    }
}
}