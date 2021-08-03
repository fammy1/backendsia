<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Exception;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function show(Record $record) {
        return response()->json($record,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $records = Record::where('name','like',"%$request->key%")
            ->orWhere('age','like',"%$request->key%")->get();

        return response()->json($records, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'age' => 'string|required',
            'skills' => 'string|required',
            'address' => 'string|required',
            'designation' => 'string|required',
        ]);

        try {
            $record = Record::create($request->all());
            return response()->json($record, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Record $record) {
        try {
            $record->update($request->all());
            return response()->json($record, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Record $record) {
        $record->delete();
        return response()->json(['message'=>'record deleted.'],202);
    }

    public function index() {
        $records = Record::orderBy('name')->get();
        return response()->json($records, 200);
    }
}
