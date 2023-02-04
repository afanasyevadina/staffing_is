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
        Schema::create('employee_position', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Position::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Employee::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Department::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->date('employed_date')->nullable();
            $table->date('fired_date')->nullable();
            $table->float('positions_count')->nullable();
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
        Schema::dropIfExists('employee_position');
    }
};
