<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameModel;
use App\Models\CategoryModel;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class GamesController extends Controller
{
    public function index ()
    {
        $games = GameModel::with('category')->get();
        return view('games.index', compact('games'));

        // $games = GameModel::all();
        // return response()->json(['games' => $games], 200);
        // return view('games.index', compact('games'));
    }

    public function new ()
    {
        $categories = CategoryModel::all();
        return view('games.form', compact('categories'));
    }
    

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'category_id' => 'required',
            'price' => 'required',
        ]);

        $games = GameModel::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'status' => true
        ]);

        $games->save();
        $categories = CategoryModel::all();

        try {
            $games = GameModel::with('category')->get();
            return redirect(RouteServiceProvider::INDEX);

        } catch (\Exception $e) {
            $categories = CategoryModel::all();
            return redirect(RouteServiceProvider::GAMESFORMS);
        }
    }

    public function update(Request $request, $id)
    {
        $game = GameModel::findOrFail($id); // recuperamos el modelo correspondiente al registro que queremos actualizar

        // Actualizar los campos del registro con los nuevos valores
        $game->name = $request->input('name');
        $game->category_id = $request->input('category_id');
        $game->price = $request->input('price');

        $game->update();

        if($game->update()){
            return response()->json(['message' => 'Videojuego ' . $game->name . ' Actualizada con Exito', 'game' => $game], 201);
        }
        return response()->json(['error' => 'Fallo Al Actualizar VideoJuego: ' . $game->name], 404);
       
    }

    public function destroy(Request $request, $id)
    {
        $game = GameModel::findOrFail($id);

        // Verificar el estado actual y cambiarlo utilizando un operador ternario
        $game->status = $game->status ? false : true;

        if ($game->status == true){
            $mensaje = 'Activado';
        }else{
            $mensaje = 'Desactivado';
        }

        // Guardar los cambios
        $game->save();

        if($game->save()){
            return response()->json(['message' => 'VideoJuego ' . $game->name .' Se ha ' . $mensaje . ' con Exito', 'game' => $game], 201);
        }
        return response()->json(['error' => 'No Se Ha ' . $mensaje . ' La VideoJuego: ' . $game->name], 404);


    }
}