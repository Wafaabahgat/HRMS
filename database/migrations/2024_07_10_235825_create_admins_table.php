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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->nullable();
            $table->string('username', 100);
            $table->string('password', 225);
            $table->integer('added_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->tinyInteger('active')->default(1);
            $table->date('date')->default(now()->format('Y-m-d'));
            $table->integer('comp_code')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};