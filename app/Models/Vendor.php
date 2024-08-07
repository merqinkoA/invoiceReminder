<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'vendor_sap_id',
        'name',
        'email',
        'phone',
        'website',
        'address',
        'address_sap',

    ];
    public function invoiceReminders()
    {
        return $this->hasMany(InvoiceReminder::class);
    }
}
