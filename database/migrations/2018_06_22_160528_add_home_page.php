<?php

use App\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHomePage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function(Blueprint $table) {
            $table->timestamps();
        });

        DB::table('pages')->insert([
            'name' => 'home',
            'icon' => 'home',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function(Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Page::where('name', 'Home')->first()->delete();
    }
}
