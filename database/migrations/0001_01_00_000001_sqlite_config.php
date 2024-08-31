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
      if (DB::getDriverName() === 'sqlite') {
        DB::statement('PRAGMA journal_mode = WAL;');
        DB::statement('PRAGMA synchronous = NORMAL;');
        DB::statement('PRAGMA page_size = 32768;');
        DB::statement('PRAGMA cache_size = -20000;');
        DB::statement('PRAGMA auto_vacuum = incremental;');
      }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      if (DB::getDriverName() === 'sqlite') {
        DB::statement('PRAGMA journal_mode = DELETE;'); // Default mode
        DB::statement('PRAGMA synchronous = FULL;');    // Default mode
        DB::statement('PRAGMA page_size = 4096;');      // Default page size
        DB::statement('PRAGMA cache_size = -2000;');    // Default cache size (~8MB with default page size)
        DB::statement('PRAGMA auto_vacuum = NONE;');    // Default vacuum mode
      }
    }
};
