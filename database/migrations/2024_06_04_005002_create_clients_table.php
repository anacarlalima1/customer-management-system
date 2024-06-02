<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('clients')) {
            Schema::create('clients', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('social_name')->nullable();
                $table->string('cpf')->unique();
                $table->string('father_name')->nullable();
                $table->string('mother_name')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->unique();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
