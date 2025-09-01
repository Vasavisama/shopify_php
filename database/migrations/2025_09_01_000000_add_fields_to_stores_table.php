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
        Schema::table('stores', function (Blueprint $table) {
            $table->text('description')->nullable()->after('theme_id');
            $table->string('logo_path')->nullable()->after('description');
            $table->boolean('multi_channel_sales')->default(false)->after('logo_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn(['description', 'logo_path', 'multi_channel_sales']);
        });
    }
};
