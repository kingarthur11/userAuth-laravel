<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Diary;
use Validator;
use App\Http\Resources\Diary as DiaryResource;

class DiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $diaries = Diary::all();
        return $this->sendResponse(DiaryResource::collection($diaries), 'Diary retrieved successfully.');
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
    public function store(Request $request, User $user)
    {
        $validator = $this->validateDiary();
        if($validator->fails()){
            return response()->json(['message'=>$validator->messages(),'data'=>null],400);
        }

        $diary = new Diary($validator->validate());
        if($user->diaries()->save($diary)){
            return $this->sendResponse(new DiaryResource($diary), 'Diary created successfully.');
        }

        return response()->json(['message'=>'Error Occured','data'=>null],400);
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

        return $this->sendResponse(new DiaryResource($diary), 'Diary retrieved successfully.');
    }
    public function show_all(Diary $diary)
    {
        return $this->sendResponse(new DiaryResource($diary), 'Diary retrieved successfully.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($diary->delete()){
            return response()->json(['message'=>'Diary Deleted','data'=>null],200);
        }
        return response()->json(['message'=>'Error Occurred','data'=>null],400);
    }
}
