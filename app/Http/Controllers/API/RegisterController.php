<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;
use Validator;

class RegisterController extends BaseController
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        $wallet = Wallet::create([
            'user_id' => $user->id,
            'balance' => 20,
            'debit' => 0,
            'credit' => 0,
        ]);

        return response()->json(['message'=>'Success','data'=>$user],200);
        // return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
    public function index()
    {
        $user = User::all();
        return response()->json(['message'=>'Success','data'=>$user],200);

    }
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
        return response()->json(['message'=>'User retrieved successfully.','data'=>$user],200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->delete()){
            return response()->json(['message'=>'User Deleted','data'=>null],200);
        }
        return response()->json(['message'=>'Error Occured','data'=>null],400);
    }
}
