<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group feature
 */
class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @skip
     */
    public function skip_test_can_get_notes()
    {
        // Create some test notes
        Note::create(['content' => 'Test Note 1']);
        Note::create(['content' => 'Test Note 2']);

        // Make a GET request to the notes endpoint
        $response = $this->get('/notes');

        // Basic assertions first
        $response->assertOk();
        $response->assertViewIs('app');
    }

    public function test_can_create_note()
    {
        // Make a POST request to create a new note
        $response = $this->post('/notes', [
            'content' => 'New Test Note'
        ]);

        // Assert the response redirects back to the notes page
        $response->assertRedirect('/notes');

        // Assert the note was created in the database
        $this->assertDatabaseHas('notes', [
            'content' => 'New Test Note'
        ]);
    }

    public function test_cannot_create_empty_note()
    {
        // Make a POST request with empty content
        $response = $this->post('/notes', [
            'content' => ''
        ]);

        // Assert the response has validation errors with our custom message
        $response->assertSessionHasErrors('content', 'Please write something in your note.');

        // Assert no note was created in the database
        $this->assertDatabaseCount('notes', 0);
    }
} 