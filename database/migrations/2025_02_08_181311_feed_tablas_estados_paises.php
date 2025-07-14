<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // // Consulta a la API de SEPOMEX o Geonames
        // $response = Http::get('https://api-sepomex.hckdrk.mx/query/get_estados');

        // if ($response->successful()) {
        //     $estados = $response->json()['response']['estados'];
        //     // Insertar Estados
        //     foreach ($estados as $estado) {
        //         $stateId = DB::table('states')->insertGetId([
        //             'name' => $estado['nombre'],
        //             'abbreviation' => $estado['abrev'],
        //             'country_id' => DB::table('countries')->where('iso_code', 'MEX')->value('id'),
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);

        //         // Municipios
        //         $municipiosResponse = Http::get("https://api-sepomex.hckdrk.mx/query/get_municipios_por_estado/{$estado['nombre']}");

        //         if ($municipiosResponse->successful()) {
        //             $municipios = $municipiosResponse->json()['response']['municipios'];

        //             foreach ($municipios as $municipio) {
        //                 $municipalityId = DB::table('municipalities')->insertGetId([
        //                     'name' => $municipio['nombre'],
        //                     'state_id' => $stateId,
        //                     'created_at' => now(),
        //                     'updated_at' => now(),
        //                 ]);

        //                 // Colonias
        //                 $coloniasResponse = Http::get("https://api-sepomex.hckdrk.mx/query/get_colonias_por_municipio/{$municipio['nombre']}");

        //                 if ($coloniasResponse->successful()) {
        //                     $colonias = $coloniasResponse->json()['response']['colonias'];

        //                     foreach ($colonias as $colonia) {
        //                         DB::table('colonies')->insert([
        //                             'name' => $colonia['nombre'],
        //                             'municipality_id' => $municipalityId,
        //                             'postal_code' => $colonia['cp'],
        //                             'created_at' => now(),
        //                             'updated_at' => now(),
        //                         ]);
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
