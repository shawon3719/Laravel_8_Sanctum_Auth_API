<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class loginController extends Controller
{
    /**
     * @OA\POST(
     *     path="/api/login",
     *     tags={"Authentication"},
     *     summary="Login",
     *     description="Login",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", example="shawon@gmail.com"),
     *              @OA\Property(property="password", type="string", example="123456")
     *          ),
     *      ),
     *      @OA\Response(response=200, description="Login" ),
     *      @OA\Response(response=401, description="UnAuthorized"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     * @OA\SecurityScheme(
     *   securityScheme="Bearer",type="apiKey",description="Sanctum",name="Authorization",in="header",
     * )
     */
    public function login(Request $request){
        try{
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            $credentials = request(['email', 'password']);

            if(!Auth::attempt($credentials)){
                return response()->json([
                    'status_code' => JsonResponse::HTTP_UNAUTHORIZED,
                    'message' => 'Unauthorized user.',
                ],JsonResponse::HTTP_UNAUTHORIZED);
            }

            $user = User::where('email', $request->email)->first();

            if(!Hash::check($request->password, $user->password, [])){
                return response()->json([
                    'status_code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Password didn not match to our records!',
                ]);
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => JsonResponse::HTTP_OK,
                'message' => 'Login Successfull!',
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);
        }catch(Exception $error){
            return response()->json([
                'status_code' => JsonResponse::HTTP_BAD_REQUEST,
                'message' => 'Login Failed!',
                'error' => $error,
            ]);
        }
    }
}
