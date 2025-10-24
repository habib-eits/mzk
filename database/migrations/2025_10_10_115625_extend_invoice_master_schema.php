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
            $table->string('Attension')->nullable();
            $table->string('ProjectName')->nullable();
            $table->string('ProjectEngg')->nullable();
            $table->string('TenderNo')->nullable();
            $table->text('scope_of_work')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->unsignedBigInteger('reference_quotation_id');
            $table->integer('is_locked');
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
                'Attension', 
                'ProjectName',
                'ProjectEngg',
                'TenderNo',
                'scope_of_work',
                'terms_and_conditions',
                'reference_quotation_id',
                'is_locked',
                'TotalInvoiceAmount',
                'PrevInvExclRet',
                'RetentionMonthYear',
                'RetentionAmount',
             
            ]);
        });
    }
};
