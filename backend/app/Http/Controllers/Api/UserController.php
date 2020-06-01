<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Help\ApiError;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // list of users
    public function index(){
        //$data = ['data' => $this->user->all()];
        return response()->json($this->user->paginate(6));
    }

    // search for id user
    public function show($id){
        $user = $this->user->find($id);
        if(!$user)
            return response()->json(ApiError::erroMessage('User not found ',2024),404);
        $data = ['data' => $user];
        return response()->json($data);
    }
    
    // create new user
    public function store(Request $request){

        try{
             $name = $request->input('name');
             $email = $request->input('email');
             $permision = $request->input('permision');
             $passord = md5($request->input('password'));
             $userData = [
                 'name' =>$name,
                 'email' =>$email,
                 'password' =>$passord,
                 'permision' =>$permision
             ];

             $this->user->create($userData);
             $result = ['data'=> ['msg'=> 'User successfully created !']];
             return response()->json( $result, 201);
        }catch(\Exception $e){
             if(config('app.debug')){
                 return response()->json(ApiError::erroMessage($e->getMessage(),2020),500);
             }
             return response()->json(ApiError::erroMessage("There is an error during the operation of new user!",2020));
        }
     }

      // create new user
    public function update(Request $request, $id){

        try{
             $name = $request->input('name');
             $email = $request->input('email');
             $permision = $request->input('permision');
             $passord = md5($request->input('password'));
             $userData = [
                 'name' =>$name,
                 'email' =>$email,
                 'password' =>$passord,
                 'permision' =>$permision
             ];
             $user = $this->user->find($id);
             $user->update($userData);
             $result = ['data'=> ['msg'=> 'User updated successfully!']];
             return response()->json( $result, 201);
        }catch(\Exception $e){
             if(config('app.debug')){
                 return response()->json(ApiError::erroMessage($e->getMessage(),2020),500);
             }
             return response()->json(ApiError::erroMessage("There is an error during the operation update",2020));
        }
     }

      // destroy User
      public function delete(User $id){
        try{
            $id->delete();
            return  response()->json(['data' => ['msg' => 'User '.$id->name.' User remover successfully!']],200);
       }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::erroMessage($e->getMessage(),2022));
            }
            return response()->json(ApiError::erroMessage("There is an error during the operation remover",2022));
       }
     }

     // login de user
     public function login (Request $request){
     
        $email = $request->input('email');
        $pass = md5($request->input('password'));
        $user = $this->user->where('email', $email)->where('password',$pass)->get();
       
        if(!$user)
            return response()->json(ApiError::erroMessage('User not found ',2024),404);
        $data = ['data' => $user];
        return response()->json($data);
     }


     

     
}
