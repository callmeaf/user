<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->nullable()->after('id');
            $table->string('type')->nullable()->after('status');
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('mobile')->nullable()->unique()->index()->after('last_name');
            $table->boolean('accepted_terms')->default(false)->after('remember_token');
            $table->softDeletes()->after('remember_token');

            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();

            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            $addedColumns = [
                'status',
                'type',
                'first_name',
                'last_name',
                'mobile',
                'accepted_terms',
                'deleted_at',
            ];
            foreach ($addedColumns as $addedColumn) {
                Schema::whenTableHasColumn('users', $addedColumn, function (Blueprint $table) use ($addedColumn) {
                    $table->dropColumn($addedColumn);
                });
            }

            Schema::whenTableDoesntHaveColumn('users', 'name', function (Blueprint $table) {
                $table->string('name')->after('id');
            });
        }
    }
};
