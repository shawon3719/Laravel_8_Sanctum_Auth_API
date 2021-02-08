<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class userController extends Controller
{
     /**
     * @OA\GET(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Get Users List",
     *     description="Get Users List as Array",
     *     operationId="index",
     *     @OA\Response(response=200,description="Get User List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function userdata(Request $request){
        return UserResource::collection(User::all());
    }
}

