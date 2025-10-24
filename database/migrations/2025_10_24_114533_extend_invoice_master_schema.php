<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_master', function (Blueprint $table) {
            
            $table->decimal('TotalInvoiceAmount',15,2)->nullable();
            $table->decimal('PrevInvExclRet',15,2)->nullable();
            $table->string('RetentionMonthYear')->nullable();
            $table->decimal('RetentionAmount',15,2)->nullable();
            // $table->decimal('Subtotal',15,2)->nullable();
            $table->decimal('CurrentRetention',15,2)->nullable();
            $table->decimal('NetInvoiceAmount',15,2)->nullable();
            $table->decimal('SubtotalVat',15,2)->nullable();
            $table->decimal('CurrentRetentionVat',15,2)->nullable();
            $table->decimal('NetInvoiceAmountVat',15,2)->nullable();
            $table->decimal('NetAmount',15,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_master', function (Blueprint $table) {
            $table->dropColumn([
              
                'TotalInvoiceAmount',
                'PrevInvExclRet',
                'RetentionMonthYear',
                'RetentionAmount',
                // 'Subtotal',
                'CurrentRetention',
                'NetInvoiceAmount',
                'SubtotalVat',
                'CurrentRetentionVat',
                'NetInvoiceAmountVat',
                'NetAmount',
            ]);
        });
    }
};
