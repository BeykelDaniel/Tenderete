<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'rol')) {
                $table->string('rol')->default('usuario')->after('email');
            }
        });

        // Actualizar usuarios existentes que comiencen con admin o sean correos admin
        DB::table('users')
            ->where('email', 'like', 'admin%')
            ->orWhereIn('email', ['cabrerajosedaniel89@gmail.com', 'tenderete@tenderete.com'])
            ->update(['rol' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'rol')) {
                $table->dropColumn('rol');
            }
        });
    }
};
