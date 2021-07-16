<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Diary;
use Validator;
use App\Http\Resources\Diary as DiaryResource;

class DiaryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $diaries = Diary::all();
        return response()->json(['message'=>'Diary retrieved successfully.','data'=>$diaries],200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diary = Diary::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'body' => $request->body
        ]);
        return response()->json(['message'=>'Success','data'=>$diary],200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diary = Diary::find($id);
        if (is_null($diary)) {
            return $this->sendError('Diary not found.');
        }
        return response()->json(['message'=>'Diary retrieved successfully.','data'=>$diary],200);
    }
    public function show_all(Diary $diary)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $diary = Diary::find($id);
        $diary->user_id =  $request->get('user_id');
        $diary->title = $request->get('title');
        $diary->body = $request->get('body');
        $contact->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diary = Diary::find($id);
        if($diary->delete()){
            return response()->json(['message'=>'Diary Deleted','data'=>null],200);
        }
        return response()->json(['message'=>'Error Occurred','data'=>null],400);
    }
}
