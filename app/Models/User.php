<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUser',
        'email',
        'Full_name',
    ];
    protected $table = 'user';
    public $timestamps = false;

}
