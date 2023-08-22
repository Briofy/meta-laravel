<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('briofy-meta.database.connection'))
            ->create('tags', function (Blueprint $table) {
                config('briofy-meta.database.uuid') ? $table->uuid('id')->primary() : $table->id();
                $table->string('model_id')->index()->nullable();
                $table->string('model_type')->index()->nullable();
                $table->string('key');
                $table->text('value');
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
};
