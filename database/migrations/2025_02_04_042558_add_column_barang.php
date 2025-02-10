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
        Schema::table('tm_barang_inventaris', function (Blueprint $table) {
            $table->string('jns_brg_kode', 5)->nullable();
            $table->foreign('jns_brg_kode')->references('jns_brg_kode')->on('tr_jenis_barang');
            $table->string('user_id', 10)->nullable();
            $table->foreign('user_id')->references('user_id')->on('tm_user');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_barang_inventaris', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropForeign(['user_id']);
                        $table->dropColumn('jns_brg_kode');
            $table->dropForeign(['jns_brg_kode']);
        });
    }
};
