<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = "tbl_contact";
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phonenumber',
        'message',
        'status',
        'created_by',
        'updated_by'
    ];
}
