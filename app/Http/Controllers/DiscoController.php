<?php

namespace App\Http\Controllers;

use App\Models\Disco;
use Illuminate\Http\Request;

class DiscoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Disco::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $disco = Disco::create($request->all());
        return response()->json($disco, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Disco::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $disco = Disco::findOrFail($id);

        $disco->update($request->all());

        return $disco;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        return Disco::destroy($id);
    }
}
