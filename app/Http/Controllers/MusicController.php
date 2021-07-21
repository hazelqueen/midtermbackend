<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Exception;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function show(Music $music) {
        return response()->json($music,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $musics = Music::where('title','like',"%$request->key%")
            ->orWhere('album','like',"%$request->key%")->get();

        return response()->json($musics, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'string|required',
            'artist' => 'string|required',
            'genre' => 'string|required',
            'album' => 'string|required',
            'date_released' => 'date|required',
        ]);

        try {
            $music = Music::create($request->all());
            return response()->json($music, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Music $music) {
        try {
            $music->update($request->all());
            return response()->json($music, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Music $music) {
        $music->delete();
        return response()->json(['message'=>'Music deleted.'],202);
    }

    public function index() {
        $musics = Music::orderBy('title')->get();
        return response()->json($musics, 200);
    }
}
