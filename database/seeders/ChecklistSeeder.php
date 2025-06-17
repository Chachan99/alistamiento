<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemChecklist;

class ChecklistSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // Documentos
            'Licencia de tránsito',
            'Revisión técnico mecánica',
            'SOAT',
            'Seguro RCC - RCC',
            'Licencia de conducción',
            'Cédula de ciudadanía',

            // Equipo de emergencia
            'Kit de carretera',
            'Cámara fotográfica',
            'Linterna',
            'Botiquín',
            'Extintor cargado',
            'Pines de seguridad',

            // Herramientas
            'Triángulo reflectivo',
            'Caja de herramientas',
            'Cruceta',
            'Trapeador',
            'Llanta de repuesto',
            'Cables de arranque',

            // Vidrios / Espejos
            'Parabrisas',
            'Limpiaparabrisas',
            'Luces delanteras',
            'Vidrio trasero',
            'Espejo izquierdo',
            'Espejo derecho',
            'Espejo interior',

            // Fluidos
            'Aceite motor',
            'Último cambio de aceite',
            'Agua refrigerante',
            'Agua para frenos',
            'Aceite dirección',
            'Nivel combustible',
            'Líquido de frenos',
            'Fugas de agua',
            'Fugas de aceite',

            // Neumáticos / Estructura
            'Delantero derecho',
            'Delantero izquierdo',
            'Trasero derecho',
            'Trasero izquierdo',
        ];

        foreach ($items as $nombre) {
            ItemChecklist::create([
                'nombre' => $nombre,
                'activo' => true
            ]);
        }
    }
}
