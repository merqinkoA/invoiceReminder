<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_reminder extends Model
{
    use HasFactory;
    protected $table = 'invoice_reminder';
    protected $primaryKey = 'ir_id';
    protected $fillable = [
        'invoice_number',
        'pr_number',
        'supplier_name',
        'pi_submitted_date',
        'created_at_1',
        'updated_at_1',
        'po_number',
        'invoice_date',
        'SES_MIGO_number',
        'SES_MIGO_date',
        'invoice_received_date',
        'invoice_submitted_date',
        'created_at_2',
        'updated_at_2',
        'currency',
        'net_value',
        'finance_reminder',
        'finance_status',
        'created_at_3',
        'updated_at_3',
        'due_date',
        'email_status',
        'ir_status',
        // 'pi_submitted',
        // 'invoice_submitted',
    ];
    // protected $dates = ['due_date', 'ses_migo_date'];
    protected $casts = [
        'pi_submitted' => 'boolean',
        'invoice_submitted' => 'boolean',
    ];
}
