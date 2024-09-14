<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientesController extends Controller
{
    // Método index
    public function index()
    {
        $datos = Clientes::paginate(5);
        return view('inicio', compact('datos'));
    }

    public function create()
    {
        return view('clientes.create');
    }




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Codigo' => 'required|string|max:255',
            'Empresa_Cliente' => 'required|string|max:255',
            'Correo_Electronico' => 'required|email|max:255',
            'Estado' => 'required|string',
            'Telefono' => 'required|string|max:15',
            'DPI' => 'nullable|string|max:50', // Validamos DPI como texto
            'Patente' => 'nullable|string|max:50',
            'RTU' => 'nullable|string|max:50',
            'Tipo_Cliente' => 'required|string',
            'Departamento' => 'required|string',
            'Municipio' => 'required|string',
            'Completar_Direccion' => 'required|string'
        ]);
    
        $cliente = new Clientes($validatedData);
        $cliente->save();
    
        return redirect()->route('clientes.index')->with('success', 'Cliente agregado exitosamente');
    }





    public function show($id)
    {
        $clientes = clientes::find($id);
        return view('eliminar', compact('clientes'));
    }






    public function buscar(Request $request)
    {
        $query = $request->input('query');

        $datos = Clientes::where('Empresa_Cliente', 'LIKE', "%{$query}%")
            ->orWhere('codigo', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($datos);
    }






    public function edit($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.editar', compact('cliente'));
    }


    public function update(Request $request, $id)
    {
        $cliente = Clientes::findOrFail($id);
    
        $validatedData = $request->validate([
            'Codigo' => 'required|string|max:255',
            'Empresa_Cliente' => 'required|string|max:255',
            'Correo_Electronico' => 'required|email|max:255',
            'Estado' => 'required|string',
            'Telefono' => 'required|string|max:15',
            'DPI' => 'nullable|string|max:50',
            'Patente' => 'nullable|string|max:50',
            'RTU' => 'nullable|string|max:50',
            'Tipo_Cliente' => 'required|string',
            'Departamento' => 'required|string',
            'Municipio' => 'required|string',
            'Completar_Direccion' => 'required|string'
        ]);
    
        $cliente->update($validatedData);
    
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }






    public function destroy($id)
    {
        $clientes = Clientes::findOrFail($id);
        $clientes->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con éxito');
    }
}
