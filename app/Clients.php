<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * Fields for mass create,update
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'password'
    ];
}
