<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use App\Models\Disco;
use Illuminate\Http\Request;

class MusicaController extends Controller
{
    public function index()
    {
        $musicas = Musica::select('musicas.*', 'discos.nome as nome_album')
        ->join('discos', 'musicas.id_album', '=', 'discos.id')
        ->get();

        return response()->json($musicas);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'duracao' => 'required|integer',
            'id_album' => 'required|exists:discos,id',
        ]);

        // Encontra o disco para obter o nome do álbum
        $disco = Disco::findOrFail($request->id_album);

        $musica = Musica::create([
            'nome' => $request->nome,
            'duracao' => $request->duracao,
            'id_album' => $request->id_album,
            'nome_album' => $disco->nome
        ]);

        return response()->json($musica, 201);
    }


    public function show($id)
    {
        $musica = Musica::select('musicas.*', 'discos.nome as nome_album')
        ->join('discos', 'musicas.id_album', '=', 'discos.id')
        ->where('musicas.id', $id)
        ->firstOrFail();
        return response()->json($musica);
    }


    public function update(Request $request, $id)
    {
        $musica = Musica::findOrFail($id);

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'duracao' => 'sometimes|required|integer',
            'id_album' => 'sometimes|required|exists:discos,id',
        ]);

        $musica->update($request->all());

        // Atualiza o nome do álbum
        if ($request->has('id_album')) {
            $disco = Disco::findOrFail($request->id_album);
            $musica->nome_album = $disco->nome;
            $musica->save();
        }
        return response()->json($musica);
    }

    public function destroy($id)
    {
        // Verifica se a música existe antes de tentar deletar
        $musica = Musica::find($id);

        if ($musica) {
            $musica->delete();  // Deleta a música
            return response()->json(['message' => 'Música deletada com sucesso.'], 200);
        } else {
            return response()->json(['message' => 'Música não encontrada.'], 404);
        }
    }
}
