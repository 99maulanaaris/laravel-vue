<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Subject;
use phpDocumentor\Reflection\Types\Resource_;

class NoteController extends Controller
{

    public function index()
    {
        $notes = Note::with('subject')->latest()->get();
        return NoteResource::collection($notes);
    }

    public function show(Note $note)
    {
        return NoteResource::make($note);
    }


    public function store ()
    {
        
        request()->validate([
            'subject' => 'required|numeric',
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        $subject = Subject::findOrFail(request('subject'));
       

        $note = Note::create([
            'subject_id' => $subject->id,
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'description' => request('description'),
            
        ]);


        return response()->json([
            'message' => 'Your note was created',
            'note' => $note,
        ]);
    }

    public function update(Note $note)
    {
        request()->validate([
        'subject' => 'required|numeric',
        'title' => 'required|min:3',
        'description' => 'required',
        ]);
        
        $subject = Subject::findOrFail(request('subject'));

        $note->update([
        'subject_id' => $subject->id,
        'title' => request('title'),
        'description' => request('description'),

        ]);

        return response()->json([
        'message' => 'Your note was updated',
        'note' => $note,
        ]);

    }

    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json([
        'message' => 'Your note was delete',
        
        ],200);
    }
}
