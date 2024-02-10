@foreach($comments as $comment)
<section class="bg-white dark:bg-gray-900 py-4 lg:py-16 antialiased">
    <!-- Wrapper untuk setiap komentar dengan border, shadow, dan margin untuk pemisahan -->
    <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 shadow-lg border border-gray-200 dark:border-gray-700 mb-1">
        <footer class="flex justify-between items-center mb-1">
            <div class="flex items-center">
                <!-- Menampilkan username pengguna -->
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">{{ $comment->user->username }}</p>
                <!-- Menampilkan tanggal pembuatan komentar -->
                <p class="text-sm text-gray-600 dark:text-gray-400"><time>{{ $comment->created_at->format('d M Y') }}</time></p>
            </div>
        </footer>
        <!-- Menampilkan isi komentar -->
        <p class="text-gray-500 dark:text-gray-400">{{ $comment->body }}</p>
    </article>
</section>
@endforeach



