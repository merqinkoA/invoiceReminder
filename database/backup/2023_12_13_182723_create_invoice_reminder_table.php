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
        Schema::create('invoice_reminder', function (Blueprint $table) {
            $table->increments('ir_id');
            $table->string('invoice_number');;
            // $table->unsignedBigInteger('vendor');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');

            $table->string('pr_number')->nullable();
            $table->string('po_number')->nullable();
            $table->string('ses_migo_number')->nullable();
            $table->string('currency')->nullable();
            $table->string('net_value')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('invoice_received_date')->nullable();
            $table->date('invoice_submission_deadline')->nullable();
            $table->date('invoice_submitted_date')->nullable();
            $table->timestamp('ses_migo_date')->nullable();
            $table->timestamp('invoice_reminder_at')->nullable();
            $table->timestamp('pi_submitted_at')->nullable();
            $table->timestamp('invoice_submitted_at')->nullable();

            // $table->timestamp('ses_migo_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('finance_status')->nullable();
            $table->unsignedBigInteger('delete_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('pi_submitted')->nullable();
            $table->boolean('invoice_submitted')->nullable();
            $table->string('email_cc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_reminder');
    }
};
