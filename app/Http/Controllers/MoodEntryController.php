<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoodEntryRequest;
use App\Models\MoodEntry;
use Illuminate\Http\Request;

class MoodEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $moodEntries = MoodEntry::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $moodEntries,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MoodEntryRequest $moodEntryRequest)
    {
        if($moodEntryRequest->save()){

           return response()->json([
           "status" => "success",
           "message" => "Mood created successfully"
         ]);
        }
        return response()->json([
        "status" => "fail",
        "message" => "Mood not saved successfully"
      ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MoodEntry $moodEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MoodEntry $moodEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MoodEntryRequest $moodEntryRequest)
    {
       if($moodEntryRequest->save()){

           return response()->json([
           "status" => "success",
           "message" => "Mood update successfully"
         ]);
        }
        return response()->json([
        "status" => "fail",
        "message" => "Mood not updated successfully"
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MoodEntry $moodEntry)
    {
        if($moodEntry->delete()){

           return response()->json([
           "status" => "success",
           "message" => "Mood deleted successfully"
         ]);
        }
        return response()->json([
        "status" => "fail",
        "message" => "Mood not deleted successfully"
      ]);
    }
}
