<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{

    public function handler(ProfileRequest $request) {

        return response()->json($request->updateProfile(), Response::HTTP_ACCEPTED);
    }
}
