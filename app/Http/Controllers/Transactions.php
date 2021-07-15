<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transactions extends Controller
{
    
  public function transfer()
  {
    $balance = db::table('balance')
    ->where('user_id', Auth()->id())
    ->select(DB::raw("SUM(value) as value"))
    ->first();

    return view('transfer', compact('balance'));
  }

  public function transfersave(Request $request)
  {
    $balance = db::table('balance')
    ->where('user_id', Auth()->id())
    ->sum('value');

    $this->validate($request, [
      'value' => "required|min:0|max:$balance",
      'rekening' => "required",
      'receiver' => "required",
    ]);

    $post = new transfer();
    $post->id = $request->id;
    $post->value = $request->value;
    $post->user_id = Auth()->id();
    $post->rekening = $request->rekening;
    $post->receiver = $request->receiver;
    $post->created_at = carbon::now();
    $post->updated_at = carbon::now();

    DB::beginTransaction();
    try {
      $post->save();

      $bal = $balance-$post->value;

      DB::table('balance')->where('user_id',Auth()->id())->update(['value'=> $bal]);

      DB::commit();
      return redirect()->back()->with('success','Data has been added');
    }
    catch (\Exception $e) {
      $errorCode = $e->errorInfo[1];
      if($errorCode == '1048'){
        dd('Ups 1048 | Some fields are required');
      }
      if($errorCode == '1062'){
        dd('Ups 403 | Some fields are required');
      }

      if($errorCode == '1064'){
        dd('Ups 422 | Some fields are required');
      }
    }
  }
}
