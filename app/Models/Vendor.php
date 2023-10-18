<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table ='vendors';
    protected $primaryKey = 'id';
    protected $fillable = [

        'name',
        'email',
        'phone',
        'website',
        'address',
        'company_name',

    ];
}
