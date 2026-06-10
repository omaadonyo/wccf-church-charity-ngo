<x-layouts::app :title="__('Form Submissions')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Form Submissions</h1>
                <p class="text-sm text-zinc-500 mt-1">Volunteer, membership, and inquiry form responses.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-800 border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Name</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Email</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Phone</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Type</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Date</th>
                        <th class="text-end px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($submissions as $sub)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                            <td class="px-4 py-3 font-medium text-zinc-900 dark:text-white">{{ $sub->name }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">
                                <a href="mailto:{{ $sub->email }}" class="hover:text-primary">{{ $sub->email }}</a>
                            </td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $sub->phone ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                    @if($sub->type === 'volunteer') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                                    @elseif($sub->type === 'membership') bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400
                                    @else bg-zinc-100 text-zinc-700 dark:bg-zinc-900/30 dark:text-zinc-400 @endif">
                                    {{ ucfirst($sub->type) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400 text-xs">{{ $sub->created_at->format('M j, Y g:i A') }}</td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="viewSubmission('{{ $sub->name }}', {{ json_encode($sub->form_data ?? $sub->only(['name','email','phone','type','church','message'])) }})" class="px-3 py-1.5 rounded-md text-xs font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                                        View
                                    </button>
                                    <form method="POST" action="{{ route('admin.submissions.destroy', $sub) }}" onsubmit="return confirm('Delete this submission?')">
                                        @csrf @method('DELETE')
                                        <button class="px-3 py-1.5 rounded-md text-xs font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-zinc-500 dark:text-zinc-400">No submissions yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>{{ $submissions->links() }}</div>
    </div>

    {{-- View detail modal --}}
    <flux:modal name="submission-detail-modal" class="!p-0 max-w-lg w-full overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b border-neutral-200 dark:border-neutral-700">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white" id="submission-modal-title">Submission</h3>
            <flux:modal.close>
                <button class="p-1.5 rounded-lg text-zinc-500 hover:text-zinc-700 hover:bg-zinc-100 dark:hover:text-zinc-300 dark:hover:bg-zinc-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </flux:modal.close>
        </div>
        <div class="p-4 space-y-3 text-sm" id="submission-modal-body"></div>
    </flux:modal>
</x-layouts::app>
<script>
function viewSubmission(name, data) {
    document.getElementById('submission-modal-title').textContent = 'Submission: ' + name;
    const body = document.getElementById('submission-modal-body');
    const fields = { name: 'Name', email: 'Email', phone: 'Phone', type: 'Type', church: 'Home Church', message: 'Message' };
    let html = '';
    for (const [key, label] of Object.entries(fields)) {
        if (data[key]) {
            html += `<div><span class="text-xs font-medium text-zinc-400 uppercase">${label}</span><p class="text-zinc-900 dark:text-white mt-0.5">${esc(data[key])}</p></div>`;
        }
    }
    body.innerHTML = html || '<p class="text-zinc-500">No details available.</p>';
    document.dispatchEvent(new CustomEvent('modal-show', { detail: { name: 'submission-detail-modal' } }));
}
function esc(str) { if (!str) return ''; return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }
</script>
