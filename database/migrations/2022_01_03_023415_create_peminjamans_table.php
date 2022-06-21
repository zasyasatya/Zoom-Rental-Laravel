<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            // Start Mengatur relationalship dengan tabel zoom
            $table->bigInteger('zoom_id', false, true);
            $table->foreign('zoom_id')->references('id')->on('zooms')->onDelete('cascade')->onUpdate('cascade');
            // End mengatur relationalship dengan tabel zoom
            $table->string('nama_kegiatan');
            $table->string('deskripsi');
            $table->date('tanggal');
            $table->time('jam');
            $table->integer('durasi');
            $table->string('room_zoom')->nullable();
            $table->enum('status_request', ['terima', 'tolak', 'diproses']);
            $table->LongText('alasan_penolakan');
            // Start Mengatur Relationalship dengan tabel user
            $table->bigInteger('user_id',false,true); //merepresentasikan mahasiswa yang meminjam akun zoomnya
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // End Mengatur Relationalship dengan tabel user
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
        Schema::dropIfExists('peminjamans');
    }
}
