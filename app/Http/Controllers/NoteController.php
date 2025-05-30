<?php
namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function index()
    {
        try {
            // Test database connection
            DB::connection()->getPdo();
            
            $notes = Note::latest()->get();
            return Inertia::render('NotesPage', [
                'notes' => $notes,
            ]);
        } catch (\Exception $e) {
            Log::error('Database error in NoteController@index: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Database connection: ' . config('database.default'));
            Log::error('Database path: ' . config('database.connections.sqlite.database'));
            
            return Inertia::render('NotesPage', [
                'notes' => [],
                'error' => 'Unable to fetch notes. Please try again later.'
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        try {
            // Test database connection
            DB::connection()->getPdo();
            
            Note::create(['content' => $request->content]);
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Database error in NoteController@store: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Database connection: ' . config('database.default'));
            Log::error('Database path: ' . config('database.connections.sqlite.database'));
            
            return redirect()->back()->with('error', 'Unable to save note. Please try again later.');
        }
    }
}