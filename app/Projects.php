<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * Fields for mass create,update
     */
    protected $fillable = [
        'name',
        'description',
        'status'
    ];
}
