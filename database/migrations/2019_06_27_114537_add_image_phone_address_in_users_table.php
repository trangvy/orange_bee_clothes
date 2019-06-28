<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagePhoneAddressInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumns('users', ['image','phone_number', 'address'])) {
                $table->string('image')->nullable();
                $table->string('phone_number')->nullable();
                $table->string('address')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumns('users', ['image', 'phone_number', 'flag'])) {
                $table->dropColumn(['image', 'phone_number', 'address']);
            }
        });
    }
}
