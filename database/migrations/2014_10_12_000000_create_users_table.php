<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('admin')->default(0);
            $table->string('targeta')->default("00 00 00 00");
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'Kiriam',
            'email' => 'kiriamcf@gmail.com',
            'password' => Hash::make(''),
            'admin' => 1,
            'targeta' => '86 77 9C 14'
        ]);

        User::create([
            'name' => 'Roger',
            'email' => 'roger.escudero@estudiantat.upc.edu',
            'password' => Hash::make('Rogerescudero5'),
            'admin' => 1,
            'targeta' => 'DD 9E C0 F6'
        ]);

        User::create([
            'name' => 'Elias',
            'email' => 'elias.ben-seddik@estudiantat.upc.edu',
            'password' => Hash::make('elmascabrondetantos'),
            'admin' => 1,
            'targeta' => '46 66 A9 14'
        ]);

        User::create([
            'name' => 'Christian',
            'email' => 'christian.mambo-matala@estudiantat.upc.edu',
            'password' => Hash::make('ChristiaN15'),
            'admin' => 1,
            'targeta' => '3D 90 BF F6'
        ]);

        User::create([
            'name' => 'Normal_User',
            'email' => 'NormalUser@gmail.com',
            'password' => Hash::make('normaluser'),
            'admin' => 1,
            'targeta' => 'AB CD EF GH'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
