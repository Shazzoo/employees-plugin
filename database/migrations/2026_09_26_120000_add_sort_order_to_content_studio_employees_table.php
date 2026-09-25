<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_studio_employees', function (Blueprint $table): void {
            $table->unsignedInteger('sort_order')->default(0)->after('skills');
        });

        // Keep the current order (by name) as the starting point.
        DB::table('content_studio_employees')->orderBy('name')->pluck('id')
            ->each(fn (int $id, int $index) => DB::table('content_studio_employees')->where('id', $id)->update(['sort_order' => $index + 1]));
    }

    public function down(): void
    {
        Schema::table('content_studio_employees', function (Blueprint $table): void {
            $table->dropColumn('sort_order');
        });
    }
};
