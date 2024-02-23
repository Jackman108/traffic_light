<?php
//database/migrations/2024_02_22_221231_create_traffic_logs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficLogsTable extends Migration
{

    public function up(): void
    {
        Schema::create('traffic_logs', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('traffic_logs');
    }
}
