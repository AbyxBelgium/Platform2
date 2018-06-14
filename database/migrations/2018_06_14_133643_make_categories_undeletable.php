<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCategoriesUndeletable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function(Blueprint $table){
            $table->boolean('deletable')->default(true);
        });

        DB::table('categories')->insert([
            'name' => 'Uncategorized',
            'icon' => 'layers_clear',
            'deletable' => false
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function(Blueprint $table) {
            $table->dropColumn('deletable');
        });
    }
}
