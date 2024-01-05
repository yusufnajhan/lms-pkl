@extends('guru.layouts.layout')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-4 text-5xl font-extrabold tracking-tight leading-none md:text-6xl xl:text-7xl dark:text-white">Selamat Datang di LMS SMP Semarang</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">"Membuka Jendela Dunia, Mewujudkan Pendidikan Tanpa Batas dengan E-Learning"</p>    
            <a href="/murid" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                Murid Didik
            </a>         
            <a href="/kelasGuru" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Kelas
            </a> 
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="https://images.pexels.com/photos/357271/pexels-photo-357271.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="gedung_smp">
        </div>           
    </div>
</section>
@endsection

@section('content1')
<!-- 
Install the "flowbite-typography" NPM package to apply styles and format the article content: 

URL: https://flowbite.com/docs/components/typography/ 
-->
<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
    <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
        <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
            <header class="mb-4 lg:mb-6 not-format">
                <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">Panduan Menggunakan LMS SMP Semarang</h1>
            </header>
            <p class="lead">Learning Management System (LMS) adalah perangkat lunak yang dirancang untuk membuat, mendistribusikan, dan mengatur penyampaian konten pembelajaran. LMS biasanya digunakan untuk penyusunan materi pembelajaran, pengelolaan proses pembelajaran, dan menilai hasil kerja
            </p>
            <iframe class="w-full" width="420" height="315" src="https://www.youtube.com/embed/tgbNymZ7vqY"> </iframe>
            <p>Berikut adalah beberapa langkah yang dapat Anda ikuti untuk menggunakan Google Classroom:</p>
            <ol>
                <li><strong>Usability testing</strong>. Does your user know how to exit out of screens? Can they
                    follow your intended user journey and buy something from the site you’ve designed? By running a
                    usability test, you’ll be able to see how users will interact with your design once it’s live;
                </li>
                <li><strong>Involving stakeholders</strong>. Need to check if your GDPR consent boxes are displaying
                    properly? Pass your prototype to your data protection team and they can test it for real;</li>
                <li><strong>Impressing a client</strong>. Prototypes can help explain or even sell your idea by
                    providing your client with a hands-on experience;</li>
                <li><strong>Communicating your vision</strong>. By using an interactive medium to preview and test
                    design elements, designers and developers can understand each other — and the project — better.
                </li>
            </ol>
        </article>
    </div>
</main>
@endsection