<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_studio_employees', function (Blueprint $table): void {
            $table->string('locale', 12)->nullable()->after('id');
            $table->string('translation_key')->nullable()->index()->after('locale');
        });

        // Existing employees belong to the site's default language.
        $settings = Schema::hasTable('settings') ? json_decode((string) DB::table('settings')->value('settings'), true) : [];
        $locale = $settings['default_lang'] ?? 'nl';

        DB::table('content_studio_employees')->orderBy('id')->each(function (object $employee) use ($locale): void {
            DB::table('content_studio_employees')->where('id', $employee->id)->update([
                'locale' => $locale,
                'translation_key' => (string) Str::uuid(),
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('content_studio_employees', function (Blueprint $table): void {
            $table->dropColumn(['locale', 'translation_key']);
        });
    }
};
