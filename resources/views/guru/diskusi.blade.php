@extends('guru.layouts.layout')

@section('content')
<div class="mb-4">
    <nav class="flex mb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
          <li class="inline-flex items-center">
            <a href="/kelasGuru"
                class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>                                      
                <span class="ml-3" sidebar-toggle-item="">Kelas</span>
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <a href="/kelasMat" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Kelas Matematika 7A</a>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Detail Diskusi</span>
            </div>
          </li>
        </ol>
    </nav>
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Topik diskusi</h1>
</div>
<ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
     <!-- Chat -->
     <form class="overflow-y-auto lg:max-h-[60rem] 2xl:max-h-fit">
        <article class="mb-5">
          <footer class="flex items-center justify-between mb-2">
              <div class="flex items-center">
                  <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white"><img class="w-6 h-6 mr-2 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"alt="Jese avatar">Jese Leos</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022"> 01/03/2023</time></p>
              </div>
          </footer>
          <p class="mb-2 text-gray-900 dark:text-white">
            Ok <a href="#" class="font-medium hover:underline text-primary-600 dark:text-primary-500">@team</a> I'am attaching our offer and pitch deck. Take your time to review everything. I'am looking forward to the next steps! Thank you.
          </p>
          <p class="mb-3 text-gray-900 dark:text-white">Looking forward to it! Thanks.</p>
        </article>
        <article class="pl-12 mb-5">
          <footer class="flex items-center justify-between mb-2">
              <div class="flex items-center">
                  <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white"><img class="w-6 h-6 mr-2 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"alt="Joseph avatar">Joseph McFallen</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022"> 01/03/2023</time></p>
              </div>
          </footer>
          <p class="mb-2 text-gray-900 dark:text-white">
            Hello <a href="#" class="font-medium hover:underline text-primary-600 dark:text-primary-500">@jeseleos</a> I need some informations about flowbite react version.
          </p>
        </article>
        <article class="pl-12 mb-5">
          <footer class="flex items-center justify-between mb-2">
              <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white"><img class="w-6 h-6 mr-2 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"alt="Jese avatar">Jese Leos</p>
                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022"> 01/03/2023</time></p>
              </div>
          </footer>
          <p class="mb-4 text-gray-900 dark:text-white">
            Hi <a href="#" class="font-medium hover:underline text-primary-600 dark:text-primary-500">@josephh</a> Sure, just let me know whean you are available and we can speak.
          </p>
          <form>
            <label for="chat" class="sr-only">Your message</label>
            <div class="flex items-center mb-5">
                <textarea id="chat" rows="1" class="block mr-4 p-2.5 w-full text-sm text-red-900 bg-red-50 rounded-lg border border-red-300 focus:ring-red-500 focus:border-red-500 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Membalas diskusi kelas..."></textarea>
                <button type="submit" class="inline-flex justify-center p-2 rounded-lg cursor-pointer text-red-600 hover:bg-red-100 dark:text-red-500 dark:hover:bg-red-600">
                    <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
          </form>                  
          <span class="inline-flex items-center text-xs font-medium cursor-pointer hover:underline text-red-700 sm:text-sm dark:text-red-500">
            Hide thread
            <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"></path>
            </svg>
          </span>                  
        </article>
    </form>
</ul>
@endsection