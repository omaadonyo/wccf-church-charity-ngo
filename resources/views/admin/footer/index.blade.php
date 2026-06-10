<x-layouts::app :title="__('Footer Settings')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Footer Settings</h1>
            <p class="text-sm text-zinc-500 mt-1">Edit the contact info, social links, and text shown in your website footer.</p>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.footer.update') }}" class="max-w-3xl space-y-8">
            @csrf

            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800 space-y-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Company Info</h2>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Description</label>
                    <textarea name="footer_description" rows="3" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">{{ $settings->get('footer_description')->value ?? 'A Christian Community Promoting Renewed, Healed and Prayerful Christians.' }}</textarea>
                </div>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800 space-y-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Contact Information</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Address</label>
                        <input type="text" name="footer_address" value="{{ $settings->get('footer_address')->value ?? 'Kampala, Uganda' }}" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Email</label>
                        <input type="email" name="footer_email" value="{{ $settings->get('footer_email')->value ?? 'info@wccfuganda.org' }}" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Phone</label>
                        <input type="text" name="footer_phone" value="{{ $settings->get('footer_phone')->value ?? '+256 (0) 700 000 000' }}" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800 space-y-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Social Media Links</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Facebook URL</label>
                        <input type="url" name="footer_facebook_url" value="{{ $settings->get('footer_facebook_url')->value ?? '' }}" placeholder="https://facebook.com/..." class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Twitter / X URL</label>
                        <input type="url" name="footer_twitter_url" value="{{ $settings->get('footer_twitter_url')->value ?? '' }}" placeholder="https://twitter.com/..." class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Instagram URL</label>
                        <input type="url" name="footer_instagram_url" value="{{ $settings->get('footer_instagram_url')->value ?? '' }}" placeholder="https://instagram.com/..." class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">YouTube URL</label>
                        <input type="url" name="footer_youtube_url" value="{{ $settings->get('footer_youtube_url')->value ?? '' }}" placeholder="https://youtube.com/..." class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800 space-y-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Bottom Bar</h2>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Copyright Text</label>
                    <input type="text" name="footer_copyright_text" value="{{ $settings->get('footer_copyright_text')->value ?? 'West Nile Christian Community Fellowship Ltd. All rights reserved.' }}" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Registration Text</label>
                    <input type="text" name="footer_registration_text" value="{{ $settings->get('footer_registration_text')->value ?? 'Registered with Uganda Registration Services Bureau (URSB) No. 80020002936115' }}" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">Save Footer Settings</button>
            </div>
        </form>
    </div>
</x-layouts::app>
