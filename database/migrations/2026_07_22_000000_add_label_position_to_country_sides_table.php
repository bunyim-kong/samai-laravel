<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('country_sides', function (Blueprint $table) {
            $table->string('label_position', 10)
                ->default('top')
                ->after('position_left');
        });

        DB::table('country_sides')
            ->whereIn('slug', ['battambang', 'sihanoukville'])
            ->update(['label_position' => 'bottom']);
    }

    public function down(): void
    {
        Schema::table('country_sides', function (Blueprint $table) {
            $table->dropColumn('label_position');
        });
    }
};
