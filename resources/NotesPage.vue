<template>
    <div class="min-h-screen bg-gray-100 p-6 flex flex-col items-center">
        <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                📝 Persistent Notes
            </h1>

            <form
                @submit.prevent="addNote"
                class="flex flex-col sm:flex-row items-stretch gap-3 mb-6"
            >
                <input
                    v-model="newNote"
                    placeholder="Type your note here..."
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md shadow-md transition"
                >
                    Add Note
                </button>
            </form>

            <div v-if="notes.length" class="space-y-3">
                <div
                    v-for="note in notes"
                    :key="note.id"
                    class="bg-blue-50 border border-blue-200 p-4 rounded-lg shadow-sm"
                >
                    <p class="text-gray-800">{{ note.content }}</p>
                    <p class="text-sm text-gray-400 mt-1">
                        Added: {{ formatDate(note.created_at) }}
                    </p>
                </div>
            </div>
            <p v-else class="text-gray-400 text-center">
                No notes yet. Start by adding one!
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/inertia";
import { format } from "date-fns";

const props = defineProps({
    notes: Array,
});

const newNote = ref("");

function addNote() {
    if (!newNote.value.trim()) return;
    router.post(
        "/notes",
        { content: newNote.value },
        {
            onSuccess: () => {
                newNote.value = "";
            },
        }
    );
}

function formatDate(date) {
    return format(new Date(date), "PPpp");
}
</script>
