<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;
class registerController extends Controller
{
      /**
     * @OA\POST(
     *     path="/api/users/store",
     *     summary="Create New User",
     *     description="Create New User",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string", example="Masudul Hasan Shawon"),
     *              @OA\Property(property="email", type="string", example="shawon@example.com"),
     *              @OA\Property(property="password", type="string", example="123456"),
     *              @OA\Property(property="password_confirmation", type="string", example="123456")
     *          ),
     *      ),
     *      @OA\Response(response=200, description="Create New User Data" ),
     *      @OA\Response(response=422, description="Invalid submission"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);
            if($validator->fails()){
                return response([
                    'error' => $validator->errors()->all()
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            $request['password'] = Hash::make($request['password']);
            $request['remember_token'] = Str::random(10);
            $user = new User;
            $user->fill($request->toArray())->save();
            return new UserResource($user);

        } catch(Exception $error) {
            return response()->json([
                'status_code' => JsonResponse::HTTP_BAD_REQUEST,
                'message' => 'Failed to create user.',
                'error' => $error,
            ]);
        }
    }
}
