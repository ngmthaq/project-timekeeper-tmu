<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_offs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->enum("shifts", [1, 2, 3]); // 1: ca sáng, 2: ca chiều, 3: cả ngày
            $table->date("date");
            $table->enum("status", [0, 1, 2])->default(0); // 0: đang đợi duyệt, 1: chấp nhận, 2: từ chối
            $table->text("reason");
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
        Schema::dropIfExists('day_offs');
    }
}
