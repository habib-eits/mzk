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
         Schema::table('invoice_detail', function (Blueprint $table) {
            $table->decimal('Previous',15,2)->nullable();
            $table->decimal('Current',15,2)->nullable();
            $table->decimal('Cumulative',15,2)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_detail', function (Blueprint $table) {
            $table->dropColumn([
                'Previous',
                'Current',
                'Cumulative',
            ]);

        });
    }
};
