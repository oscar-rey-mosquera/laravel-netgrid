<?php

namespace App\Http\Controllers\Character;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoriteCharacter;
use Symfony\Component\HttpFoundation\Response;

class DeleteFavoriteCharacterController extends Controller
{
    
    public function handler(Request $request, $id) {
        
        $favoriteCharacters = FavoriteCharacter::where([
            'user_id' => auth()->user()->id,
            'character_id' => $id
        ])->first();

        if(!$favoriteCharacters) {

            return response()->json([],Response::HTTP_NOT_FOUND);
        }

        $favoriteCharacters->delete();

        return response()->noContent();
        
    }
}
