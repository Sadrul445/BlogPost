<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
    public function registration(Request $request){
        //validation
        $data = $request->validate(
            [
                "name"=>"required|string",
                "email"=>"required|string|unique:users,email",
                "password"=>"required|string|confirmed",
            ]
            );
            //create_user
            $user  = User::create([
                "name"=> $data["name"],
                "email"=> $data["email"],
                "password"=> bcrypt($data["password"])
            ]);
            //token

            $token=$user->createToken('myBlogWebToken')->plainTextToken;
            $response = [
                "user" => $user,
                "token"=> $token
            ];
            return Response($response,201);
    }
    public function login(Request $request){
        $data = $request->validate(
            [
                "email"=>"required|string",
                "password"=>"required|string"
            ]
            );
            //email check
            $user=User::where("email",$data["email"])->first();
            //check password
            if(!$user || !Hash::check($data["password"],$user->password)){
                return response([
                    "message" => "Bad Credentials",
                ],401);
            }
            // //token
            $token=$user->createToken('myBlogWebToken')->plainTextToken;
            $response=[
                "user" =>$user,
                "token"=>$token
            ];
            return Response($response,201);
        }
    public function logout(Request $request){

    }
   
}
