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
        $idColumn = collect(Schema::getColumns('user'))->firstWhere('name', 'id');

        if (in_array(strtolower($idColumn['type_name'] ?? ''), ['char', 'varchar', 'uuid'], true)
            && ! ($idColumn['auto_increment'] ?? false)) {
            return;
        }

        if (DB::connection()->getDriverName() === 'sqlite') {
            Schema::create('user_uuid_migration', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('nama');
                $table->string('nim');
                $table->foreignId('kelas_id')->constrained('kelas');
                $table->timestamps();
            });

            foreach (DB::table('user')->orderBy('id')->get() as $user) {
                DB::table('user_uuid_migration')->insert([
                    'id' => (string) Str::uuid(),
                    'nama' => $user->nama,
                    'nim' => $user->nim,
                    'kelas_id' => $user->kelas_id,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]);
            }

            Schema::drop('user');
            Schema::rename('user_uuid_migration', 'user');

            return;
        }

        Schema::table('user', function (Blueprint $table) {
            $table->uuid('uuid')->nullable();
        });

        foreach (DB::table('user')->select('id')->orderBy('id')->get() as $user) {
            DB::table('user')->where('id', $user->id)->update(['uuid' => (string) Str::uuid()]);
        }

        Schema::table('user', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('id');
            $table->renameColumn('uuid', 'id');
            $table->primary('id');
        });
    }

    public function down(): void
    {
        // UUID primary keys are retained when rolling back this data migration.
    }
};
