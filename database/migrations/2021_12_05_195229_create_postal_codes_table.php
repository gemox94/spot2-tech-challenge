<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\State;

class CreatePostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->id();
            $table->char('code', 20);
            $table->char('settlement', 255);
            $table->char('settlement_type', 255);
            $table->char('municipality', 255);
            $table->char('city', 255);
            $table->char('zone', 255);
            $table->foreignIdFor(State::class);
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
        Schema::dropIfExists('postal_codes');
    }
}
