<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('addresses')) {
            Schema::create('addresses', function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained()->onDelete('cascade');
                $table->enum('type', ['Residential', 'Commercial']);
                $table->string('cep');
                $table->string('street');
                $table->string('number');
                $table->string('complement')->nullable();
                $table->string('district');
                $table->string('state');
                $table->string('city');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
