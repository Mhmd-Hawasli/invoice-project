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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->decimal('collected_amount', 10, 2)->nullable();
            $table->decimal('commission_amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('rate_vat', 5, 2);
            $table->decimal('value_vat', 8, 2);
            $table->decimal('total', 8, 2);
            $table->integer('status');
            /* 0 => غير مدفوعة
               1 => مدفوعة
               2 => مدفوعة جزئيا
            */
            $table->text('note')->nullable();
            $table->string('attachment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
