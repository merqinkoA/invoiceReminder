<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice_reminder extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'invoice_reminder';
    protected $primaryKey = 'ir_id';
    protected $fillable = [
        'invoice_number',
        'pr_number',
        'vendor_id',
        'pi_submitted_date',
        'po_number',
        'invoice_date',
        'ses_migo_number',
        'ses_migo_date',
        'invoice_received_date',
        'invoice_submitted_date',
        'currency',
        'net_value',
        'finance_reminder',
        'finance_status',
        'due_date',
        'email_status',
        'ir_status',
        'email_to',
        'email_cc',
        'reminder_pi_date',
        'reminder_invoice_date',
        'reminder_finance_date',
        // 'pi_submitted',
        // 'invoice_submitted',
    ];
    // protected $dates = ['due_date', 'ses_migo_date'];
    protected $casts = [
        'pi_submitted' => 'boolean',
        'invoice_submitted' => 'boolean',
    ];
    protected $dates = ['deleted_at'];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
