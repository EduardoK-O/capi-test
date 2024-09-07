<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ContactoRepositoryInterface;
use App\Models\Contacto;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactoRepository implements ContactoRepositoryInterface{
    public function getAllContactos() {
        return Contacto::with(['emails', 'direcciones', 'telefonos'])->get();
    }

    public function getContactoById($id) {
        // Retorna null si no se encuentra el contacto
        $contacto = Contacto::with(['emails', 'direcciones', 'telefonos'])
        ->findOrFail($id);
        if (!$contacto) {
            throw new ModelNotFoundException("Contacto not found.");
        }
        return $contacto;
    }

    public function createContacto(array $data) {
        DB::beginTransaction();
    
        try {
            // Crear el contacto
            $contacto = Contacto::create([
                'nombre' => $data['nombre'] ?? '',
                'notas' => $data['notas'] ?? '',
                'pagina_web' => $data['pagina_web'] ?? '',
                'fecha_cumpleanios' => $data['fecha_cumpleanios'],
            ]);
    
            // Guardar los emails relacionados
            if (!empty($data['emails'])) {
                foreach ($data['emails'] as $email) {
                    $contacto->emails()->create($email);
                }
            }
    
            // Guardar las direcciones relacionadas
            if (!empty($data['direcciones'])) {
                foreach ($data['direcciones'] as $direccion) {
                    $contacto->direcciones()->create($direccion);
                }
            }
    
            // Guardar los teléfonos relacionados
            if (!empty($data['telefonos'])) {
                foreach ($data['telefonos'] as $telefono) {
                    $contacto->telefonos()->create($telefono);
                }
            }
    
            DB::commit();
    
            return $contacto;
    
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateContacto($id, array $data) {        
        // Actualiza el contacto y retorna el resultado
        DB::beginTransaction();

        try {
            // Encuentra el contacto por ID
            $contacto = Contacto::findOrFail($id);
            // Actualiza el contacto
            $contacto->update([
                'nombre' => $data['nombre'] ?? $contacto->nombre,
                'notas' => $data['notas'] ?? $contacto->notas,
                'pagina_web' => $data['pagina_web'] ?? $contacto->pagina_web,
                'fecha_cumpleanios' => $data['fecha_cumpleanios'] ?? $contacto->fecha_cumpleanios,
            ]);

            // Actualizar los emails relacionados
            if (isset($data['emails'])) {
                // Elimina los emails antiguos
                $contacto->emails()->delete();

                // Agrega los nuevos emails
                foreach ($data['emails'] as $email) {
                    $contacto->emails()->create($email);
                }
            }

            // Actualizar las direcciones relacionadas
            if (isset($data['direcciones'])) {
                // Elimina las direcciones antiguas
                $contacto->direcciones()->delete();

                // Agrega las nuevas direcciones
                foreach ($data['direcciones'] as $direccion) {
                    $contacto->direcciones()->create($direccion);
                }
            }

            // Agrega los nuevos teléfonos
            if (!empty($data['telefonos'])) {
                 // Elimina los teléfonos antiguos
                $contacto->telefonos()->delete();
                foreach ($data['telefonos'] as $telefono) {
                    $contacto->telefonos()->create([
                        'numero_telefono' => $telefono['numero_telefono'],
                        'tipo' => $telefono['tipo'] ?? null,
                    ]);
                }
            }


            DB::commit();

            return $contacto;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteContacto($id) {
        // Verifica si el contacto existe antes de eliminar
        DB::transaction(function () use ($id) {
            // Encuentra el contacto por ID
            $contacto = Contacto::findOrFail($id);
    
            // Elimina las relaciones
            $contacto->emails()->delete();
            $contacto->direcciones()->delete();
            $contacto->telefonos()->delete();
    
            // Elimina el contacto
            return $contacto->delete();
        });
        
    }
}