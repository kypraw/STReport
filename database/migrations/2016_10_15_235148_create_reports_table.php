<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('jabatan_now');
            $table->string('nomor_st');
            $table->string('daerah');
            $table->integer('tahun');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->text('perihal');
            $table->longText('laporan');
            $table->string('unique_code')->unique();
            $table->string('st_path')->default('');
            $table->string('laporan_path')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
