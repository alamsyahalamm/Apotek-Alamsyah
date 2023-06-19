<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->char('Kode_Obat', 8)->unique();
            $table->string('Nama_Obat');
            $table->string('Bentuk_Obat');
            $table->integer('Hargas');
            $table->date('Tgl_Masuk');
            $table->date('Tgl_Kadaluarsa');
            $table->string('Indikasi');
            $table->string('Kontra_Indikasi');
            $table->string('Aturan');
            $table->integer('Stok')->nullable();
            $table->string('Gambar');
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
        Schema::dropIfExists('obats');
    }
}
