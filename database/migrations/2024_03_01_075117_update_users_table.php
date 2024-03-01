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
            $table->boolean('is_admin')->default(false);
            $table->boolean('membership_status')->default(false);
            $table->string('contact_person_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
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
            $table->dropColumn('is_admin');
            $table->dropColumn('membership_status');
            $table->dropColumn('contact_person_name');
            $table->dropColumn('phone');
            $table->dropColumn('fax');
        });
    }
};
