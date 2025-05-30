<?php
namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function index()
    {
        try {
            Log::info('Attempting to fetch notes');
            $notes = Note::latest()->get();
            Log::info('Notes fetched successfully', ['count' => $notes->count()]);
            
            return Inertia::render('NotesPage', [
                'notes' => $notes,
                'error' => null
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching notes: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            
            return Inertia::render('NotesPage', [
                'notes' => [],
                'error' => 'Failed to load notes. Please try again.'
            ]);
        }
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