<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [

            ['city'=>'Cuenca','province'=>'Azuay','country'=>'Ecuador','latitude'=>-2.9006,'longitude'=>-79.0045],
            ['city'=>'Guaranda','province'=>'Bolívar','country'=>'Ecuador','latitude'=>-1.5926,'longitude'=>-79.0009],
            ['city'=>'Azogues','province'=>'Cañar','country'=>'Ecuador','latitude'=>-2.7397,'longitude'=>-78.8486],
            ['city'=>'Tulcán','province'=>'Carchi','country'=>'Ecuador','latitude'=>0.8119,'longitude'=>-77.7172],
            ['city'=>'Riobamba','province'=>'Chimborazo','country'=>'Ecuador','latitude'=>-1.6636,'longitude'=>-78.6546],
            ['city'=>'Latacunga','province'=>'Cotopaxi','country'=>'Ecuador','latitude'=>-0.9352,'longitude'=>-78.6155],
            ['city'=>'Machala','province'=>'El Oro','country'=>'Ecuador','latitude'=>-3.2581,'longitude'=>-79.9554],
            ['city'=>'Esmeraldas','province'=>'Esmeraldas','country'=>'Ecuador','latitude'=>0.9592,'longitude'=>-79.6539],
            ['city'=>'Puerto Baquerizo Moreno','province'=>'Galápagos','country'=>'Ecuador','latitude'=>-0.9026,'longitude'=>-89.6102],
            ['city'=>'Guayaquil','province'=>'Guayas','country'=>'Ecuador','latitude'=>-2.1709,'longitude'=>-79.9224],
            ['city'=>'Ibarra','province'=>'Imbabura','country'=>'Ecuador','latitude'=>0.3517,'longitude'=>-78.1223],
            ['city'=>'Loja','province'=>'Loja','country'=>'Ecuador','latitude'=>-3.9931,'longitude'=>-79.2042],
            ['city'=>'Babahoyo','province'=>'Los Ríos','country'=>'Ecuador','latitude'=>-1.8022,'longitude'=>-79.5344],
            ['city'=>'Portoviejo','province'=>'Manabí','country'=>'Ecuador','latitude'=>-1.0546,'longitude'=>-80.4545],
            ['city'=>'Macas','province'=>'Morona Santiago','country'=>'Ecuador','latitude'=>-2.3087,'longitude'=>-78.1114],
            ['city'=>'Tena','province'=>'Napo','country'=>'Ecuador','latitude'=>-0.9892,'longitude'=>-77.8129],
            ['city'=>'Francisco de Orellana','province'=>'Orellana','country'=>'Ecuador','latitude'=>-0.4629,'longitude'=>-76.9868],
            ['city'=>'Puyo','province'=>'Pastaza','country'=>'Ecuador','latitude'=>-1.4920,'longitude'=>-77.9934],
            ['city'=>'Quito','province'=>'Pichincha','country'=>'Ecuador','latitude'=>-0.1807,'longitude'=>-78.4678],
            ['city'=>'Santa Elena','province'=>'Santa Elena','country'=>'Ecuador','latitude'=>-2.2262,'longitude'=>-80.8587],
            ['city'=>'Santo Domingo','province'=>'Santo Domingo de los Tsáchilas','country'=>'Ecuador','latitude'=>-0.2522,'longitude'=>-79.1719],
            ['city'=>'Nueva Loja','province'=>'Sucumbíos','country'=>'Ecuador','latitude'=>0.0847,'longitude'=>-76.8828],
            ['city'=>'Ambato','province'=>'Tungurahua','country'=>'Ecuador','latitude'=>-1.2491,'longitude'=>-78.6167],
            ['city'=>'Zamora','province'=>'Zamora Chinchipe','country'=>'Ecuador','latitude'=>-4.0668,'longitude'=>-78.9549],

        ];

        foreach ($locations as $location) {

            Location::create([
                'user_id'   => 1,
                'city'      => $location['city'],
                'province'  => $location['province'],
                'country'   => $location['country'],
                'latitude'  => $location['latitude'],
                'longitude' => $location['longitude'],
            ]);

        }
    }
}