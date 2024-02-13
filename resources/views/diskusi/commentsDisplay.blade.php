@foreach($comments as $comment)
<section class="bg-white dark:bg-gray-900 py-1 lg:py-16 antialiased">
    <!-- Wrapper untuk setiap komentar dengan border, shadow, dan margin untuk pemisahan -->
    <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 shadow-lg border border-gray-200 dark:border-gray-700 mb-1 relative">
        @if ($comment->iduser == auth()->user()->id)
            <div class="absolute top-2 right-2 text-sm">
                <button type="button" data-modal-toggle="edit-comment-modal-{{ $comment->idcomment }}" 
                    class="text-blue-500 hover:text-blue-700">Edit</button>
                <button type="button" data-modal-toggle="delete-comment-modal-{{ $comment->idcomment }}" 
                    class="ml-2 text-red-500 hover:text-red-700">Hapus</button>
            </div>
        @endif
        
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

@foreach($comments as $comment)
<div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full" id="delete-comment-modal-{{ $comment->idcomment }}">
  <div class="relative w-full h-full max-w-md px-4 md:h-auto">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
          <!-- Modal body -->
          <div class="p-6 pt-0 text-center">
              <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus comment ini?</h3>
              <form method="POST" action="{{ route('comments.destroy', $comment->idcomment) }}"  
                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                @csrf
                <button type="submit">
                Ya, saya yakin
                </button>
              </form>
              <button type="button" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700" data-modal-hide="delete-comment-modal-{{ $comment->idcomment }}">
                  Tidak hapus
              </button>
          </div>
      </div>
  </div>
</div>
@endforeach

@foreach($comments as $comment)
<div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full" id="edit-comment-modal-{{ $comment->idcomment }}">
  <div class="relative w-full h-full max-w-md px-4 md:h-auto">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
          <!-- Modal body -->
          <div class="p-6 pt-0 text-center">
              <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              <form method="POST" action="{{ route('comments.update', $comment->idcomment) }}" >
                @csrf
                <div> 
                <textarea id="body" name="body" rows="6"
                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                    required>{{ $comment->body }}</textarea>
                </div>
                <div class="flex justify-between mt-4">
                    <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Edit
                    </button>
                    <button type="button" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700" 
                    data-modal-hide="edit-comment-modal-{{ $comment->idcomment }}">
                        Batal
                    </button>
                </div>
              </form>
              
          </div>
      </div>
  </div>
</div>
@endforeach



