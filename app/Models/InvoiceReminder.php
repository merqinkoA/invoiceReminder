<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceReminder extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'invoice_reminder';
    protected $primaryKey = 'pr_number';

    public $incrementing = false;
    protected $fillable = [
        'pr_number',
        'supplier_name',
        'pr_type',
        'po_number',
        'invoice_date',
        'invoice_received_date',
        'invoice_submission_deadline',
        'invoice_submitted_date',
        'finance_reminder',
        'finance_status',
        'created_at',
        'updated_at',
        'pr_approved',
        'bast_status',
    ];

    protected $casts = [
        'pr_approved' => 'boolean',
        'bast_status' => 'boolean',
    ];
}
