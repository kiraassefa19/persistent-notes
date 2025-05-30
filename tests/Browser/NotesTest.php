<?php

namespace Tests\Browser;

use App\Models\Note;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NotesTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_can_create_and_view_notes()
    {
        $this->browse(function (Browser $browser) {
            // Visit the notes page
            $browser->visit('/notes')
                   ->assertSee('Notes')
                   ->assertPresent('input[type="text"]')
                   ->assertPresent('button[type="submit"]');

            // Create a new note
            $browser->type('input[type="text"]', 'Test Note from Browser')
                   ->press('Add Note')
                   ->waitForText('Test Note from Browser')
                   ->assertSee('Test Note from Browser');

            // Verify the note was saved to the database
            $this->assertDatabaseHas('notes', [
                'content' => 'Test Note from Browser'
            ]);
        });
    }

    public function test_cannot_submit_empty_note()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/notes')
                   ->press('Add Note')
                   ->assertSee('The content field is required');
        });
    }
} 