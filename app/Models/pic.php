<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pic extends Model
{
    use HasFactory;
    protected $table = 'pic';
    protected $fillable = [
        'name',
        'vendor_id',
        'email',
        'phone',
        'website',
        'address',
        'role_id',

    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
