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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('departure');
            $table->string('dest');
            $table->decimal('price', 8, 2);
            $table->integer('seats_left');
            $table->text('description');
            $table->date('departure_date');
            $table->string('airline_name');
            $table->string('picture_url'); // صورة طيارة

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
