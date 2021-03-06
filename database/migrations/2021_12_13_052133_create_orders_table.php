<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->integer('total')->default(0);
            $table->integer('status')->default(1);
            $table->string('sha_key')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_contact')->nullable();
            $table->string('recipient_address')->nullable();
            $table->string('recipient_state')->nullable();
            $table->string('recipient_zip_code')->nullable();
            $table->string('recipient_sexe')->nullable();
            $table->string('recipient_place')->nullable();
            $table->string('recipient_comment')->nullable();
            $table->integer('recipient_basic')->default(0);
            $table->integer('recipient_tracking')->default(0);
            $table->integer('recipient_premium')->default(0);
            $table->integer('recipient_own_product')->default(0);

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
        Schema::dropIfExists('orders');
    }
}
