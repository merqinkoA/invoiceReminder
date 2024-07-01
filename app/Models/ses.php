<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ses extends Model
{
    use HasFactory;
    protected $table = 'po';
    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_number',
        'ses_number',
        'po_number',
        // Add other columns that you want to fill here
    ];
}
