<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    public function up()
    {
        Schema::create('livros', function(Blueprint $table){
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->year('ano')->nullable();
            $table->decimal('preco', 8, 2)->nullable();
            $table->string('capa')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('livros');
    }
}
