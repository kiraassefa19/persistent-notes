<?php
namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::latest()->get();
        return Inertia::render('NotesPage', [
            'notes' => $notes,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ], [
            'content.required' => 'Please write something in your note.',
        ]);

        Note::create(['content' => $request->content]);
        return redirect('/notes');
    }
}