<?php

use App\Models\Machine;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Machine::create([
            'name' => 'Maquina 3D',
            'description' => "Màquina que serveix per produir representacions 3D físiques de models creats per ordinador, mitjançant una tècnica anomenada fabricació additiva."
        ]);

        Machine::create([
            'name' => 'Torn',
            'description' => "És un tipus de màquina-eina que permet mecanitzar peces de forma geomètrica de revolució. Es pot accionar a través d'una maneta o d'un motor."
        ]);

        Machine::create([
            'name' => 'Fresadora',
            'description' => "És una màquina eina utilitzada per donar formes complexes a peces de metall, plàstic, fusta o altres materials. Fa operacions com tall de ranures, planejats, perforacions..."
        ]);

        Machine::create([
            'name' => 'Maquina de cosir',
            'description' => "És una màquina que s'utilitza per cosir tela i altres materials juntament amb fil. Porta un protector d'agulles, per tal d'evitar lesions accidentals per punxades."
        ]);

        Machine::create([
            'name' => 'Talladora laser',
            'description' => "Màquina que fa servir el tallatge o tallament làser, que és una tecnologia que fa ús d'un raig làser per tallar diferents materials amb molt bona precisió."
        ]);

        Machine::create([
            'name' => 'Trepant',
            'description' => "Màquina o eina amb la que es mecanitzen la majoria de forats que es fan a les peces dels tallers mecànics. Es caracteritza per ser molt fàcil de fer servir."
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machines');
    }
}
