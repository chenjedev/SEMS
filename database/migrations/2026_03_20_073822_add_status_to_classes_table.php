<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('school_classes', function (Blueprint $table) {
        
        $table->string('result_status')->default('pending'); 
    });
}

public function down()
{
    Schema::table('school_classes', function (Blueprint $table) {
        $table->dropColumn('result_status');
    });
}
};
