<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('gebruikers', function ($table) {
        $table->rememberToken()->nullable();
    });
}

public function down()
{
    Schema::table('gebruikers', function ($table) {
        $table->dropColumn('remember_token');
    });
}
};
