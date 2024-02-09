<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pr extends Model
{
    use HasFactory;
    protected $table = 'pr';
    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_number',
        'pr_number',
        // Add other columns that you want to fill here
    ];
}
