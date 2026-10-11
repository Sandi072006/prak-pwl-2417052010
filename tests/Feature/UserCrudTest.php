<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.foreign_key_constraints' => true,
        ]);
        DB::purge('sqlite');
        DB::setDefaultConnection('sqlite');

        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->timestamps();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('nim');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->timestamps();
        });
    }

    public function test_user_records_are_created_with_uuid_primary_keys(): void
    {
        $kelas = Kelas::create(['nama_kelas' => 'A']);
        $user = UserModel::create([
            'nama' => 'Nadia',
            'nim' => '12345',
            'kelas_id' => $kelas->id,
        ]);

        $this->assertTrue(Str::isUuid($user->id));
    }

    public function test_uuid_migration_preserves_existing_student_data(): void
    {
        Schema::drop('user');
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->timestamps();
        });

        $kelas = Kelas::create(['nama_kelas' => 'A']);
        DB::table('user')->insert([
            'nama' => 'Nadia',
            'nim' => '12345',
            'kelas_id' => $kelas->id,
        ]);

        $migration = require database_path('migrations/2026_10_11_000000_update_user_id_to_uuid.php');
        $migration->up();

        $user = DB::table('user')->first();
        $this->assertTrue(Str::isUuid($user->id));
        $this->assertSame('Nadia', $user->nama);
        $this->assertSame('12345', $user->nim);
        $this->assertSame($kelas->id, $user->kelas_id);
    }

    public function test_user_can_be_updated_through_the_edit_form(): void
    {
        $user = $this->createStudent();

        $this->put(route('user.update', $user->id), [
            'nama' => 'Nadia Putri',
            'npm' => '67890',
            'kelas' => 'B',
        ])
            ->assertRedirect(route('user.index'))
            ->assertSessionHas('success');

        $kelasBaru = Kelas::where('nama_kelas', 'B')->firstOrFail();
        $this->assertDatabaseHas('user', [
            'id' => $user->id,
            'nama' => 'Nadia Putri',
            'nim' => '67890',
            'kelas_id' => $kelasBaru->id,
        ]);
    }

    public function test_user_can_be_created_with_a_typed_class_name(): void
    {
        $this->post(route('user.store'), [
            'nama' => 'Nadia',
            'npm' => '12345',
            'kelas' => 'Ilkom',
            ])
            ->assertRedirect(route('user.index'))
            ->assertSessionHas('success');

        $kelas = Kelas::where('nama_kelas', 'Ilkom')->firstOrFail();
        $this->assertDatabaseHas('user', [
            'nama' => 'Nadia',
            'nim' => '12345',
            'kelas_id' => $kelas->id,
        ]);
    }

    public function test_user_can_be_deleted(): void
    {
        $user = $this->createStudent();

        $this->delete(route('user.destroy', $user->id))
            ->assertRedirect(route('user.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('user', ['id' => $user->id]);
    }

    private function createStudent(): UserModel
    {
        $kelas = Kelas::create(['nama_kelas' => 'A']);

        return UserModel::create([
            'nama' => 'Nadia',
            'nim' => '12345',
            'kelas_id' => $kelas->id,
        ]);
    }
}
