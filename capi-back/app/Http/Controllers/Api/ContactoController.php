<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ContactoService;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    protected $contactoService;

    public function __construct(ContactoService $contactoService)
    {
        $this->contactoService = $contactoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->contactoService->getAllContactos());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'notas' => 'nullable|string|max:255',
            'pagina_web' => 'nullable|url',
            'fecha_cumpleanios' => 'nullable|date_format:Y-m-d',
            'emails' => 'nullable|array',
            'emails.*.email' => 'required_if:emails,array|email', // Validar cada email dentro del array
            'direcciones' => 'nullable|array',
            'direcciones.*.calle' => 'nullable|string|max:255',
            'direcciones.*.ciudad' => 'nullable|string|max:255',
            'direcciones.*.estado' => 'nullable|string|max:255',
            'direcciones.*.pais' => 'nullable|string|max:255',
            'direcciones.*.codigo_postal' => 'nullable|string|max:20',
            'telefonos' => 'nullable|array',
            'telefonos.*.numero_telefono' => 'required_if:telefonos,array|string|max:20'
        ]);

        return response()->json($this->contactoService->createContacto($data), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->contactoService->getContactoById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'notas' => 'nullable|string|max:255',
            'pagina_web' => 'nullable|url',
            'fecha_cumpleanios' => 'nullable|date_format:Y-m-d',
            'emails' => 'nullable|array',
            'emails.*.email' => 'required_if:emails,array|email', // Validar cada email dentro del array
            'direcciones' => 'nullable|array',
            'direcciones.*.calle' => 'nullable|string|max:255',
            'direcciones.*.ciudad' => 'nullable|string|max:255',
            'direcciones.*.estado' => 'nullable|string|max:255',
            'direcciones.*.pais' => 'nullable|string|max:255',
            'direcciones.*.codigo_postal' => 'nullable|string|max:20',
            'telefonos' => 'nullable|array',
            'telefonos.*.numero_telefono' => 'required_if:telefonos,array|string|max:20'
        ]);
        return response()->json($this->contactoService->updateContacto($id, $data), 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json($this->contactoService->deleteContacto($id), 201);
    }
}
