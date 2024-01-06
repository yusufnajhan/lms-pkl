@extends('siswa.layouts.layout')

@section('content')
<div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
    <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Guru dan Teman</h2>
    {{-- <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions and connect with the needs of your audience early and often.</p> --}}
</div> 
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select tab</label>
        <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option>Statistics</option>
            <option>Services</option>
            <option>FAQ</option>
        </select>
    </div>
    <ul class="hidden text-sm font-medium text-center text-red-500 divide-x divide-red-200 rounded-lg sm:flex dark:divide-red-600 dark:text-red-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
      <li class="w-full">
          <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Guru Mata Pelajaran</button>
      </li>
      <li class="w-full">
          <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Wali Kelas</button>
      </li>
      <li class="w-full">
          <button id="teman-tab" data-tabs-target="#teman" type="button" role="tab" aria-controls="teman" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Teman Kelas</button>
      </li>
    </ul>
    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <div class="hidden pt-4" id="faq" role="tabpanel" aria-labelledby="faq-tab">
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6"> 
                    <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Bonnie Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="#">Nama guru</a>
                            </h3>
                            <p>Guru Matematika</p>
                        </div>
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png" alt="Helene Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="#">Nama guru</a>
                            </h3>
                            <p>Guru Bahasa Indonesia</p>
                        </div>
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="#">Nama guru</a>
                            </h3>
                            <p>Guru Inggris</p>
                        </div>
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png" alt="Joseph Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="#">Nama guru</a>
                            </h3>
                            <p>Guru IPS</p>
                        </div>
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/sofia-mcguire.png" alt="Sofia Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="#">Nama guru</a>
                            </h3>
                            <p>Guru IPA</p>
                        </div>
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/thomas-lean.png" alt="Leslie Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="#">Nama guru</a>
                            </h3>
                            <p>Guru PJOK</p>
                        </div>
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png" alt="Michael Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="#">Nama guru</a>
                            </h3>
                            <p>Guru Matematika</p>
                        </div>
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/neil-sims.png" alt="Neil Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="#">Nama guru</a>
                            </h3>
                            <p>Guru Matematika</p>
                        </div>
                    </div>  
                </div>
            </section>
        </div>
        <div class="hidden pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6"> 
                    <div class="text-center text-gray-500 dark:text-gray-400">
                        <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Bonnie Avatar">
                        <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Nama guru</a>
                        </h3>
                        <p>Wali Kelas</p>
                    </div>
                </div>
            </section>            
        </div>
        <div class="hidden pt-4" id="teman" role="tabpanel" aria-labelledby="teman-tab">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <li class="py-3 sm:py-4">
                  <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                      <img class="w-8 h-8 rounded-full" src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png" alt="Neil image">
                    </div>
                    <div class="flex-1 min-w-0">
                      <p class="font-medium text-gray-900 truncate dark:text-white">
                        Nama teman
                      </p>
                    </div>
                  </div>
                </li>
                <li class="py-3 sm:py-4">
                  <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                      <img class="w-8 h-8 rounded-full" src="https://flowbite-admin-dashboard.vercel.app/images/users/bonnie-green.png" alt="Neil image">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate dark:text-white">
                        Nama teman
                        </p>
                    </div>
                  </div>
                </li>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                      <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png" alt="Neil image">
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate dark:text-white">
                          Nama teman
                        </p>
                      </div>
                    </div>
                </li>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                      <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png" alt="Neil image">
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate dark:text-white">
                          Nama teman
                        </p>
                      </div>
                    </div>
                </li>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                      <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png" alt="Neil image">
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate dark:text-white">
                          Nama teman
                        </p>
                      </div>
                    </div>
                </li>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                      <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png" alt="Neil image">
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate dark:text-white">
                          Nama teman
                        </p>
                      </div>
                    </div>
                </li>
                <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                      <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png" alt="Neil image">
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate dark:text-white">
                          Nama teman
                        </p>
                      </div>
                    </div>
                </li>
            </ul>            
        </div>
    </div>
  </div>
</div>
@endsection