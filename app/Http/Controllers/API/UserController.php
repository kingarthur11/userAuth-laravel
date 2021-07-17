<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;
use Validator;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::with('wallets', 'diaries')->get();
        return $this->sendResponse( $users, 'Users retrieved successfully.');
    }
    public function show($id)
    {
        $user = User::where('id', $id)->with('wallets', 'diaries')->get();
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
        return $this->sendResponse( $user, 'User retrieved successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->delete()){
            return $this->sendResponse([], 'User deleted');

        }
        return $this->sendError('User deleted',400);
    }
}
