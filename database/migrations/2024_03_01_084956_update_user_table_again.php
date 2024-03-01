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
        Schema::table('users', function (Blueprint $table) {
            $table->binary('logo')->nullable()->after('fax'); // Spalte vom Typ "BLOB" für das Benutzerlogo
        });
    }

    /**
     * Rolle die Migration zurück.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('logo'); // Entfernen der Spalte für das Benutzerlogo
        });
    }
};
