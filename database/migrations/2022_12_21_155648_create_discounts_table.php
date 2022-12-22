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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('priority')->default(0);
            $table->enum('active', ['0', '1'])->default('0');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('access_type_code', 1);

            $table->foreign('access_type_code')->references('code')->on('access_types');

            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands');

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
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
