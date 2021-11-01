<?php

use App\Enums\SubscriptionStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\OsEnum;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 255);
            $table->unsignedBigInteger('app_id');
            $table->enum('os', OsEnum::toArray());
            $table->string('lang', 3);
            $table->string('token', 100);
            $table->timestamps();
            $table->unique(['uid', 'app_id']);
            $table->index('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
