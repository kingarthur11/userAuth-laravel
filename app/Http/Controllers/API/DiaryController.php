<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Diary;
use Validator;
use App\Http\Resources\Diary as DiaryResource;

class DiaryController extends BaseController
{
    public function index()
    {
        $diaries = Diary::all();
        return $this->sendResponse( $diaries, 'Diaries retrieved successfully.');

    }

    public function store(Request $request)
    {
        $diary = Diary::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'body' => $request->body
        ]);
        return $this->sendResponse( $diary, 'Diary created successfully');

    }

    public function show($id)
    {
        $diary = Diary::find($id);
        if (is_null($diary)) {
            return $this->sendError('Diary not found.');
        }
        return $this->sendResponse( $diary, 'Diary retrieved successfully');

    }

    public function update(Request $request, $id)
    {
        $diary = Diary::find($id);
        $diary->title = $request->get('title');
        $diary->body = $request->get('body');
        $diary->save();
        return $this->sendResponse( $diary, 'Diary updated successfully');

    }

    public function destroy($id)
    {
        $diary = Diary::find($id);
        $diary->delete();
        return $this->sendResponse( [], 'Diary Deleted');
    }
}
