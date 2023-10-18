<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('invoice_reminder', function (Blueprint $table) {
            $table->id('ir_id'); // Updated to match the new primary key
            $table->string('invoice_number');
            $table->string('pr_number');
            $table->string('supplier_name');
            $table->date('pi_submitted_date');
            $table->timestamps('created_at_1', 'updated_at_1');
            $table->string('po_number');
            $table->date('invoice_date');
            $table->string('SES_MIGO_number');
            $table->date('SES_MIGO_date');
            $table->date('invoice_received_date');
            $table->date('invoice_submitted_date');
            $table->timestamps('created_at_2', 'updated_at_2');
            $table->string('currency');
            $table->string('net_value');
            $table->string('finance_reminder');
            $table->string('finance_status');
            $table->timestamps('created_at_3', 'updated_at_3');
            $table->timestamps('due_date');
            $table->string('email_status');
            $table->string('ir_status');
            $table->boolean('pi_submitted'); // Updated column name to match casts
            $table->boolean('invoice_submitted');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
