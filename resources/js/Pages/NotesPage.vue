<template>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">My Notes</h1>
                <p class="mt-2 text-gray-600">Keep your thoughts organized</p>
            </div>

            <!-- Error Message -->
            <div v-if="error" class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-4 w-4 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ error }}</p>
                    </div>
                </div>
            </div>

            <!-- Add Note Form -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">New Note</label>
                        <textarea
                            id="content"
                            v-model="form.content"
                            rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="What's on your mind?"
                            :disabled="form.processing"
                        ></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50"
                            :disabled="form.processing"
                        >
                            <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ form.processing ? 'Adding...' : 'Add Note' }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Notes List -->
            <div v-if="notes && notes.length > 0" class="space-y-4">
                <div v-for="note in notes" :key="note.id" class="bg-white shadow rounded-lg p-6">
                    <p class="text-gray-800 whitespace-pre-wrap">{{ note.content }}</p>
                    <p class="text-sm text-gray-500 mt-4">{{ new Date(note.created_at).toLocaleString() }}</p>
                </div>
            </div>
            <div v-else class="text-center py-12 bg-white shadow rounded-lg">
                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No notes yet</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by adding your first note above!</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    notes: {
        type: Array,
        default: () => []
    },
    error: String
})

const form = useForm({
    content: ''
})

const submit = () => {
    form.post('/notes', {
        preserveScroll: true,
        onSuccess: () => {
            form.content = ''
        }
    })
}
</script>

<style>
.animate-spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style> 