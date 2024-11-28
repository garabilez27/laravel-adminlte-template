<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->string('usr_id',32)->primary();
            $table->string('usr_fname', 32);
            $table->string('usr_lname', 32);
            $table->string('usr_phone', 12)->nullable();
            $table->string('usr_email', length: 128)->unique();
            $table->string('usr_password', 191);
            $table->string('usr_image', 191)->nullable();
            $table->unsignedTinyInteger('usr_active')->default(1);
            $table->unsignedTinyInteger('usr_deleted')->default(0);
            $table->timestamp('usr_created_at')->useCurrent();
            $table->timestamp('usr_updated_at')->useCurrent()->useCurrentOnUpdate();

            // Foreign Key
            $table->string('rl_id', 32);
            $table->foreign('rl_id')->references('rl_id')->on('tbl_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_users');
    }
};
