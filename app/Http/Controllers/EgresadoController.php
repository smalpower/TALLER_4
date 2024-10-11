<?php

namespace App\Http\Controllers;

use App\Models\Egresado;
use Illuminate\Http\Request;

class EgresadoController extends Controller
{
    public function index()
    {
        $egresados = Egresado::all();
        return view('egresados.index', compact('egresados'));
    }

    public function create()
    {
        return view('egresados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required|unique:egresados',
            'celular' => 'required',
            'correo' => 'required|email|unique:egresados',
            'ciudad' => 'required',
        ]);

        Egresado::create($request->all());

        return redirect()->route('egresados.index')->with('success', 'Egresado creado correctamente.');
    }

    public function show(Egresado $egresado)
    {
        return view('egresados.show', compact('egresado'));
    }

    public function edit(Egresado $egresado)
    {
        return view('egresados.edit', compact('egresado'));
    }

    public function update(Request $request, Egresado $egresado)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required|unique:egresados,cedula,' . $egresado->id,
            'celular' => 'required',
            'correo' => 'required|email|unique:egresados,correo,' . $egresado->id,
            'ciudad' => 'required',
        ]);

        $egresado->update($request->all());

        return redirect()->route('egresados.index')->with('success', 'Egresado actualizado correctamente.');
    }

    public function destroy(Egresado $egresado)
    {
        $egresado->delete();
        return redirect()->route('egresados.index')->with('success', 'Egresado eliminado correctamente.');
    }
}
