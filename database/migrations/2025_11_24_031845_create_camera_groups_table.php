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
        Schema::create('camera_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            // Permite que solo el creador pueda modificar el grupo, si es necesario
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Agregar group_id a la tabla 'cameras' existente (punto F)
        Schema::table('cameras', function (Blueprint $table) {
            $table->foreignId('camera_group_id')->nullable()->constrained('camera_groups')->onDelete('set null')->after('name');
        });
    }

    public function down()
    {
        Schema::table('cameras', function (Blueprint $table) {
            $table->dropForeign(['camera_group_id']);
            $table->dropColumn('camera_group_id');
        });
        Schema::dropIfExists('camera_groups');
    }

};
