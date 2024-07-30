<?php

namespace App\Http\Controllers;

use App\Models\Disco;
use Illuminate\Http\Request;

class DiscoController extends Controller
{
    public function index()
    {
        return Disco::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $disco = Disco::create($request->all());
        return response()->json($disco, 201);
    }

    public function show($id)
    {
        return Disco::findOrFail($id);
    }

    public function update(Request $request, $id)
    {

        $disco = Disco::findOrFail($id);

        $disco->update($request->all());

        return $disco;
    }


    public function destroy($id)
    {

        return Disco::destroy($id);
    }
}
