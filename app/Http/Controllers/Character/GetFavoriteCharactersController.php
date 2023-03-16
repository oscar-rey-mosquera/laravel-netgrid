<?php

namespace App\Http\Controllers\Character;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoriteCharacter;
use Symfony\Component\HttpFoundation\Response;

class GetFavoriteCharactersController extends Controller
{
   
    public function handler(Request $request) {
        
        $favoriteCharacters = auth()->user()->favoriteCharacters()->paginate(20);

        return $favoriteCharacters;
        
    }


    public function show($id) {
        
        $favoriteCharacter =   $favoriteCharacters = FavoriteCharacter::where([
            'user_id' => auth()->user()->id,
            'character_id' => $id
        ])->first();


        if(!$favoriteCharacters) {

            return response()->json([],Response::HTTP_NOT_FOUND);
        }


        return $favoriteCharacters;
        
    }
}
