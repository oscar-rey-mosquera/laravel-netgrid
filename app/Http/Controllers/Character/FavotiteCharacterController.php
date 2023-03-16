<?php

namespace App\Http\Controllers\Character;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Character\FavoriteCharacterRequest;
use App\Models\FavoriteCharacter;
use Symfony\Component\HttpFoundation\Response;

class FavotiteCharacterController extends Controller
{
    public function handler(FavoriteCharacterRequest $request) {
        
        $favoriteCharacter = FavoriteCharacter::create($request->characterData());

        return response()->json($favoriteCharacter, Response::HTTP_CREATED );
        
    }
}
