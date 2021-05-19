<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriterias', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pendidikan');
            $table->boolean('penyakit_berat'); //alias tes kesehatan
            $table->string('pengetahuan_kesehatan');
            $table->string('keaktifan_sosial');
            $table->string('keahlian_komputer');
            $table->string('kepribadian');
            $table->boolean('mempunyai_hp');
            $table->uuid('kader_id')->unique();
            $table->foreign('kader_id')->references('id')->on('kaders')->onDelete('cascade');
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
        Schema::dropIfExists('kriterias');
    }
}
