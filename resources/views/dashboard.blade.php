<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
                    <p>Welcome, {{ Auth::user()->name }}! You are logged in.</p>

                    <!-- Add dashboard components -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Example cards -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow">
                            <h2 class="text-lg font-semibold">Articles</h2>
                            <p>View and manage your articles.</p>
                            <a href="{{ route('admin.articles.index') }}" class="text-blue-500 hover:underline">Manage Articles</a>
                        </div>

                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow">
                            <h2 class="text-lg font-semibold">Profile</h2>
                            <p>Update your profile information.</p>
                            <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">Edit Profile</a>
                        </div>

                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow">
                            <h2 class="text-lg font-semibold">Comments</h2>
                            <p>View user comments on your posts.</p>
                            <a href="{{ route('admin.comments.index') }}" class="text-blue-500 hover:underline">Manage Comments</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
