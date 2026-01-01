 @include('include/header')
 <!-- <script src="https://cdn.tailwindcss.com"></script> -->
 @php
 $api_key = env('TMDB_API_KEY');
 $genres = [];

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/genre/movie/list?api_key={$api_key}&language=en-IN");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // true in production
 curl_setopt($ch, CURLOPT_HTTPHEADER, ['User-Agent: Mozilla/5.0']);
 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
 curl_setopt($ch, CURLOPT_TIMEOUT, 30);
 $response = curl_exec($ch);

 if (curl_errno($ch)) {
 } else {
 $result = json_decode($response, true);
 $genres = $result['genres'] ?? [];
 }

 curl_close($ch);
 @endphp

 <!-- @php

 $sectionPartials = [
 'movies_in_theatre' => 'homepage.sections.south',

 'movies_on_ott' => 'homepage.sections.movies_listott',
 'movies_coming_soon' => 'homepage.sections.upcomingSouth',
 'trending_videos' => 'homepage.sections.trending_videos',
 'box_office_hits' => 'homepage.sections.box_office_hits',
 'top_3_this_weeks' => 'homepage.sections.top_3_this_weeks',
 'newest_release' => 'homepage.sections.newest_release',
 'top_artist' => 'homepage.sections.top_artist',
 'top_news' => 'homepage.sections.top_news',
 ];

 $orderedSections = getOrderedSections();
 @endphp  -->


 <style>
     .swiper-navigation-icon {
         display: none;
     }

     .category-two {
         margin-block: 50px;
     }

     .text-gradient {
         @apply bg-gradient-to-r from-red-500 via-yellow-500 to-purple-500 bg-clip-text text-transparent;
     }

     .scrollbar-hide::-webkit-scrollbar {
         display: none !important;
     }

     .no-scroll {
         overflow: hidden;
         height: 100vh;
     }

     .scrollbar-hide {
         -ms-overflow-style: none;

         scrollbar-width: none;

     }

     iframe::-webkit-media-controls-panel {
         display: none !important;
         -webkit-appearance: none;
     }

     .ytp-title-link {
         display: none;
     }

     .ytp-title-text {
         display: none;
     }

     .ytp-title-channel {
         display: none;
     }
 </style>


 <style>
     .movie-card {
         transition: transform 0.4s ease;
         position: relative;
     }

     .movie-card:hover {
         transform: scale(1.07);
         z-index: 20;
     }

     .movie-overlay,
     .movie-details,
     .movie-options {
         opacity: 0;
         transition: opacity 0.4s ease;
     }

     .movie-card:hover .movie-overlay,
     .movie-card:hover .movie-details,
     .movie-card:hover .movie-options {
         opacity: 1;
     }

     /* .swiper-button-prev::after,
     .swiper-button-next::after {
         font-size: 18px;

         font-weight: 700;
         color: white;
         line-height: 1;
         display: flex;
         align-items: center;
         justify-content: center;
         
     }

     .swiper-button-prev::after {
         content: '';
         display: inline-block;
         width: 20px;
         height: 20px;
         background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 19l-7-7 7-7'/%3E%3C/svg%3E");
         background-size: cover;
     }

     .swiper-button-next::after {
         content: '';
         display: inline-block;
         width: 20px;
         height: 20px;
         background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5l7 7-7 7'/%3E%3C/svg%3E");
         background-size: cover;
     } */


     .swiper-pagination-bullet {
         width: 8px;
         height: 8px;
         background: white;
         opacity: 0.8;
         margin: 0 12px !important;
         border-radius: 9999px;
         cursor: pointer;
         transition: all 0.3s ease;
     }

     .swiper-pagination-bullet-active {
         background: #FE9A00;
         transform: scale(1.2);
     }
 </style>


 <div class=" bg-white dark:bg-black !text-white !text-gray-900  ">
     <!-- banner -->
     <div class="flex flex-col lg:flex-row w-full h-[250px] lg:h-[350px] {{ get_mode() === 'boxed' ? ' md:px-10 lg:px-16 max-w-7xl mx-auto' : '' }}">
         <!-- Left side banner-->
         <div class="     w-full lg:w-2/3 h-full relative border-b lg:border-b-0 lg:border-r border-white">
             <div class="swiper swiper-banner-section h-full relative">

                 <div class="swiper-wrapper">
                     @php
                     $movies = getLatestBollywoodMovies(3);
                     @endphp
                     @if(!empty($movies) && isset($movies[0]['id']))
                     <a href="{{ url('movie-details/' . $movies[0]['id']) }}">
                         <div class="swiper-slide relative">
                             <img src="https://image.tmdb.org/t/p/original{{ $movies[0]['backdrop_path'] ?? $movie['poster_path'] }}" class="!w-full !h-full !object-cover" />

                             <div class="absolute inset-0 text-white p-6 flex flex-col justify-end !cursor-pointer !mb-1">
                                 <div class="bg-black/50 border-l-2 border-[#FE9A00] p-3 shadow-2xl">
                                     <div class="flex items-center !mb-1">
                                         <h2 class="text-2xl !font-bold !text-white !uppercase tracking-[2px]">
                                             {{ $movies[0]['title'] ?? 'Untitled' }}
                                         </h2>
                                     </div>

                                     <p class="text-[15px] italic text-white mb-3 leading-tight max-w-[90%]">
                                         {{ Str::limit($movies[0]['overview'], 150) }}
                                     </p>

                                     <div class="flex items-center text-xs text-gray-300 mb-4">
                                         <i class="fa-solid fa-star text-[#FE9A00] mr-1.5"></i>
                                         <span class="!text-white !font-semibold text-[14px]">{{ number_format($movies[0]['vote_average'], 1) }}</span>
                                         <span class="!text-white !font-semibold text-[14px] tracking-[1px]">/10 (Masala Meter)</span>
                                     </div>

                                     <div class="flex space-x-3">
                                         <a href="javascript:void(0)" data-id="{{ $movies[0]['id'] }}">
                                             <button class="bg-[#FE9A00] hover:bg-[#e68a00] text-black text-xs sm:text-sm font-bold p-2 px-4 rounded-full flex items-center transition-all transform hover:scale-105 !cursor-pointer">
                                                 <i class="fas fa-play mr-2"></i>
                                                 WATCH TRAILER
                                             </button>
                                         </a>
                                         <button class="bg-white hover:bg-gray-100 text-black text-xs sm:text-sm font-bold p-2 px-4 rounded-full flex items-center transition-all transform hover:scale-105 !cursor-pointer">
                                             <i class="fas fa-plus mr-2"></i>
                                             PLAYLIST
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </a>
                     @endif
                 </div>

                 <div class="swiper-pagination-banner-section 
                    !bottom-1 
                    !bg-black/40 
                    px-2 py-1 
                    rounded-xl 
                    flex items-center justify-center 
                    !w-fit 
                    !left-1/2 
                    !-translate-x-1/2 
                    absolute z-10">
                 </div>
                 <div class="swiper-button-prev-banner bg-white !text-gray-600 !font-bold  w-10 h-10 rounded-full !shadow-md !hover:bg-gray-100"
                     style="--swiper-navigation-size: 16px;"></div>

                 <div class="swiper-button-next-banner bg-white !text-gray-600 !font-bold w-10 h-10 rounded-full !shadow-md !hover:bg-gray-100"
                     style="--swiper-navigation-size: 16px;"></div>
             </div>
         </div>

         <!-- right side banner -->
         <div class="  w-full   hidden lg:grid lg:w-1/3 grid-rows-2 h-full ">
             @php
             $movies = getLatestBollywoodMovies(3);
             @endphp
             <div class="relative">
                 @if(!empty($movies) && isset($movies[1]['id']))
                 <a href="{{ url('movie-details/' . $movies[1]['id']) }}">

                     <img src="https://image.tmdb.org/t/p/original{{ $movies[1]['backdrop_path'] ?? $movies[1]['poster_path'] }}" alt="Airplane" class="!w-full !h-full !object-cover">
                     <div class="absolute inset-0  text-white p-6 flex flex-col justify-end !cursor-pointer">
                         <div class="bg-black/50 border-l-2 border-[#FE9A00] p-3  shadow-2xl">
                             <div class="flex items-center mb-2">
                                 <h2 class="text-xl !font-bold !text-white !uppercase tracking-[2px]">
                                     {{ $movies[1]['title'] ?? 'Untitled' }}
                                 </h2>
                             </div>
                             <p class="text-xs italic text-white leading-tight ">
                                 {{ Str::limit($movies[1]['overview'], 150) }}
                             </p>
                         </div>
                     </div>

                 </a>
                 @endif
             </div>
             @php
             $movies = getLatestBollywoodMovies(3);
             @endphp
             <div class="relative">
                 @if(!empty($movies) && isset($movies[1]['id']))
                 <a href="{{ url('movie-details/' . $movies[1]['id']) }}">
                     <img src="https://image.tmdb.org/t/p/original{{ $movies[2]['backdrop_path'] ?? $movies[1]['poster_path'] }}" alt="Ironheart" class="!w-full !h-full !object-cover">
                     <div class="absolute inset-0  text-white p-6 flex flex-col justify-end !cursor-pointer">
                         <div class="bg-black/50 border-l-2 border-[#FE9A00] p-3  shadow-2xl">
                             <div class="flex items-center mb-2">
                                 <h2 class="text-xl !font-bold !text-white !uppercase tracking-[2px]">
                                     {{ $movies[1]['title'] ?? 'Untitled' }}
                                 </h2>
                             </div>
                             <p class="text-xs italic text-white leading-tight ">
                                 {{ Str::limit($movies[1]['overview'], 150) }}
                             </p>
                         </div>
                     </div>
                 </a>
                 @endif
             </div>
         </div>
     </div>
 </div>


 <h1 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100 text-center pt-12 tracking-[1px] ">
     One Platform for All Indian Movies
 </h1>
 <!-- here is tabs which shows the movie based on region -->
 <!-- <div class="flex gap-4 mb-6 flex-wrap justify-center">
     <button type="button" data-tab-btn="hindi" onclick="openTab('hindi')"
         class="px-6 py-2 rounded-full font-medium bg-[#fe9a00] text-white shadow-md hover:shadow-lg hover:bg-[#e58900] transition">
         Hindi
     </button>

     <button type="button" data-tab-btn="south" onclick="openTab('south')"
         class="px-6 py-2 rounded-full font-medium bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow-sm hover:shadow-md hover:bg-gray-300 dark:hover:bg-gray-700 transition">
         South
     </button>

     <button type="button" data-tab-btn="regional" onclick="openTab('regional')"
         class="px-6 py-2 rounded-full font-medium bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow-sm hover:shadow-md hover:bg-gray-300 dark:hover:bg-gray-700 transition">
         Regional
     </button>
 </div> -->



 <div class="flex gap-4 mb-6 flex-wrap justify-center">
     <button type="button" data-tab-btn="hindi" onclick="openTab('hindi')"
         class="px-6 py-2 rounded-full font-medium bg-[#fe9a00] text-white shadow-md hover:shadow-lg  transition">
         Hindi
     </button>

     <button type="button" data-tab-btn="south" onclick="openTab('south')"
         class="px-6 py-2 rounded-full font-medium bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow-sm hover:shadow-md   transition">
         South
     </button>

     <button type="button" data-tab-btn="punjabi" onclick="openTab('punjabi')"
         class="px-6 py-2 rounded-full font-medium bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow-sm hover:shadow-md  transition">

         Others
     </button>
 </div>


 {{-- Hindi tab (show one section only) --}}
 <div id="hindi" class="tab-section">

     @include('homepage.sections.movies_in_theatre')
     <!-- webseeries  -->
     <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
         <div class="flex justify-between items-center mb-4">
             <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                 Top Web Series You Can’t Miss

                 <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                     <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                 </svg>
             </h3>

             <a href="{{ route('movie_list', ['key' => 'list']) }}"
                 class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                 View All
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                 </svg>
             </a>
         </div>

         <div class="swiper trendingwebseries">
             <div class="swiper-wrapper " id="trendingwebseries">



             </div>


             <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
             <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


         </div>


     </section>

     <!-- coming series -->
     <!-- <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
         <div class="flex justify-between items-center mb-4">
             <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                 Coming Up Next
                 <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                     <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                 </svg>
             </h3>

             <a href="{{ route('movie_list', ['key' => 'list']) }}"
                 class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                 View All
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                 </svg>
             </a>
         </div>

         <div class="swiper upcomingwebseries">
             <div class="swiper-wrapper " id="upcomingwebseries">




             </div>


             <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
             <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


         </div>


     </section> -->
@include('homepage.sections.upcomingwebseries')
   
     @include('homepage.sections.movies_listott')
     @include('homepage.sections.movies_coming_soon')
     @include('homepage.sections.trending_videos')
     @include('homepage.sections.box_office_hits')
     @include('homepage.sections.top_3_this_weeks')
     @include('homepage.sections.newest_release')
     @include('homepage.sections.top_artist')





 </div>

 {{-- South tab (show one section only) --}}
 <div id="south" class="tab-section hidden">

     <!-- in theatre south movie -->
     <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
         <div class="flex justify-between items-center mb-4">
             <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                 South Movies In Theatres
                 <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                     <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                 </svg>
             </h3>

             <a href="{{ route('movie_list', ['key' => 'list']) }}"
                 class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
              text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
                hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                 View All
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                 </svg>
             </a>
         </div>

         <div class="swiper theatresauthmovie">
             <div class="swiper-wrapper" id="theatresauthmovie">
             </div>

             <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
             <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
         </div>



     </section>


     <!-- trend south web series -->
     <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
         <div class="flex justify-between items-center mb-4">
             <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                 Top Web Series You Can’t Miss

                 <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                     <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                 </svg>
             </h3>

             <a href="{{ route('movie_list', ['key' => 'list']) }}"
                 class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                 View All
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                 </svg>
             </a>
         </div>

         <div class="swiper trendingsouthwebseries">
             <div class="swiper-wrapper " id="trendingsouthwebseries">



             </div>


             <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
             <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


         </div>


     </section>

     <!-- coming series -->
     <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
         <div class="flex justify-between items-center mb-4">
             <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                 Coming Up Next
                 <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                     <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                 </svg>
             </h3>

             <a href="{{ route('movie_list', ['key' => 'list']) }}"
                 class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                 View All
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                 </svg>
             </a>
         </div>

         <div class="swiper upcomingsouthwebseries">
             <div class="swiper-wrapper " id="upcomingsouthwebseries">




             </div>


             <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
             <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


         </div>


     </section>

     <!-- watch at home -->
     <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
         <div class="flex justify-between items-center mb-4">
             <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                 Watch at Home
                 <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                     <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                 </svg>
             </h3>

             <a href="{{ route('movie_list', ['key' => 'list']) }}"
                 class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                 View All
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                 </svg>
             </a>
         </div>

         <div class="swiper watchathomeottsouth">
             <div class="swiper-wrapper " id="watchathomeottsouth">




             </div>


             <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
             <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


         </div>


     </section>




     <!-- upcoming south movies -->
     <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
         <div class="flex justify-between items-center mb-4">
             <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                 Upcoming South Movies

                 <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                     <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                 </svg>
             </h3>

             <a href="{{ route('movie_list', ['key' => 'list']) }}"
                 class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                 View All
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                 </svg>
             </a>
         </div>

         <div class="swiper upcomingsouthmoviesswiper">
             <div class="swiper-wrapper " id="upcomingsouthmovies">


                 <!-- static slide -->
                 <!-- <div class="swiper-slide !w-[187px]">
                     <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                         <div class="relative">
                             <div class="relative group">
                                 <div class="relative !h-[280px] overflow-hidden !rounded-md">

                                     <img src="https://assets-in.bmscdn.com/iedb/movies/images/mobile/thumbnail/xlarge/kantara-a-legend-chapter-1-et00377351-1701090949.jpg"
                                         alt="Kantara: A Legend Chapter-1"
                                         class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">

                                 </div>
                                 <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn">
                                     <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                         <i class="fa-solid fa-play text-white text-2xl"></i>
                                     </div>
                                 </a>
                             </div>

                         </div>
                         <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
                             <div class="flex justify-between">
                                 <a href="#">
                                     <p class="text-[16px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">
                                         Kantara: A Legend Chapter-1
                                     </p>
                                 </a>

                             </div>
                         </div>
                     </div>
                 </div>-->


             </div>

             <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
             <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


         </div>


     </section>

     @include('homepage.sections.trending_videos')
     @include('homepage.sections.south_box_office_hits')
     @include('homepage.sections.top_3_south_weeks')



     <!-- newest relases -->
     <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
         <div class="flex justify-between items-center mb-4">
             <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                 Newest releases
                 <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                     <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                 </svg>
             </h3>

             <a href="{{ route('movie_list', ['key' => 'list']) }}"
                 class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                 View All
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                 </svg>
             </a>
         </div>

         <div class="swiper newestsouthrelases">
             <div class="swiper-wrapper " id="newestsouthrelases">




             </div>


             <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
             <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


         </div>


     </section>

     @include('homepage.sections.top_artist')


 </div>

 {{-- Region tab (show one section only) --}}
 <div id="punjabi" class="tab-section hidden">


     <div class="flex-wrap justify-center  relative dark:bg-gray-900 bg-gray-100 p-4 w-fit mx-auto rounded-full">

         <!-- Top triangle (yellow) -->
         <div class="absolute top-[-5px] right-[50px] w-0 h-0 
                border-l-[12px] border-l-transparent 
                border-r-[12px] border-r-transparent 
                border-b-[12px] border-b-gray-100 dark:border-b-gray-800
                transform translate-x-1/2 -translate-y-1/2 z-10">
         </div>


         <button type="button" data-subtab-btn="marathi" onclick="openSubTab('marathi')"
             class="px-6 py-2 rounded-full text-sm font-medium tracking-[1px] bg-red-600 text-white shadow-md hover:shadow-lg transition">
             Marathi
         </button>

         <button type="button" data-subtab-btn="gujarati" onclick="openSubTab('gujarati')"
             class="px-6 py-2 rounded-full text-sm font-medium tracking-[1px] bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow-sm hover:shadow-md hover:bg-gray-300 dark:hover:bg-gray-700 transition">
             Gujarati
         </button>

         <button type="button" data-subtab-btn="punjabi" onclick="openSubTab('punjabi')"
             class="px-6 py-2 rounded-full text-sm font-medium tracking-[1px] bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow-sm hover:shadow-md hover:bg-gray-300 dark:hover:bg-gray-700 transition">
             Punjabi
         </button>

     </div>



     <!-- Sub Tab Content marathi -->
     <div id="marathi" class="subtab-section">

         <!-- Marathi Movies in theatre -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Marathi Movies in Theatre

                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper theatremarathimovie">
                 <div class="swiper-wrapper " id="theatremarathimovie">


                 </div>

                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>

         <!-- trend marathi web series -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Top Web Series You Can’t Miss

                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper trendingmarathiwebseries">
                 <div class="swiper-wrapper " id="trendingmarathiwebseries">



                 </div>


                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>

         <!-- coming marathi series -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Coming Up Next
                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper upcomingmarathiwebseries">
                 <div class="swiper-wrapper " id="upcomingmarathiwebseries">




                 </div>


                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>

         <!-- watch at home marathi movies streaming  -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Watch at Home
                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper watchathomeottmarathi">
                 <div class="swiper-wrapper " id="watchathomeottmarathi">




                 </div>


                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>
         <!-- upcoming marathi movies -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Upcoming Marathi Movies

                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper upcomingmarathimoviesswiper">
                 <div class="swiper-wrapper " id="upcomingmarathimovies">

                 </div>

                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>
         @include('homepage.sections.trending_videos')
         @include('homepage.sections.marathi_box_officehits')
         @include('homepage.sections.top_3_marathi')
         @include('homepage.sections.newest_releases_marathi')




     </div>

     <!-- gujarati -->
     <div id="gujarati" class="subtab-section hidden">

         <!--Gujarati theatre movies -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Gujarati Movies in Theatre

                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper theatregujaratimovie">
                 <div class="swiper-wrapper " id="theatregujaratimovie">


                 </div>


                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>

         <!-- trend gujarati web series -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Top Web Series You Can’t Miss

                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper trendinggujaratiwebseries">
                 <div class="swiper-wrapper " id="trendinggujaratiwebseries">



                 </div>


                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>
         <!-- upcoming gujarati web series -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Top Web Series You Can’t Miss

                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper upcominggujaratiwebseries">
                 <div class="swiper-wrapper " id="upcominggujaratiwebseries">



                 </div>


                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>

         @include('homepage.sections.gujarati_movie_ott')
         <!-- upcomming gujarati movies -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Upcoming Gujarati Movies

                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper upcominggujaratimoviesswiper">
                 <div class="swiper-wrapper " id="upcominggujaratimovies">




                 </div>

                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>
         @include('homepage.sections.trending_videos')
         <!-- box office hits -->
         @include('homepage.sections.gujarati_boxoffice_hits')
         @include('homepage.sections.top_3_gujarati_movies')
         @include('homepage.sections.newest_releases_gujarati_movies')
     </div>

     <!-- punjabi section -->
     <div id="punjabi" class="subtab-section hidden">

         <!-- theatre Punjabi movies -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Punjabi Movies In Theatres
                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper theatrepunjabimovie">
                 <div class="swiper-wrapper " id="theatrepunjabimovie">




                 </div>

                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>

         <!-- trending web series -->

         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Top Web Series You Can’t Miss

                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper trendingpunjabiwebseries">
                 <div class="swiper-wrapper " id="trendingpunjabiwebseries">



                 </div>


                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>

         <!-- coming punjabi web series -->
         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Coming Up Next
                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="40" fill="currentColor" class="hidden md:block">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M8.88911 14.9994C3.37383 10.5446 0.73813 4.55253 0 0.345635L1.96991 0C2.63631 3.79806 5.05691 9.33313 10.1458 13.4436C12.861 15.6367 16.3628 17.4461 20.8135 18.3595V21.6434C16.3628 22.5568 12.861 24.3662 10.1458 26.5593C5.05691 30.6698 2.63631 36.2048 1.96991 40.0029L0 39.6573C0.73813 35.4504 3.37383 29.4583 8.88911 25.0035C11.5757 22.8334 14.9236 21.0459 19.0292 20.0014C14.9236 18.957 11.5757 17.1695 8.88911 14.9994Z" />
                     </svg>
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
           text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
           hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper upcomingpunjabiwebseries">
                 <div class="swiper-wrapper " id="upcomingpunjabiwebseries">




                 </div>


                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>


             </div>


         </section>



         @include('homepage.sections.punjabi_movies_ott')

         <!-- upcoming punjabi movies -->

         <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10 {{ get_mode() == 'full' ? '' : 'max-w-7xl' }} mx-auto">
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-lg md:text-2xl font-bold flex gap-2 text-gray-900 dark:text-white tracking-[1px]">
                     Upcoming Punjabi Movies
                 </h3>

                 <a href="{{ route('movie_list', ['key' => 'list']) }}"
                     class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-xs md:text-base uppercase font-bold 
                     text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 
                       hover:border-gray-400 dark:hover:border-gray-600 tracking-[1px] transition">
                     View All
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                 </a>
             </div>

             <div class="swiper upcomingpunjabimoviesswiper">
                 <div class="swiper-wrapper" id="upcomingpunjabimovies"></div>

                 <div class="swiper-button-prev !left-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
                 <div class="swiper-button-next !right-[2px] !bg-gray-800 !w-8 !h-8 hover:!bg-gray-700 dark:hover:!bg-gray-600 rounded-full shadow-md"></div>
             </div>
         </section>
         @include('homepage.sections.trending_videos')
         @include('homepage.sections.punjabi_box_officehits_movies')
         @include('homepage.sections.top_3_punjabi_movies')

         @include('homepage.sections.newest_releases_punjabi_movies')
     </div>






 </div>


 <!-- modal play trailer -->
 <div id="trailerModal" class="fixed inset-0 bg-black bg-opacity-80 hidden z-50 items-center justify-center">
     <div class="relative bg-black rounded-lg max-w-3xl w-full">
         <button id="closeModal" class="absolute top-2 right-3 text-white text-2xl">&times;</button>
         <div class="aspect-video w-full">
             <iframe id="trailerIframe" class="w-full h-full rounded-b-lg" src="" frameborder="0" allowfullscreen></iframe>
         </div>
     </div>
 </div>



 <section class="px-4 sm:px-6 md:px-10 lg:px-16 py-10  max-w-7xl mx-auto">
     <div class="max-w-7xl mx-auto">
         <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
             <!-- Left Side - Image -->
             <div class="w-full lg:w-1/2 relative">
                 <div class="relative overflow-hidden rounded-lg shadow-xl border border-gray-700 hover:border-yellow-500 transition-all duration-300">
                     <img
                         src="assets/images/join-us.avif"
                         alt="Movie critics discussing ratings"
                         class="w-full h-auto !object-cover transform hover:scale-102 transition duration-500">
                     <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                     <div class="absolute bottom-0 left-0 right-0 p-6">
                         <div class="flex items-center !sm:flex-col">
                             <div class="flex-shrink-0">
                                 <div class="bg-yellow-500 text-black font-bold text-sm px-3 py-1 rounded-md flex items-center">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                         <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                     </svg>
                                     TOP REVIEWERS
                                 </div>
                             </div>
                             <div class="ml-3 text-white text-sm font-medium">
                                 "Your ratings shape the industry"
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Right Side - Text Content -->
             <div class="w-full lg:w-1/2 text-white">
                 <h2 class="!text-[40px] !sm:text-4xl text-black dark:text-white font-bold mb-5 leading-tight">
                     Become a <span class="text-[#fe9a00]">Certified Critic</span>
                 </h2>

                 <p class="dark:text-white text-gray-900 text-lg mb-7">
                     Join our community of movie enthusiasts and make your ratings count. Your reviews help millions decide what to watch next.
                 </p>

                 <div class="space-y-5 mb-8">
                     <div class="flex items-start">
                         <div class="flex-shrink-0 mt-1">
                             <div class="h-8 w-8 rounded-full bg-gray-800 flex items-center justify-center border border-yellow-500/30">
                                 <svg class="h-4 w-4 text-[#fe9a00]" fill="currentColor" viewBox="0 0 20 20">
                                     <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                 </svg>
                             </div>
                         </div>
                         <div class="ml-3">
                             <h4 class="text-lg font-semibold dark:text-white text-gray-900">Rate & Review Movies</h4>
                             <p class="mt-1 dark:text-gray-400 text-gray-800 text-sm">Share your honest ratings and detailed reviews to help build the most accurate movie database.</p>
                         </div>
                     </div>

                     <div class="flex items-start">
                         <div class="flex-shrink-0 mt-1">
                             <div class="h-8 w-8 rounded-full bg-gray-800 flex items-center justify-center border border-yellow-500/30">
                                 <svg class="h-4 w-4 text-[#fe9a00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                 </svg>
                             </div>
                         </div>
                         <div class="ml-3">
                             <h4 class="text-lg font-semibold dark:text-white text-gray-900">Join the Discussion</h4>
                             <p class="mt-1 dark:text-gray-400 text-gray-800 text-sm">Debate with fellow critics, defend your ratings, and discover new perspectives.</p>
                         </div>
                     </div>

                     <div class="flex items-start">
                         <div class="flex-shrink-0 mt-1">
                             <div class="h-8 w-8 rounded-full bg-gray-800 flex items-center justify-center border border-yellow-500/30">
                                 <svg class="h-4 w-4 text-[#fe9a00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                 </svg>
                             </div>
                         </div>
                         <div class="ml-3">
                             <h4 class="text-lg font-semibold dark:text-white text-gray-900">Build Your Credibility</h4>
                             <p class="mt-1 dark:text-gray-400 text-gray-800 text-sm">Earn badges and recognition as your reviews get upvoted by the community.</p>
                         </div>
                     </div>
                 </div>

                 <div class="flex flex-col sm:flex-row gap-4">
                     <button class="!flex-1 !bg-[#fe9a00]  !text-black !font-bold !py-3 !px-6 !rounded-md !transition !duration-300 !flex !items-center !justify-center !gap-2">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                         </svg>
                         Start Rating Movies
                     </button>
                     <button class="flex-1 bg-transparent dark:hover:bg-gray-800 hover:bg-gray-300 dark:text-white text-black border border-black  font-bold py-3 px-6 rounded-md border border-gray-600 transition duration-300 flex items-center justify-center gap-2">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                         </svg>
                         See Top Reviews
                     </button>
                 </div>

                 <div class="mt-8 pt-6 border-t border-gray-800">
                     <div class="flex items-center">
                         <div class="flex-shrink-0 pr-3">
                             <div class="flex -space-x-2 overflow-hidden">
                                 <img class="inline-block h-10 w-10 rounded-full ring-2 ring-gray-800" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Reviewer 1">
                                 <img class="inline-block h-10 w-10 rounded-full ring-2 ring-gray-800" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Reviewer 2">
                                 <img class="inline-block h-10 w-10 rounded-full ring-2 ring-gray-800" src="https://randomuser.me/api/portraits/women/68.jpg" alt="Reviewer 3">
                                 <img class="inline-block h-10 w-10 rounded-full ring-2 ring-gray-800" src="https://randomuser.me/api/portraits/men/75.jpg" alt="Reviewer 4">
                             </div>
                         </div>
                         <div class="ml-4">
                             <p class="text-sm text-gray-400">Trusted by <span class="font-bold dark:text-white text-gray-500">10+</span> passionate critics worldwide</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>


 <!-- End Main -->
 <!-- Swiper JS -->
 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
 <!--<script src="{{ asset('js/upcoming-movies.js') }}"></script> -->

 <script>
     const baseUrl = "{{ url('movie-details') }}";
 </script>
 <!-- banner swiper js  -->

 <!-- catgeories swiper -->
 <script>
     new Swiper('.categories-slider', {
         slidesPerView: 1,
         spaceBetween: 20,
         loop: true,
         navigation: {
             nextEl: '.swiper-button-next-category',
             prevEl: '.swiper-button-prev-category'
         },
         autoplay: {
             delay: 3000,
             disableOnInteraction: false,
         },
         breakpoints: {
             480: {
                 slidesPerView: 2
             },
             768: {
                 slidesPerView: 3
             },
             1024: {
                 slidesPerView: 4
             },
             1280: {
                 slidesPerView: 5
             },
         }
     });
 </script>
 <!-- video reviews slider -->
 <script>
     new Swiper('.videoReviewsSwiper', {
         slidesPerView: 1,
         slidesPerGroup: 1, // Grouped sliding
         spaceBetween: 20,
         loop: true,
         navigation: {
             nextEl: '.swiper-button-next',
             prevEl: '.swiper-button-prev',
         },
         breakpoints: {
             640: {
                 slidesPerView: 2,
                 slidesPerGroup: 2
             },
             1024: {
                 slidesPerView: 3,
                 slidesPerGroup: 3
             },
             1280: {
                 slidesPerView: 4,
                 slidesPerGroup: 4
             },
         }
     });
 </script>

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const swiper = new Swiper('.artistsSwiper', {
             spaceBetween: 16,
             navigation: {
                 nextEl: ".swiper-button-next",
                 prevEl: ".swiper-button-prev",
             },
             breakpoints: {
                 320: {
                     slidesPerView: 2
                 },
                 640: {
                     slidesPerView: 3
                 },
                 768: {
                     slidesPerView: 4
                 },
                 1024: {
                     slidesPerView: 6
                 },
             },
         });
     });
 </script>
 <script>
     new Swiper(".newest-release", {
         slidesPerView: "auto",
         spaceBetween: 24,
         loop: false,
         navigation: {
             nextEl: ".swiper-button-next",
             prevEl: ".swiper-button-prev"
         }
     });
 </script>
 <script>
     new Swiper(".newestsouthrelases", {
         slidesPerView: "auto",
         spaceBetween: 24,
         loop: false,
         navigation: {
             nextEl: ".swiper-button-next",
             prevEl: ".swiper-button-prev"
         }
     });
 </script>
 <script>
     new Swiper(".newestreleasemarathimovies", {
         slidesPerView: "auto",
         spaceBetween: 24,
         loop: false,
         navigation: {
             nextEl: ".swiper-button-next",
             prevEl: ".swiper-button-prev"
         }
     });
 </script>

 <!-- JavaScript -->
 <script>
     const labels = document.querySelectorAll('.tab-label');
     const contents = document.querySelectorAll('.tab-content');

     labels.forEach(label => {
         label.addEventListener('click', () => {

             labels.forEach(l => l.classList.remove('border-yellow-500', 'text-yellow-500'));
             contents.forEach(c => c.classList.add('hidden'));


             label.classList.add('border-yellow-500', 'text-yellow-500');
             const tabId = label.getAttribute('data-tab');
             document.getElementById(tabId).classList.remove('hidden');
         });
     });


     labels[0].click();
 </script>
 <!-- box-office -->
 <script>
     const labelsboxoffice = document.querySelectorAll('.tab-label-box-office');
     const contentsboxoffice = document.querySelectorAll('.tab-content-box-office');

     labelsboxoffice.forEach(label => {
         label.addEventListener('click', () => {
             // Remove active classes
             labelsboxoffice.forEach(l => l.classList.remove('border-yellow-500', 'text-yellow-500'));
             contentsboxoffice.forEach(c => c.classList.add('hidden'));

             // Add active class to clicked label
             label.classList.add('border-yellow-500', 'text-yellow-500');

             // Get corresponding tab content by ID
             const tabId = label.getAttribute('data-tabboxoffice');
             const tabContent = document.getElementById(tabId);
             if (tabContent) {
                 tabContent.classList.remove('hidden');
             }
         });
     });

     // Trigger default click
     labelsboxoffice[0].click();
 </script>

 <!-- south box office hits -->
 <script>
     const labelsboxofficesouth = document.querySelectorAll('.tab-label-box-office-south');
     const contentsboxofficesouth = document.querySelectorAll('.tab-content-box-office-south');

     labelsboxofficesouth.forEach(label => {
         label.addEventListener('click', () => {

             labelsboxofficesouth.forEach(l => l.classList.remove('border-yellow-500', 'text-yellow-500'));
             contentsboxofficesouth.forEach(c => c.classList.add('hidden'));

             label.classList.add('border-yellow-500', 'text-yellow-500');


             const tabId = label.getAttribute('data-tabboxofficesouth');
             const tabContent = document.getElementById(tabId);
             if (tabContent) {
                 tabContent.classList.remove('hidden');
             }
         });
     });

     // Trigger default click
     labelsboxofficesouth[0].click();
 </script>

 <!-- marathi box office hits -->
 <script>
     const labelsboxofficemarathi = document.querySelectorAll('.tab-label-box-office-marathi');
     const contentsboxofficemarathi = document.querySelectorAll('.tab-content-box-office-marathi');

     labelsboxofficemarathi.forEach(label => {
         label.addEventListener('click', () => {

             labelsboxofficemarathi.forEach(l => l.classList.remove('border-yellow-500', 'text-yellow-500'));
             contentsboxofficemarathi.forEach(c => c.classList.add('hidden'));

             label.classList.add('border-yellow-500', 'text-yellow-500');


             const tabId = label.getAttribute('data-tabboxofficemarathi');
             const tabContent = document.getElementById(tabId);
             if (tabContent) {
                 tabContent.classList.remove('hidden');
             }
         });
     });

     // Trigger default click
     labelsboxofficemarathi[0].click();
 </script>

 <!-- gujarati box office hits -->
 <script>
     const labelsboxofficegujarati = document.querySelectorAll('.tab-label-box-office-gujarati');
     const contentsboxofficegujarati = document.querySelectorAll('.tab-content-box-office-gujarati');

     labelsboxofficegujarati.forEach(label => {
         label.addEventListener('click', () => {

             labelsboxofficegujarati.forEach(l => l.classList.remove('border-yellow-500', 'text-yellow-500'));
             contentsboxofficegujarati.forEach(c => c.classList.add('hidden'));

             label.classList.add('border-yellow-500', 'text-yellow-500');


             const tabId = label.getAttribute('data-tabboxofficegujarati');
             const tabContent = document.getElementById(tabId);
             if (tabContent) {
                 tabContent.classList.remove('hidden');
             }
         });
     });

     // Trigger default click
     labelsboxofficegujarati[0].click();
 </script>

 <!-- punjabi box office hits tabs -->
 <script>
     const labelsboxofficepunjabi = document.querySelectorAll('.tab-label-box-office-Punjabi');
     const contentsboxofficepunjabi = document.querySelectorAll('.tab-content-box-office-Punjabi');

     labelsboxofficepunjabi.forEach(label => {
         label.addEventListener('click', () => {

             labelsboxofficepunjabi.forEach(l => l.classList.remove('border-yellow-500', 'text-yellow-500'));
             contentsboxofficepunjabi.forEach(c => c.classList.add('hidden'));

             label.classList.add('border-yellow-500', 'text-yellow-500');


             const tabId = label.getAttribute('data-tabboxofficePunjabi');
             const tabContent = document.getElementById(tabId);
             if (tabContent) {
                 tabContent.classList.remove('hidden');
             }
         });
     });

     // Trigger default click
     labelsboxofficepunjabi[0].click();
 </script>




 <!-- news tabs -->
 <script>
     const labelsnews = document.querySelectorAll('.tab-label-news');
     const contentsnews = document.querySelectorAll('.tab-content-news');

     labelsnews.forEach(label => {
         label.addEventListener('click', () => {
             // Remove active classes
             labelsnews.forEach(l => l.classList.remove('border-yellow-500', 'text-yellow-500'));
             contentsnews.forEach(c => c.classList.add('hidden'));

             // Add active class to clicked label
             label.classList.add('border-yellow-500', 'text-yellow-500');

             // Get corresponding tab content by ID
             const tabId = label.getAttribute('data-tabnews');
             const tabContent = document.getElementById(tabId);
             if (tabContent) {
                 tabContent.classList.remove('hidden');
             }
         });
     });

     // Trigger default click
     labelsnews[0].click();
 </script>

 <script>
     const swiper = new Swiper('.mySwiper', {
         slidesPerView: 2,
         spaceBetween: 16,
         navigation: {
             nextEl: '.swiper-button-next',
             prevEl: '.swiper-button-prev',
         },
         breakpoints: {
             640: {
                 slidesPerView: 2
             },
             768: {
                 slidesPerView: 3
             },
             1024: {
                 slidesPerView: 4
             },
             1280: {
                 slidesPerView: 4
             },
         },
     });
 </script>

 <!-- top news swiper -->
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const swiper = new Swiper('.newsSwiper', {
             slidesPerView: 1,
             spaceBetween: 20,
             grabCursor: true,
             loop: true,
             pagination: {
                 el: '.swiper-pagination',
                 clickable: true,
             },
             navigation: {
                 nextEl: '.swiper-button-next-news',
                 prevEl: '.swiper-button-prev-news',
             },
             breakpoints: {
                 640: {
                     slidesPerView: 2
                 },
                 768: {
                     slidesPerView: 2
                 },
                 1024: {
                     slidesPerView: 3
                 },
                 1280: {
                     slidesPerView: 4
                 },
             },
         });
     });
 </script>
 <!--upcoming movie -->
 <script>
     const TMDB_API_KEY = "2ada23b643332d312a867b88397fc147";
     async function fetchUpcomingBollywoodMovies() {
         const today = new Date().toISOString().split('T')[0];
         const container = document.getElementById('upcoming-movies');

         container.innerHTML = `<div class="text-white p-4">Loading...</div>`;

         const url = `https://api.themoviedb.org/3/movie/upcoming?api_key=${TMDB_API_KEY}&region=IN`;

         try {
             const res = await fetch(url);
             const data = await res.json();

             const southMovies = data.results.filter(movie => ['ta', 'te', 'ml', 'kn'].includes(movie.original_language));


             if (!southMovies || southMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4">No upcoming South Indian movies found.</div>`;
                 return;
             }


             container.innerHTML = data.results.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 const releaseDate = new Date(movie.release_date);
                 const today = new Date();
                 const diffDays = Math.ceil((releaseDate - today) / (1000 * 60 * 60 * 24));

                 return `
               <div class="swiper-slide !w-[187px]">
                 <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                   <!-- Image -->
                   <div class="relative">
                     <div class="relative group">
                       <div class="relative !h-[280px] overflow-hidden !rounded-md">
                         <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                       </div>
                       <!-- Play Button Overlay -->
                       <a href="javascript:void(0)"
                          class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn"
                          data-id="${movie.id}">
                         <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                           <i class="fa-solid fa-play text-white text-2xl"></i>
                         </div>
                       </a>
                     </div>
                   </div>
                   <!-- Content -->
                   <div class="px-1 pt-2 flex-grow flex flex-col">
                     <div class="flex">
                       <a href="${baseUrl}/${movie.id}">
                         <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                       </a>
                     </div>
                     <div class="flex gap-3 pt-3">
                       <button class="flex-1 p-2 !border !border-2 !border-gray-900 !rounded-full bg-white text-gray-700 dark:bg-black dark:text-white tracking-[1px] font-semibold text-[13px] flex items-center justify-center gap-1.5 transition-all !uppercase duration-300">
                         <i class="fa fa-clock text-[15px]"></i> Remind Me
                       </button>
                     </div>
                   </div>
                 </div>
               </div>
            `;
             }).join('');

             new Swiper('.upcomingmoviesswiper', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });

         } catch (error) {
             console.error(error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4">Failed to load upcoming Bollywood movies.</div>`;
         }
     }

     // Auto run on DOM load
     document.addEventListener("DOMContentLoaded", fetchUpcomingBollywoodMovies);
 </script>

 <script>
     const apiKey = '2ada23b643332d312a867b88397fc147';
     const boxofficeContainer = document.getElementById('box-office-slider');
     const tabs = document.querySelectorAll('[data-tabboxoffice]');

     const generateCard = (movie) => {
         const title = movie.title || movie.name;
         const releaseDate = movie.release_date || movie.first_air_date || 'N/A';
         const genres = (movie.genre_names || []).join('/') || 'Drama';
         const rating = movie.vote_average || '7.5';
         const poster = movie.poster_path ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` : 'https://masalameter.micodetest.com/assets/images/png.png';

         return `<div class="swiper-slide !w-[187px]">
        <div class=" !w-[187px] bg-white dark:bg-black hover:border-gray-400 transition-all duration-300 rounded-xl  overflow-hidden h-full flex flex-col">
    
    <!-- Image & Actions -->
    <div class="relative">
  


          <div class="relative group">


       <div class="relative !h-[280px]  overflow-hidden !rounded-md">
        <img src="${poster}" alt="${title}" class=" !h-[280px]  !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
     </div>

     <!-- Play Button Overlay -->
     <a href="javascript:void(0)"
   class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn"
   data-id="${movie.id}">

     <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
      <i class="fa-solid fa-play text-white text-2xl"></i>
     </div>

     </a>


     </div>

      <!-- Rating Badge -->
      

      <!-- Bookmark Button -->
      <button class="absolute top-3 right-[8px]  bg-black/70 hover:bg-black/90 p-2 rounded-md backdrop-blur-sm shadow-sm transition">
        <i class="fa fa-bookmark text-yellow-400 text-[13px]"></i>
      </button>
    </div>

    <!-- Content Section -->
    <div class="px-1 pt-2  text-sm flex flex-col justify-between flex-grow">
      <!-- Title -->
      <div class="flex justify-between">
     <a href="${baseUrl}/${movie.id}"> <p class="!text-[18px] font-semibold text-gray-900 dark:text-white  leading-snug truncate w-[120px]">${title}</p></a>
     <div class="  text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
        <i class="fa-solid fa-star !text-xs"></i>
        <span class="font-bold !text-xs">${rating}/10</span>
      </div>
      </div>

      <!-- Collection -->


    

     

      <!-- Buttons -->
      <div class="flex flex-col gap-2 mt-2">
        <a href="${baseUrl}/${movie.id}" class="flex items-center justify-center !border !border-gray-500 hover:!border-gray-900 gap-2 p-2 bg-white text-gray-700  dark:bg-black dark:text-white tracking-[1px] uppercase font-semibold text-[13px] !rounded-full transition duration-200 ">
          Rate this Movie <i class="fa-solid fa-arrow-up-right-from-square text-[13px] mt-[1px]"></i>
        </a>

    
        </div>
       </div>
     </div>
     </div>
     `;
     };

     const fetchBoxOfficeData = async (tab) => {
         boxofficeContainer.innerHTML = '<div class="text-white p-4">Loading...</div>';
         const today = new Date();
         const fromDate = new Date(tab === 'weeks' ? today.setDate(today.getDate() - 7) : today.setMonth(today.getMonth() - 1));
         const startDate = fromDate.toISOString().split('T')[0];
         const endDate = new Date().toISOString().split('T')[0];

         try {
             const res = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&region=IN&sort_by=popularity.desc&with_original_language=hi&release_date.gte=${startDate}&release_date.lte=${endDate}`);
             const data = await res.json();
             const results = data.results || [];

             if (!results.length) {
                 boxofficeContainer.innerHTML = '<div class="!text-gray-900 dark:text-white p-4">No Bollywood movies found.</div>';
                 return;
             }
             boxofficeContainer.innerHTML = results.map(generateCard).join('');
             const swiper = new Swiper('.enhanced-movie-swiper', {
                 slidesPerView: "auto",
                 spaceBetween: 10,
                 freeMode: true,
                 grabCursor: true,
                 navigation: {
                     nextEl: ".swiper-button-next",
                     prevEl: ".swiper-button-prev",
                 },

             });



         } catch (e) {
             console.error(e);
             boxofficeContainer.innerHTML = '<div class="!text-gray-900 dark:text-white p-4">Failed to load data.</div>';
         }
     };

     tabs.forEach(tab => tab.addEventListener('click', () => fetchBoxOfficeData(tab.dataset.tabboxoffice)));
     fetchBoxOfficeData('weeks');
 </script>

 <!-- Swiper Container (make sure Swiper CSS/JS are included) -->
 <!-- box office top 3 -->
 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     function cardHTML(movie) {
         const title = movie.title;
         const poster = movie.poster_path ?
             `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
             'https://masalameter.micodetest.com/assets/images/png.png';
         const rating = movie.vote_average.toFixed(1);
         const release = formatDate(movie.release_date);
         const genres = movie.genre_ids?.map(id => genreMap[id] || '')?.filter(Boolean);
         const genresHTML = genres?.map(g =>
             `<span class="text-[14px]  rounded-md font-medium text-gray-900 dark:text-white">${g}</span>`
         ).join('/');

         return `
             <div class="swiper-slide !w-[187px]">
        <div class=" !w-[187px] bg-white dark:bg-black   transition-all duration-300 rounded-xl  overflow-hidden h-full flex flex-col">
    
             <!-- Image & Actions -->
                    <div class="relative">
  


            <div class="relative group">


            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                <img src="${poster}" alt="${title}" class=" !h-[280px]  !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                </div>

                <!-- Play Button Overlay -->
           <a href="javascript:void(0)"
   class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn"
   data-id="${movie.id}">

  <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
    <i class="fa-solid fa-play text-white text-2xl"></i>
  </div>

        </a>
                </div>

      <!-- Rating Badge -->
      

      <!-- Bookmark Button -->
      <button class="absolute top-3 right-[8px]  bg-black/70 hover:bg-black/90 p-2 rounded-md backdrop-blur-sm shadow-sm transition">
        <i class="fa fa-bookmark text-yellow-400 text-[13px]"></i>
      </button>
    </div>

    <!-- Content Section -->
    <div class="px-1 pt-2  text-sm flex flex-col justify-between flex-grow">
      <!-- Title -->
      <div class="flex justify-between">
      
     <a href="${baseUrl}/${movie.id}"> <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p></a>
     <div class="  text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1 ">
        <i class="fa-solid fa-star !text-xs"></i>
        <span class="font-bold !text-xs">${rating}/10</span>
      </div>
      </div>


      <!-- Release & Genre -->
    

     

      <!-- Buttons -->
      
    </div>
        </div>
            </div>
            `;
     }

     // Minimal genre mapping — expand as needed
     var genreMap = {
         28: 'Action',
         18: 'Drama',
         53: 'Thriller',
         35: 'Comedy'
     };

     async function loadTop3Bollywood() {
         const today = new Date();
         const weekStart = new Date();
         weekStart.setDate(today.getDate() - 7);

         const url = `https://api.themoviedb.org/3/discover/movie?` +
             `api_key=${TMDB_API_KEY}` +
             `&language=en-IN&region=IN&with_original_language=hi&with_production_countries=IN` +
             `&release_date.gte=${weekStart.toISOString().split('T')[0]}` +
             `&release_date.lte=${today.toISOString().split('T')[0]}` +
             `&sort_by=popularity.desc&page=1`;

         try {
             const res = await fetch(url);
             const data = await res.json();
             const results = data.results || [];
             console.log("Total results from API:", results.length);


             const top3 = results.slice(0, 3);
             const containerTop3 = document.getElementById('boxoffice-top3');
             if (containerTop3) {
                 if (top3.length === 0) {
                     containerTop3.innerHTML = '<div class="!text-gray-900 dark:text-white p-4">No Bollywood hits this week.</div>';
                 } else {
                     containerTop3.innerHTML = top3.map(cardHTML).join('');
                     new Swiper('.top-movies-weeks', {
                         slidesPerView: 1,
                         spaceBetween: 15,
                         navigation: {
                             nextEl: '#next-top3',
                             prevEl: '#prev-top3'
                         },
                         breakpoints: {
                             640: {
                                 slidesPerView: 1
                             },
                             768: {
                                 slidesPerView: 3
                             },
                             1024: {
                                 slidesPerView: 4
                             },
                             1280: {
                                 slidesPerView: 5.5
                             }
                         }
                     });
                 }
             }


             const top10 = results.slice(0, 6);
             const containerTheatre = document.getElementById('movie-theatre');
             if (containerTheatre) {
                 if (top10.length === 0) {
                     containerTheatre.innerHTML = '<div class="!text-gray-900 dark:text-white p-4">No Bollywood hits this week.</div>';
                 } else {
                     containerTheatre.innerHTML = top10.map(cardHTML).join('');

                     // Wait for DOM update before initializing
                     setTimeout(() => {
                         const swiper = new Swiper('.swiper-theatre', {
                             slidesPerView: 1,
                             spaceBetween: 16,
                             navigation: {
                                 nextEl: '.swiper-button-next',
                                 prevEl: '.swiper-button-prev'
                             },
                             breakpoints: {
                                 640: {
                                     slidesPerView: 1
                                 },
                                 768: {
                                     slidesPerView: 3
                                 },
                                 1024: {
                                     slidesPerView: 4
                                 },
                                 1280: {
                                     slidesPerView: 5.5
                                 }
                             },
                             on: {
                                 slideChange: function() {
                                     const prev = document.querySelector('.swiper-button-prev');
                                     const next = document.querySelector('.swiper-button-next');
                                     if (prev && next) {
                                         prev.classList.toggle('opacity-50', this.isBeginning);
                                         next.classList.toggle('opacity-50', this.isEnd);
                                     }
                                 },
                                 afterInit: function() {
                                     this.emit('slideChange');
                                 }
                             }
                         });
                     }, 50); // slight delay to allow rendering
                 }
             }
         } catch (err) {
             console.error(err);
             document.getElementById('boxoffice-top3').innerHTML =
                 '<div class="!text-gray-900 dark:text-white p-4">Failed to load data.</div>';
             document.getElementById('movie-theatre').innerHTML =
                 '<div class="!text-gray-900 dark:text-white p-4">Failed to load data.</div>';
         }
     }

     // Run after DOM is ready
     document.addEventListener('DOMContentLoaded', loadTop3Bollywood);
 </script>

 <!-- movies theatre -->


 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     function cardHTML(movie) {
         const title = movie.title;
         const poster = movie.poster_path ?
             `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
             'https://masalameter.micodetest.com/assets/images/png.png';
         const rating = movie.vote_average.toFixed(1);
         const release = formatDate(movie.release_date);
         const genres = movie.genre_ids?.map(id => genreMap[id] || '')?.filter(Boolean);
         const genresHTML = genres?.map(g =>
             `<span class="text-[14px]   rounded-md font-medium !text-gray-900">${g}</span>`
         ).join('/');

         return `
             <div class="swiper-slide !w-[187px]">
        <div class="!bg-white !w-[187px]   transition-all duration-300 rounded-xl  overflow-hidden h-full flex flex-col">
    
             <!-- Image & Actions -->
                    <div class="relative">
  


            <div class="relative group">


            <div class="relative !h-[280px]  overflow-hidden !rounded-md">
                <img src="${poster}" alt="${title}" class=" !h-[280px]  !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                </div>

                <!-- Play Button Overlay -->
          <a href="javascript:void(0)"
   class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 movie-overlay flex items-center justify-center rounded-full p-3 watch-trailer-btn"
   data-id="${movie.id}">

  <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
    <i class="fa-solid fa-play text-white text-2xl"></i>
  </div>

        </a>
                </div>

      <!-- Rating Badge -->
      

      <!-- Bookmark Button -->
      <button class="absolute top-3 right-[8px]  bg-black/70 hover:bg-black/90 p-2 rounded-md backdrop-blur-sm shadow-sm transition">
        <i class="fa fa-bookmark text-yellow-400 text-[13px]"></i>
      </button>
    </div>

    <!-- Content Section -->
    <div class="px-1 py-3  space-y-2 text-sm flex flex-col justify-between flex-grow">
      <!-- Title -->
      <div class="flex justify-between">
     <a href="${baseUrl}/${movie.id}"> <p class="text-[16px] font-semibold !text-gray-900  leading-snug truncate w-[120px]">${title}</p></a>
     <div class=" text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1 ">
        <i class="fa-solid fa-star !text-xs"></i>
        <span class="font-bold !text-xs">${rating}/10</span>
      </div>
      </div>


      <!-- Release & Genre -->
       <div class="!text-gray-900  text-xs space-y-1">
          <!-- <p class="!text-gray-900  text-xs">Release: <span class="!text-gray-900 dark:text-white text-xs">${release}</span></p>-->
        <p class="!text-gray-900 "><span class="inline-block  py-1 px-3 rounded-md text-xs  !text-gray-900">${genresHTML}</span></p>
        
      </div>

     

      <!-- Buttons -->
      <div class="flex flex-col gap-2 mt-2">
             <a href="${baseUrl}/${movie.id}"
   class="flex-1 p-2 w-[100px] !border !border-gray-500 !rounded-full bg-white !text-gray-700 tracking-[1px] font-semibold text-[13px] uppercase flex items-center justify-center gap-1.5 hover:!border-gray-900 transition-all duration-300">
  <i class="fa fa-eye text-[15px]"></i> View Details
    </a>

     
      </div>
    </div>
        </div>
            </div>
            `;
     }

     // Minimal genre mapping — expand as needed
     const genreMap = {
         28: 'Action',
         18: 'Drama',
         53: 'Thriller',
         35: 'Comedy'
     };

     async function theatreallmovies() {
         const today = new Date();
         const weekStart = new Date();
         weekStart.setDate(today.getDate() - 7);

         const url = `https://api.themoviedb.org/3/discover/movie?` +
             `api_key=${TMDB_API_KEY}` +
             `&language=en-IN&region=IN&with_original_language=hi&with_production_countries=IN` +
             `&release_date.gte=${weekStart.toISOString().split('T')[0]}` +
             `&release_date.lte=${today.toISOString().split('T')[0]}` +
             `&sort_by=popularity.desc&page=1`;

         try {
             const res = await fetch(url);
             const data = await res.json();
             const top3 = (data.results || []).slice(0, 10);

             const container = document.getElementById('theatremovies');
             if (top3.length === 0) {
                 container.innerHTML = '<div class="!text-gray-900 dark:text-white p-4">No Bollywood hits this week.</div>';
                 return;
             }

             container.innerHTML = top3.map(cardHTML).join('');

             new Swiper('.boxoffice-swiper', {
                 slidesPerView: 1,
                 spaceBetween: 15,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev'
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 2
                     },
                     1024: {
                         slidesPerView: 3
                     }
                 }
             });
         } catch (err) {
             console.error(err);
             document.getElementById('theatremovies').innerHTML =
                 '<div class="!text-gray-900 dark:text-white p-4">Failed to load data.</div>';
         }
     }

     // Initialize on page load
     document.addEventListener('DOMContentLoaded', theatreallmovies);
 </script>

 <!-- south movies in  theatre -->


 <script>
     async function fetchAllUpcomingSouthMovies1() {
         const container = document.getElementById('theatresauthmovie');
         container.innerHTML = `<div class="text-white p-4">Loading...</div>`;

         const languages = ['ta', 'te', 'ml', 'kn'];
         let allMovies = [];
         let page = 1;
         let totalPages = 1;

         try {
             do {
                 const url = `https://api.themoviedb.org/3/movie/now_playing?api_key=${upcoming_API_KEY}&region=IN&page=${page}&sort_by=release_date.desc`;
                 const res = await fetch(url);
                 const data = await res.json();

                 totalPages = data.total_pages;

                 const southMovies = (data.results || []).filter(m => languages.includes(m.original_language));
                 allMovies = allMovies.concat(southMovies);

                 page++;
             } while (page <= totalPages);

             if (allMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto text-center">No In theatre South Indian movies found.</div>`;
                 return;
             }

             container.innerHTML = allMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 const releaseDate = new Date(movie.release_date);
                 const today = new Date();
                 const rating = movie.vote_average.toFixed(1);
                 const diffDays = Math.ceil((releaseDate - today) / (1000 * 60 * 60 * 24));

                 return `
            <div class="swiper-slide !w-[187px]">
                <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                    <div class="relative">
                        <div class="relative group">
                            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                            </div>
                            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-play text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="px-1 pt-2 flex-grow flex flex-col">
                        <div class="flex justify-between">
                            <a href="${baseUrl}/${movie.id}">
                                <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                            </a>
                            <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                            <i class="fa-solid fa-star !text-xs"></i>
                            <span class="font-bold !text-xs">${rating}/10</span>
                        </div>
                        </div>

                        
                        
                    </div>
                </div>
            </div>


            
            `;
             }).join('');

             new Swiper('.theatresauthmovie', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });

         } catch (error) {
             console.error(error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4">Failed to load In   Theatre South Indian movies.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", fetchAllUpcomingSouthMovies1);
 </script>

 <!-- upcoming south movie -->
 <script>
     const upcoming_API_KEY = "2ada23b643332d312a867b88397fc147";


     async function fetchAllUpcomingSouthMovies() {
         const container = document.getElementById('upcomingsouthmovies');
         if (!container) return;

         container.innerHTML = `<div class="text-white p-4 text-center">Loading upcoming South Indian movies...</div>`;

         // ISO 639-1 codes for South Indian languages: Tamil, Telugu, Malayalam, Kannada
         const languages = ['ta', 'te', 'ml', 'kn'];
         const languageFilter = languages.join('|'); // 'ta|te|ml|kn'

         // Get today's date in YYYY-MM-DD format
         const today = new Date().toISOString().split('T')[0];

         let allMovies = [];
         let page = 1;
         let totalPages = 1;

         try {
             do {
                 // **BETTER API URL: Using discover/movie for better filtering and control**
                 const url = `https://api.themoviedb.org/3/discover/movie?api_key=${upcoming_API_KEY}&region=IN&sort_by=primary_release_date.desc&primary_release_date.gte=${today}&with_original_language=${languageFilter}&page=${page}`;

                 const res = await fetch(url);
                 if (!res.ok) {
                     throw new Error(`TMDB API returned status: ${res.status}`);
                 }
                 const data = await res.json();

                 totalPages = data.total_pages;

                 // Collect all results. The API is already filtering by language.
                 allMovies = allMovies.concat(data.results || []);

                 page++;
             } while (page <= totalPages && page <= 5); // Added a safeguard (max 5 pages)

             // **FIX FOR DUPLICATES: Deduplicate results based on movie ID**
             const uniqueMovies = Array.from(new Map(allMovies.map(movie => [movie.id, movie])).values());

             console.log(`Total upcoming South Indian movies (deduplicated): ${uniqueMovies.length}`);


             if (uniqueMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto text-center">No upcoming South Indian movies found.</div>`;
                 return;
             }

             // Render unique movies
             container.innerHTML = uniqueMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 return `
            <div class="swiper-slide !w-[187px]">
                <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                    <div class="relative">
                        <div class="relative group">
                            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                            </div>
                            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-play text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="px-1 pt-2 flex-grow flex flex-col">
                        <div class="flex">
                            <a href="${baseUrl}/${movie.id}">
                                <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            `;
             }).join('');

             // Swiper initialization (kept as is)
             new Swiper('.upcomingsouthmoviesswiper', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         if (prev) prev.classList.toggle('disabled', this.isBeginning);
                         if (next) next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });

         } catch (error) {
             console.error("Error fetching upcoming South Indian movies:", error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4">Failed to load upcoming South Indian movies.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", fetchAllUpcomingSouthMovies);
 </script>

 <!-- marathi movie which in theatre -->

 <script>
     async function loadMarathiInTheatres() {
         const container = document.getElementById('theatremarathimovie');
         container.innerHTML = `<div class="text-white p-4  text-center m-auto">Loading...</div>`;

         const languages = 'mr';
         let allMovies = [];
         let page = 1;
         let totalPages = 1;

         try {
             do {
                 const url = `https://api.themoviedb.org/3/movie/now_playing?api_key=${TMDB_API_KEY}&region=IN&page=${page}&sort_by=release_date.desc`;
                 const res = await fetch(url);
                 const data = await res.json();

                 totalPages = data.total_pages;

                 const southMovies = (data.results || []).filter(m => languages.includes(m.original_language));
                 allMovies = allMovies.concat(southMovies);

                 page++;
             } while (page <= totalPages);

             if (allMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto text-center">No upcoming South Indian movies found.</div>`;
                 return;
             }

             container.innerHTML = allMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 const releaseDate = new Date(movie.release_date);
                 const today = new Date();
                 const rating = movie.vote_average.toFixed(1);
                 const diffDays = Math.ceil((releaseDate - today) / (1000 * 60 * 60 * 24));

                 return `
            <div class="swiper-slide !w-[187px]">
                <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                    <div class="relative">
                        <div class="relative group">
                            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                            </div>
                            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-play text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="px-1 pt-2 flex-grow flex flex-col">
                        <div class="flex justify-between">
                            <a href="${baseUrl}/${movie.id}">
                                <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                            </a>
                            <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                            <i class="fa-solid fa-star !text-xs"></i>
                            <span class="font-bold !text-xs">${rating}/10</span>
                        </div>
                        </div>

                        
                        
                    </div>
                </div>
            </div>


            
            `;
             }).join('');

             new Swiper('.theatremarathimovie', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });

         } catch (error) {
             console.error(error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4  text-center m-auto">Failed to load upcoming South Indian movies.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", loadMarathiInTheatres);
 </script>

 <!-- upcoming marathi movies -->
 <script>
     async function fetchAllUpcomingMarathiMovies() {
         const container = document.getElementById('upcomingmarathimovies');
         container.innerHTML = `<div class="text-white p-4  text-center m-auto">Loading...</div>`;

         const language = 'mr'; // Marathi
         let allMovies = [];
         let page = 1;
         let totalPages = 1;

         try {
             do {
                 const url = `https://api.themoviedb.org/3/discover/movie?api_key=${TMDB_API_KEY}&region=IN&with_original_language=mr&language=en-IN&sort_by=primary_release_date.desc&primary_release_date.gte=${today}&page=${page}`;


                 const res = await fetch(url);
                 const data = await res.json();

                 totalPages = data.total_pages;

                 const marathiMovies = (data.results || []).filter(m => m.original_language === language);
                 allMovies = allMovies.concat(marathiMovies);

                 page++;
             } while (page <= totalPages);

             if (allMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4  text-center m-auto">No upcoming Marathi movies found.</div>`;
                 return;
             }

             container.innerHTML = allMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 return `
                <div class="swiper-slide !w-[187px]">
                    <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                        <div class="relative group">
                            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                            </div>
                            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-play text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>
                        <div class="px-1 pt-2 flex-grow flex flex-col">
                            <div class="flex">
                                <a href="${baseUrl}/${movie.id}">
                                    <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                `;
             }).join('');

             // Initialize Swiper
             new Swiper('.upcomingmarathimoviesswiper', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });

         } catch (error) {
             console.error(error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4  text-center m-auto">Failed to load upcoming Marathi movies.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", fetchAllUpcomingMarathiMovies);
 </script>

 <!-- gujrati movies in theatre  -->

 <script>
     async function loadgujaratiInTheatres() {
         const container = document.getElementById('theatregujaratimovie');
         container.innerHTML = `<div class="text-white p-4">Loading...</div>`;

         const languages = "gu";
         let allMovies = [];
         let page = 1;
         let totalPages = 1;

         try {
             do {
                 const url = `https://api.themoviedb.org/3/movie/now_playing?api_key=${TMDB_API_KEY}&region=IN&page=${page}&sort_by=release_date.desc`;
                 const res = await fetch(url);
                 const data = await res.json();

                 totalPages = data.total_pages;

                 const southMovies = (data.results || []).filter(m => languages.includes(m.original_language));
                 allMovies = allMovies.concat(southMovies);

                 page++;
             } while (page <= totalPages);

             if (allMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto text-center">No upcoming South Indian movies found.</div>`;
                 return;
             }

             container.innerHTML = allMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 const releaseDate = new Date(movie.release_date);
                 const today = new Date();
                 const rating = movie.vote_average.toFixed(1);
                 const diffDays = Math.ceil((releaseDate - today) / (1000 * 60 * 60 * 24));

                 return `
            <div class="swiper-slide !w-[187px]">
                <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                    <div class="relative">
                        <div class="relative group">
                            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                            </div>
                            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-play text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="px-1 pt-2 flex-grow flex flex-col">
                        <div class="flex justify-between">
                            <a href="${baseUrl}/${movie.id}">
                                <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                            </a>
                            <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                            <i class="fa-solid fa-star !text-xs"></i>
                            <span class="font-bold !text-xs">${rating}/10</span>
                        </div>
                        </div>

                        
                        
                    </div>
                </div>
            </div>


            
            `;
             }).join('');

             new Swiper('.theatregujaratimovie', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });

         } catch (error) {
             console.error(error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4">Failed to load Gujarati movies.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", loadgujaratiInTheatres);
 </script>

 <!-- upcoming gujarati movies -->

 <script>
     async function fetchAllUpcomingGujaratiMovies() {
         const container = document.getElementById('upcominggujaratimovies');
         container.innerHTML = `<div class="text-white p-4 text-center m-auto">Loading...</div>`;
         const today = new Date().toISOString().split('T')[0];
         const languages = "gu";
         let allMovies = [];
         let page = 1;
         let totalPages = 1;
         const originCountryCode = 'IN';

         try {
             do {
                 const url = `https://api.themoviedb.org/3/discover/movie?api_key=${TMDB_API_KEY}&region=IN&sort_by=primary_release_date.desc&primary_release_date.lte=${today}&page=${page}&with_original_language=${languages}&with_origin_country=${originCountryCode}`;
                 const res = await fetch(url);
                 const data = await res.json();

                 totalPages = data.total_pages;

                 const southMovies = (data.results || []).filter(m => languages.includes(m.original_language));
                 allMovies = allMovies.concat(southMovies);

                 page++;
             } while (page <= totalPages);

             if (allMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto text-center">No upcoming Gujarati Indian movies found.</div>`;
                 return;
             }

             container.innerHTML = allMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 const releaseDate = new Date(movie.release_date);
                 const today = new Date();
                 const rating = movie.vote_average.toFixed(1);
                 const diffDays = Math.ceil((releaseDate - today) / (1000 * 60 * 60 * 24));

                 return `
            <div class="swiper-slide !w-[187px]">
                <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                    <div class="relative">
                        <div class="relative group">
                            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                            </div>
                            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-play text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="px-1 pt-2 flex-grow flex flex-col">
                        <div class="flex justify-between">
                            <a href="${baseUrl}/${movie.id}">
                                <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                            </a>
                            
                        </div>

                        
                        
                    </div>
                </div>
            </div>


            
            `;
             }).join('');

             new Swiper('.upcominggujaratimoviesswiper', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });

         } catch (error) {
             console.error(error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4  text-center m-auto">Failed to load upcoming gujarati movies.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", fetchAllUpcomingGujaratiMovies);
 </script>

 <!-- punjabi movie in theatre -->

 <script>
     async function loadPunjabiInTheatres() {
         const container = document.getElementById('theatrepunjabimovie');
         container.innerHTML = `<div class="text-white p-4  text-center m-auto">Loading...</div>`;

         const languages = "pa";
         let allMovies = [];
         let page = 1;
         let totalPages = 1;

         try {
             do {
                 const url = `https://api.themoviedb.org/3/movie/now_playing?api_key=${TMDB_API_KEY}&region=IN&page=${page}&sort_by=release_date.desc`;
                 const res = await fetch(url);
                 const data = await res.json();

                 totalPages = data.total_pages;

                 const southMovies = (data.results || []).filter(m => languages.includes(m.original_language));
                 allMovies = allMovies.concat(southMovies);

                 page++;
             } while (page <= totalPages);

             if (allMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto text-center">No Punjabi movies found in Theatre.</div>`;
                 return;
             }

             container.innerHTML = allMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 const releaseDate = new Date(movie.release_date);
                 const today = new Date();
                 const rating = movie.vote_average.toFixed(1);
                 const diffDays = Math.ceil((releaseDate - today) / (1000 * 60 * 60 * 24));

                 return `
            <div class="swiper-slide !w-[187px]">
                <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                    <div class="relative">
                        <div class="relative group">
                            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                            </div>
                            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-play text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="px-1 pt-2 flex-grow flex flex-col">
                        <div class="flex justify-between">
                            <a href="${baseUrl}/${movie.id}">
                                <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                            </a>
                            <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                            <i class="fa-solid fa-star !text-xs"></i>
                            <span class="font-bold !text-xs">${rating}/10</span>
                        </div>
                        </div>

                        
                        
                    </div>
                </div>
            </div>


            
            `;
             }).join('');
             console.log("Punjabi movies data in theatre ", allMovies)

             new Swiper('.theatrepunjabimovie', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });

         } catch (error) {
             console.error(error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4  text-center m-auto">Failed to load Punjabi  movies in Theatre.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", loadPunjabiInTheatres);
 </script>

 <!-- upcoming punjabi movies  -->
 <script>
     async function fetchAllUpcomingPunjabiMovies() {
         const container = document.getElementById('upcomingpunjabimovies');
         container.innerHTML = `<div class="dark:text-white text-gray-900 p-4 text-center m-auto">Loading...</div>`;
         const tomorrow = new Date();
         tomorrow.setDate(tomorrow.getDate() + 1);
         const tomorrowDate = tomorrow.toISOString().split('T')[0];
         const languages = "pa";
         let allMovies = [];
         let page = 1;
         let totalPages = 1;
         const originCountryCode = 'IN';

         try {
             do {
                 const url = `https://api.themoviedb.org/3/discover/movie?api_key=${TMDB_API_KEY}&region=IN&sort_by=primary_release_date.desc&primary_release_date.gte=${tomorrow}&page=${page}&with_original_language=${languages}&with_origin_country=${originCountryCode}`;
                 const res = await fetch(url);
                 const data = await res.json();

                 totalPages = data.total_pages;

                 const southMovies = (data.results || []).filter(m => languages.includes(m.original_language));
                 allMovies = allMovies.concat(southMovies);

                 page++;
             } while (page <= totalPages);

             if (allMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto text-center">No upcoming Punjabi Indian movies found.</div>`;
                 return;
             }

             container.innerHTML = allMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 const releaseDate = new Date(movie.release_date);
                 const today = new Date();
                 const rating = movie.vote_average.toFixed(1);
                 const diffDays = Math.ceil((releaseDate - today) / (1000 * 60 * 60 * 24));

                 return `
            <div class="swiper-slide !w-[187px]">
                <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                    <div class="relative">
                        <div class="relative group">
                            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                            </div>
                            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-play text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="px-1 pt-2 flex-grow flex flex-col">
                        <div class="flex justify-between">
                            <a href="${baseUrl}/${movie.id}">
                                <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                            </a>
                            
                        </div>

                        
                        
                    </div>
                </div>
            </div>


            
            `;
             }).join('');

             new Swiper('.upcomingpunjabimoviesswiper', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });

         } catch (error) {
             console.error(error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4  text-center m-auto">Failed to load upcoming punjabi movies.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", fetchAllUpcomingPunjabiMovies);
 </script>


 <!-- trending webseries section -->
 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     async function loadTrendingWebSeries() {
         try {
             const container = document.getElementById('trendingwebseries');
             if (!container) return;

             container.innerHTML = `<div class="text-white text-center p-4">Loading trending web series...</div>`;

             // TMDB Network IDs (OTT Platforms in India)
             const allOttNetworkIds = '213|1024|2739|179|230|1238|1184|258|122|67';
             const languages = ["hi"];
             let allSeries = [];

                 const url = `https://api.themoviedb.org/3/discover/tv?api_key=${TMDB_API_KEY}&with_original_language=hi&region=IN&sort_by=first_air_date.desc&with_networks=213|1024|2739`;


                 const res = await fetch(url);
                 const data = await res.json();

                 if (data.results) allSeries = allSeries.concat(data.results);
           

             if (allSeries.length === 0) {
                 container.innerHTML = '<div class="!text-gray-900 dark:text-white p-4">No trending series found.</div>';
                 return;
             }

             // Remove duplicates and LIMIT TO TOP 10 series
             const uniqueSeries = Array.from(new Map(allSeries.map(s => [s.id, s])).values()).slice(0, 10); // <--- यहाँ limit 10 सेट की गई है

             // Debug in console
             console.log("Fetched Top 10 Series (Sorted by Rating):", uniqueSeries);

             container.innerHTML = uniqueSeries.map(series => {
                 const title = series.name || series.original_name || "Untitled";
                 const poster = series.poster_path ?
                     `https://image.tmdb.org/t/p/w500${series.poster_path}` :
                     'https://via.placeholder.com/500x750?text=No+Poster'; // Generic placeholder
                 const rating = series.vote_average != null ? series.vote_average.toFixed(1) : "N/A";

                 return `
        <div class="swiper-slide !w-[187px]">
          <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col shadow-lg">
            <div class="relative group">
              <div class="relative !h-[280px] overflow-hidden !rounded-md">
                <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
              </div>
              <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn opacity-0 group-hover:opacity-100 transition-opacity duration-300" data-id="${series.id}">
                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center bg-black/50">
                  <i class="fa-solid fa-play text-white text-2xl"></i>
                </div>
              </a>
            </div>

            <div class="px-2 pt-2 pb-3 text-sm flex flex-col justify-between flex-grow">
              <div class="flex justify-between items-start">
                <a href="#" title="${title}">
                  <p class="!text-[16px] font-semibold text-gray-900 dark:text-white leading-snug truncate line-clamp-2 w-[120px]">${title}</p>
                </a>
                <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1 ">
                  <i class="fa-solid fa-star !text-xs"></i>
                  <span class="font-bold !text-xs">${rating}/10</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        `;
             }).join('');

             // Initialize Swiper after content is loaded
             setTimeout(() => {
                 new Swiper('.trendingwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 2.5
                         },
                         768: {
                             slidesPerView: 3.5
                         },
                         1024: {
                             slidesPerView: 4.5
                         },
                         1280: {
                             // 5.5 slides might look better than 10 slides limit
                             slidesPerView: Math.min(uniqueSeries.length, 5.5)
                         }
                     }
                 });
             }, 50);

         } catch (err) {
             console.error("Error fetching trending series:", err);
             document.getElementById('trendingwebseries').innerHTML =
                 '<div class="!text-red-500 p-4 m-auto text-center w-full">Failed to load trending series. Please check your API key and network connection.</div>';
         }
     }


     document.addEventListener('DOMContentLoaded', loadTrendingWebSeries);
 </script>

 <!-- upcoming next web series  -->
 <!-- <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     function cardHTML(series) {
         const title = series.name || series.original_name || "Untitled";
         const poster = series.poster_path ?
             `https://image.tmdb.org/t/p/w500${series.poster_path}` :
             'https://masalameter.micodetest.com/assets/images/png.png';


         return `
      <div class="swiper-slide !w-[187px]">
        <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
          <div class="relative group">
            <div class="relative !h-[280px] overflow-hidden !rounded-md">
              <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
            </div>
            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${series.id}">
              <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                <i class="fa-solid fa-play text-white text-2xl"></i>
              </div>
            </a>
          </div>

          <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
            <div class="flex justify-between">
              <a href="${baseUrl}/${series.id}">
                <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[180px]">${title}</p>
              </a>
             
            </div>
          </div>
        </div>
      </div>`;
     }

     async function loadUpcomingWebSeries() {

         const today = new Date().toISOString().slice(0, 10);


         const ottNetworkIds = '213|1024|2739|179|230|1238|1184|258';

         try {
             const container = document.getElementById('upcomingwebseries');
             if (!container) return;

             container.innerHTML = `<div class="text-white text-center p-4">Loading upcoming Indian web series from OTT platforms...</div>`;


             const url = `https://api.themoviedb.org/3/discover/tv?api_key=${TMDB_API_KEY}` +
                 `&air_date.gte=${today}` +
                 `&sort_by=first_air_date.asc` +
                 `&with_original_language=hi` +
                 `&with_networks=${ottNetworkIds}`

             // URL Breakdown:
             // air_date.gte=${today}    -> Upcoming series (Air Date is today or later)
             // sort_by=first_air_date.asc -> Orders by release date (soonest first)
             // with_origin_country=IN   -> Filters results to only Indian content
             // with_networks=${ottNetworkIds} -> DYNAMICALLY filters to only shows from the specified OTT platforms

             console.log("Fetching URL:", url);

             const res = await fetch(url);
             if (!res.ok) {
                 throw new Error(`TMDB API returned status: ${res.status}`);
             }
             const data = await res.json();

             let allSeries = data.results || [];

             console.log("Total upcoming Indian OTT web series:", allSeries.length);
             if (allSeries.length === 0) {
                 container.innerHTML = '<div class="!text-gray-900 dark:text-white p-4">No upcoming Indian OTT series found.</div>';
                 return;
             }

             // Use the map function with your existing cardHTML utility
             container.innerHTML = allSeries.map(cardHTML).join('');

             // Initialize Swiper (same as before)
             setTimeout(() => {
                 new Swiper('.upcomingwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         }
                     }
                 });
             }, 50);

         } catch (err) {
             console.error("Error fetching upcoming series:", err);
             document.getElementById('upcomingwebseries').innerHTML =
                 '<div class="!text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load upcoming series.</div>';
         }
     }

     document.addEventListener('DOMContentLoaded', loadUpcomingWebSeries);
 </script> -->


 <!-- trending south  webseries -->
 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     async function loadTrendingsouthWebSeries() {
         try {
             const container = document.getElementById('trendingsouthwebseries');
             if (!container) return;

             container.innerHTML = `<div class="text-white text-center p-4">Loading trending web series...</div>`;

             const languages = ['ta', 'te', 'ml', 'kn'];
             let allSeries = [];

             for (const lang of languages) {
                 const url = `https://api.themoviedb.org/3/discover/tv?api_key=${TMDB_API_KEY}&with_original_language=${lang}&region=IN&sort_by=first_air_date.desc&with_networks=213|1024|2739`;
                 
                 const res = await fetch(url);
                 const data = await res.json();

                 if (data.results) allSeries = allSeries.concat(data.results);
             }

             if (allSeries.length === 0) {
                 container.innerHTML = '<div class="!text-gray-900 dark:text-white p-4">No trending series found.</div>';
                 return;
             }

             // Remove duplicates
             const uniqueSeries = Array.from(new Map(allSeries.map(s => [s.id, s])).values());

             // Debug in console
             console.log("Fetched Series:", uniqueSeries);

             container.innerHTML = uniqueSeries.map(series => {
                 const title = series.name || series.original_name || "Untitled";
                 const poster = series.poster_path ?
                     `https://image.tmdb.org/t/p/w500${series.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';
                 const rating = series.vote_average != null ? series.vote_average.toFixed(1) : "N/A"; // fixed

                 return `
        <div class="swiper-slide !w-[187px]">
          <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
            <div class="relative group">
              <div class="relative !h-[280px] overflow-hidden !rounded-md">
                <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
              </div>
              <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${series.id}">
                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                  <i class="fa-solid fa-play text-white text-2xl"></i>
                </div>
              </a>
            </div>

            <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
              <div class="flex justify-between">
                <a href="${baseUrl}/${series.id}">
                  <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p>
                </a>
                <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                  <i class="fa-solid fa-star !text-xs"></i>
                  <span class="font-bold !text-xs">${rating}/10</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
             }).join('');

             setTimeout(() => {
                 new Swiper('.trendingsouthwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         }
                     }
                 });
             }, 50);

         } catch (err) {
             console.error("Error fetching trending series:", err);
             document.getElementById('trendingwebseries').innerHTML =
                 '<div class="!text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load trending series.</div>';
         }
     }


     document.addEventListener('DOMContentLoaded', loadTrendingsouthWebSeries);
 </script>


 <!-- upcoming south web series  -->
 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     function cardHTML(series) {
         const title = series.name || series.original_name || "Untitled";
         const poster = series.poster_path ?
             `https://image.tmdb.org/t/p/w500${series.poster_path}` :
             'https://masalameter.micodetest.com/assets/images/png.png';
         const rating = series.vote_average != null ? series.vote_average.toFixed(1) : "N/A";

         return `
    <div class="swiper-slide !w-[187px]">
        <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
            <div class="relative group">
                <div class="relative !h-[280px] overflow-hidden !rounded-md">
                    <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                </div>
                <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${series.id}">
                    <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-play text-white text-2xl"></i>
                    </div>
                </a>
            </div>
            <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
                <div class="flex justify-between">
                    <a href="${baseUrl}/${series.id}">
                        <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p>
                    </a>
                    <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                        <i class="fa-solid fa-star !text-xs"></i>
                        <span class="font-bold !text-xs">${rating}/10</span>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
     }

     async function loadUpcomingsouthWebSeries() {
         const container = document.getElementById('upcomingsouthwebseries');
         if (!container) return;

         container.innerHTML = `<div class="text-white text-center p-4">Loading upcoming south web series...</div>`;

         const tomorrow = new Date();
         tomorrow.setDate(tomorrow.getDate() + 1);
         const tomorrowDate = tomorrow.toISOString().split('T')[0];

         try {
             // Fetch all upcoming South Indian TV series
              const url = `https://api.themoviedb.org/3/discover/tv?api_key=${API_KEY}` +
                `&with_original_language=ta|te|ml|kn` +
                `&with_origin_country=IN` + 
                `&sort_by=first_air_date.desc` + 
                `&first_air_date.gte=${tomorrowDate}` + 
                `&page=1`; 
             const res = await fetch(url);
             if (!res.ok) throw new Error(`TMDb API error: ${res.status}`);
             const data = await res.json();

             let allSeries = data.results || [];
             if (allSeries.length === 0) {
                 container.innerHTML = '<div class="text-gray-900 dark:text-white m-auto p-4">No upcoming south series found.</div>';
                 return;
             }

             // Remove duplicates by series ID
             const uniqueSeries = Array.from(new Map(allSeries.map(s => [s.id, s])).values());

             // Render series cards
             container.innerHTML = uniqueSeries.map(cardHTML).join('');

             // Initialize Swiper
             setTimeout(() => {
                 new Swiper('.upcomingsouthwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         }
                     }
                 });
             }, 50);

             console.log("Fetched upcoming south series:", uniqueSeries);

         } catch (err) {
             console.error(err);
             container.innerHTML = '<div class="text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load upcoming south series.</div>';
         }
     }

     document.addEventListener('DOMContentLoaded', loadUpcomingsouthWebSeries);
 </script>


 <!-- trending marathi web series -->
 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     async function loadTrendingmarathiWebSeries() {
         try {
             const container = document.getElementById('trendingmarathiwebseries');
             if (!container) return;

             container.innerHTML = `<div class="dark:text-white text-gray-900 text-center p-4 m-auto">Loading trending Marathi web series...</div>`;

             // Marathi language code = 'mr'
             const url = `https://api.themoviedb.org/3/discover/tv?api_key=${TMDB_API_KEY}&with_original_language=mr&region=IN&&sort_by=first_air_date.desc`;

             const res = await fetch(url);
             const data = await res.json();

             if (!data.results || data.results.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto">No trending Marathi web series found.</div>`;
                 return;
             }

             const uniqueSeries = Array.from(new Map(data.results.map(s => [s.id, s])).values());

             container.innerHTML = uniqueSeries.map(series => {
                 const title = series.name || series.original_name || "Untitled";
                 const poster = series.poster_path ?
                     `https://image.tmdb.org/t/p/w500${series.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';
                 const rating = series.vote_average != null ? series.vote_average.toFixed(1) : "N/A";

                 return `
          <div class="swiper-slide !w-[187px]">
            <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
              <div class="relative group">
                <div class="relative !h-[280px] overflow-hidden !rounded-md">
                  <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                </div>
                <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${series.id}">
                  <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-play text-white text-2xl"></i>
                  </div>
                </a>
              </div>

              <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
                <div class="flex justify-between">
                  <a href="${baseUrl}/${series.id}">
                    <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p>
                  </a>
                  <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                    <i class="fa-solid fa-star !text-xs"></i>
                    <span class="font-bold !text-xs">${rating}/10</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `;
             }).join('');

             setTimeout(() => {
                 new Swiper('.trendingmarathiwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         }
                     }
                 });
             }, 100);

         } catch (err) {
             console.error("Error fetching trending Marathi series:", err);
             document.getElementById('trendingmarathiwebseries').innerHTML =
                 '<div class="text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load trending Marathi series.</div>';
         }
     }

     document.addEventListener('DOMContentLoaded', loadTrendingmarathiWebSeries);
 </script>


 <!-- upcoming marathi web series -->
 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     async function loadUpcomingMarathiWebSeries() {
         try {
             const container = document.getElementById('upcomingmarathiwebseries');
             if (!container) return;

             container.innerHTML = `<div class="dark:text-white text-gray-900 text-center p-4 m-auto">Loading upcoming Marathi web series...</div>`;

             // Marathi TV shows (web series) - upcoming releases
             const today = new Date().toISOString().split('T')[0];
             const url = `https://api.themoviedb.org/3/discover/tv?api_key=${TMDB_API_KEY}&with_original_language=mr&region=IN&&sort_by=first_air_date.desc&first_air_date.gte=${today}&page=1`;



             const res = await fetch(url);
             const data = await res.json();

             if (!data.results || data.results.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto">No upcoming Marathi web series found.</div>`;
                 return;
             }

             const uniqueSeries = Array.from(new Map(data.results.map(s => [s.id, s])).values());

             container.innerHTML = uniqueSeries.map(series => {
                 const title = series.name || series.original_name || "Untitled";
                 const poster = series.poster_path ?
                     `https://image.tmdb.org/t/p/w500${series.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';
                 const rating = series.vote_average != null ? series.vote_average.toFixed(1) : "N/A";
                 const release = series.first_air_date ? formatDate(series.first_air_date) : "Coming Soon";

                 return `
          <div class="swiper-slide !w-[187px]">
            <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
              <div class="relative group">
                <div class="relative !h-[280px] overflow-hidden !rounded-md">
                  <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                </div>
                <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${series.id}">
                  <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-play text-white text-2xl"></i>
                  </div>
                </a>
              </div>

              <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
                <div class="flex justify-between">
                  <a href="${baseUrl}/${series.id}">
                    <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p>
                  </a>
                  <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                    <i class="fa-solid fa-star !text-xs"></i>
                    <span class="font-bold !text-xs">${rating}/10</span>
                  </div>
                </div>
                <p class="text-gray-700 dark:text-gray-400 text-xs mt-1">${release}</p>
              </div>
            </div>
          </div>
        `;
             }).join('');

             setTimeout(() => {
                 new Swiper('.upcomingmarathiwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         }
                     }
                 });
             }, 100);

         } catch (err) {
             console.error("Error fetching upcoming Marathi web series:", err);
             document.getElementById('upcomingmarathiwebseries').innerHTML =
                 '<div class="text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load upcoming Marathi web series.</div>';
         }
     }

     document.addEventListener('DOMContentLoaded', loadUpcomingMarathiWebSeries);
 </script>

 <!-- trending gujarati series -->

 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     async function loadTrendinggujaratiWebSeries() {
         try {
             const container = document.getElementById('trendinggujaratiwebseries');
             if (!container) return;

             container.innerHTML = `<div class="dark:text-white text-gray-900 text-center p-4 m-auto">Loading trending Gujarati web series...</div>`;

             // Marathi language code = 'mr'
             const url = `https://api.themoviedb.org/3/discover/tv?api_key=${TMDB_API_KEY}&with_original_language=gu&region=IN&&sort_by=first_air_date.desc`;

             const res = await fetch(url);
             const data = await res.json();

             if (!data.results || data.results.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto">No trending Gujarati web series found.</div>`;
                 return;
             }

             const uniqueSeries = Array.from(new Map(data.results.map(s => [s.id, s])).values());

             container.innerHTML = uniqueSeries.map(series => {
                 const title = series.name || series.original_name || "Untitled";
                 const poster = series.poster_path ?
                     `https://image.tmdb.org/t/p/w500${series.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';
                 const rating = series.vote_average != null ? series.vote_average.toFixed(1) : "N/A";

                 return `
          <div class="swiper-slide !w-[187px]">
            <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
              <div class="relative group">
                <div class="relative !h-[280px] overflow-hidden !rounded-md">
                  <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                </div>
                <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${series.id}">
                  <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-play text-white text-2xl"></i>
                  </div>
                </a>
              </div>

              <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
                <div class="flex justify-between">
                  <a href="${baseUrl}/${series.id}">
                    <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p>
                  </a>
                  <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                    <i class="fa-solid fa-star !text-xs"></i>
                    <span class="font-bold !text-xs">${rating}/10</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `;
             }).join('');

             setTimeout(() => {
                 new Swiper('.trendinggujaratiwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         }
                     }
                 });
             }, 100);

         } catch (err) {
             console.error("Error fetching trending Marathi series:", err);
             document.getElementById('trendinggujaratiwebseries').innerHTML =
                 '<div class="text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load trending Gujarati series.</div>';
         }
     }

     document.addEventListener('DOMContentLoaded', loadTrendinggujaratiWebSeries);
 </script>


 <!-- trending punjabi movies -->
 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     async function loadTrendingpunjabiWebSeries() {
         try {
             const container = document.getElementById('trendingpunjabiwebseries');
             if (!container) return;

             container.innerHTML = `<div class="dark:text-white text-gray-900 text-center p-4 m-auto">Loading trending Punjabi web series...</div>`;

             // Marathi language code = 'mr'
             const url = `https://api.themoviedb.org/3/discover/tv?api_key=${TMDB_API_KEY}&with_original_language=pa&region=IN&&sort_by=first_air_date.desc`;

             const res = await fetch(url);
             const data = await res.json();

             if (!data.results || data.results.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto">No trending Punjabi web series found.</div>`;
                 return;
             }

             const uniqueSeries = Array.from(new Map(data.results.map(s => [s.id, s])).values());

             container.innerHTML = uniqueSeries.map(series => {
                 const title = series.name || series.original_name || "Untitled";
                 const poster = series.poster_path ?
                     `https://image.tmdb.org/t/p/w500${series.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';
                 const rating = series.vote_average != null ? series.vote_average.toFixed(1) : "N/A";

                 return `
          <div class="swiper-slide !w-[187px]">
            <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
              <div class="relative group">
                <div class="relative !h-[280px] overflow-hidden !rounded-md">
                  <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                </div>
                <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${series.id}">
                  <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-play text-white text-2xl"></i>
                  </div>
                </a>
              </div>

              <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
                <div class="flex justify-between">
                  <a href="${baseUrl}/${series.id}">
                    <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p>
                  </a>
                  <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                    <i class="fa-solid fa-star !text-xs"></i>
                    <span class="font-bold !text-xs">${rating}/10</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `;
             }).join('');

             setTimeout(() => {
                 new Swiper('.trendingpunjabiwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         }
                     }
                 });
             }, 100);

         } catch (err) {
             console.error("Error fetching trending Marathi series:", err);
             document.getElementById('trendingpunjabiwebseries').innerHTML =
                 '<div class="text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load trending Punjabi series.</div>';
         }
     }

     document.addEventListener('DOMContentLoaded', loadTrendingpunjabiWebSeries);
 </script>




 <!-- upcoming punjabi web series -->
 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     async function loadUpcomingPunjabiWebSeries() {
         try {
             const container = document.getElementById('upcomingpunjabiwebseries');
             if (!container) return;

             container.innerHTML = `<div class="dark:text-white text-gray-900 text-center p-4 m-auto">Loading upcoming Punjabi web series...</div>`;

             // Punjabi language code = 'pa'
             const today = new Date().toISOString().split('T')[0];
             const url = `https://api.themoviedb.org/3/discover/tv?api_key=${TMDB_API_KEY}&with_original_language=pa&region=IN&&sort_by=first_air_date.desc&first_air_date.gte=${today}`;

             const res = await fetch(url);
             const data = await res.json();

             if (!data.results || data.results.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto">No upcoming Punjabi web series found.</div>`;
                 return;
             }

             const uniqueSeries = Array.from(new Map(data.results.map(s => [s.id, s])).values());

             container.innerHTML = uniqueSeries.map(series => {
                 const title = series.name || series.original_name || "Untitled";
                 const poster = series.poster_path ?
                     `https://image.tmdb.org/t/p/w500${series.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';
                 const rating = series.vote_average != null ? series.vote_average.toFixed(1) : "N/A";
                 const release = series.first_air_date ? formatDate(series.first_air_date) : "Coming Soon";

                 return `
          <div class="swiper-slide !w-[187px]">
            <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
              <div class="relative group">
                <div class="relative !h-[280px] overflow-hidden !rounded-md">
                  <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                  <span class="absolute top-2 left-2 bg-[#fe9a00] text-white text-xs px-2 py-1 rounded">Coming Soon</span>
                </div>
                <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${series.id}">
                  <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-play text-white text-2xl"></i>
                  </div>
                </a>
              </div>

              <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
                <div class="flex justify-between">
                  <a href="${baseUrl}/${series.id}">
                    <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p>
                  </a>
                  <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                    <i class="fa-solid fa-star !text-xs"></i>
                    <span class="font-bold !text-xs">${rating}/10</span>
                  </div>
                </div>
                <p class="text-gray-700 dark:text-gray-400 text-xs mt-1">${release}</p>
              </div>
            </div>
          </div>
        `;
             }).join('');

             setTimeout(() => {
                 new Swiper('.upcomingpunjabiwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         }
                     }
                 });
             }, 100);

         } catch (err) {
             console.error("Error fetching upcoming Punjabi web series:", err);
             document.getElementById('upcomingpunjabiwebseries').innerHTML =
                 '<div class="text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load upcoming Punjabi web series.</div>';
         }
     }

     document.addEventListener('DOMContentLoaded', loadUpcomingPunjabiWebSeries);
 </script>

 <!-- upcoming gujarati movies -->
 <script>
     function formatDate(dateStr) {
         const d = new Date(dateStr);
         return d.toLocaleDateString('en-IN', {
             day: 'numeric',
             month: 'long',
             year: 'numeric'
         });
     }

     async function loadUpcomingGujaratiWebSeries() {
         try {
             const container = document.getElementById('upcominggujaratiwebseries');
             if (!container) return;

             container.innerHTML = `<div class="dark:text-white text-gray-900 text-center p-4 m-auto">Loading upcoming Gujarati web series...</div>`;

             // Punjabi language code = 'pa'
             const today = new Date().toISOString().split('T')[0];
             const url = `https://api.themoviedb.org/3/discover/tv?api_key=${TMDB_API_KEY}&with_original_language=gu&region=IN&&sort_by=first_air_date.desc&first_air_date.gte=${today}`;

             const res = await fetch(url);
             const data = await res.json();

             if (!data.results || data.results.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto">No upcoming Gujarati web series found.</div>`;
                 return;
             }

             const uniqueSeries = Array.from(new Map(data.results.map(s => [s.id, s])).values());

             container.innerHTML = uniqueSeries.map(series => {
                 const title = series.name || series.original_name || "Untitled";
                 const poster = series.poster_path ?
                     `https://image.tmdb.org/t/p/w500${series.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';
                 const rating = series.vote_average != null ? series.vote_average.toFixed(1) : "N/A";
                 const release = series.first_air_date ? formatDate(series.first_air_date) : "Coming Soon";

                 return `
          <div class="swiper-slide !w-[187px]">
            <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
              <div class="relative group">
                <div class="relative !h-[280px] overflow-hidden !rounded-md">
                  <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                  <span class="absolute top-2 left-2 bg-[#fe9a00] text-white text-xs px-2 py-1 rounded">Coming Soon</span>
                </div>
                <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${series.id}">
                  <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-play text-white text-2xl"></i>
                  </div>
                </a>
              </div>

              <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
                <div class="flex justify-between">
                  <a href="${baseUrl}/${series.id}">
                    <p class="!text-[18px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p>
                  </a>
                  <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                    <i class="fa-solid fa-star !text-xs"></i>
                    <span class="font-bold !text-xs">${rating}/10</span>
                  </div>
                </div>
                <p class="text-gray-700 dark:text-gray-400 text-xs mt-1">${release}</p>
              </div>
            </div>
          </div>
        `;
             }).join('');

             setTimeout(() => {
                 new Swiper('.upcominggujaratiwebseries', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: '.swiper-button-next',
                         prevEl: '.swiper-button-prev'
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         }
                     }
                 });
             }, 100);

         } catch (err) {

             document.getElementById('upcominggujaratiwebseries').innerHTML =
                 '<div class="text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load upcoming Gujarati web series.</div>';
         }
     }

     document.addEventListener('DOMContentLoaded', loadUpcomingGujaratiWebSeries);
 </script>



 <!-- watch at home south movies -->
 <script>
     async function loadsouthottmovies() {
         const container = document.getElementById('watchathomeottsouth');
         container.innerHTML = `<div class="text-white p-4 m-auto text-center">Loading...</div>`;


         const filterLanguages = "te|ta|ml|kn";
         let allMovies = [];

         const uniqueMovieIds = new Set();
         let page = 1;

         const MAX_PAGES_TO_FETCH = 5;
         let totalPages = 1;

         try {
             do {

                 const url = `https://api.themoviedb.org/3/discover/movie?` +
                     `api_key=${TMDB_API_KEY}` +
                     `&sort_by=first_air_date.desc` +
                     `&watch_region=IN` +
                     `&with_watch_monetization_types=flatrate` +
                     `&with_original_language=${filterLanguages}` +
                     `&language=en-US` +
                     `&page=${page}`;

                 const res = await fetch(url);


                 if (!res.ok) {
                     throw new Error(`TMDB API call failed with status: ${res.status}`);
                 }

                 const data = await res.json();
                 totalPages = data.total_pages;


                 (data.results || []).forEach(movie => {

                     if (!uniqueMovieIds.has(movie.id)) {
                         uniqueMovieIds.add(movie.id);
                         allMovies.push(movie);
                     }
                 });

                 page++;
             } while (page <= totalPages && page <= MAX_PAGES_TO_FETCH);

             if (allMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto text-center">No streaming South Indian movies found.</div>`;
                 return;
             }


             container.innerHTML = allMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 const rating = movie.vote_average.toFixed(1);


                 return `
                <div class="swiper-slide !w-[187px]">
                    <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                        <div class="relative">
                            <div class="relative group">
                                <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                    <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                                </div>
                                <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                    <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-play text-white text-2xl"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="px-1 pt-2 flex-grow flex flex-col">
                            <div class="flex justify-between">
                                <a href="${baseUrl}/${movie.id}">
                                    <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                                </a>
                                <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                                <i class="fa-solid fa-star !text-xs"></i>
                                <span class="font-bold !text-xs">${rating}/10</span>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
             }).join('');




             new Swiper('.watchathomeottsouth', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });


         } catch (error) {
             console.error("Error loading South OTT movies:", error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load South Indian movies on OTT.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", loadsouthottmovies);
 </script>



 <!-- newest releases movie south-->
 <script>
     const container_south = document.getElementById("newestsouthrelases");

     async function loadNewestSouth() {
         // Display a loading message initially
         container_south.innerHTML = `<div class="text-center text-white py-6">Loading newest South Indian releases...</div>`;

         try {
             const today = new Date().toISOString().split("T")[0];
             const apiKey = TMDB_API_KEY; // Assuming TMDB_API_KEY is defined globally

             let movies = [];
             const uniqueMovieIds = new Set(); // Set to track unique movie IDs

             // Fetch a fixed number of pages (5 is a good balance for recency)
             const MAX_PAGES_TO_FETCH = 5;

             for (let page = 1; page <= MAX_PAGES_TO_FETCH; page++) {

                 const urlSouth = `https://api.themoviedb.org/3/discover/movie?` +
                     `api_key=${apiKey}` +
                     `&language=en-IN` +
                     `&region=IN` +
                     `&with_original_language=ta|te|ml|kn` + // Use '|' for 'OR' filter
                     `&sort_by=release_date.desc` +
                     `&release_date.lte=${today}` +
                     `&page=${page}`;

                 const res = await fetch(urlSouth);

                 if (!res.ok) {
                     throw new Error(`API fetch failed with status ${res.status}`);
                 }

                 const data = await res.json();


                 (data.results || []).forEach(movie => {

                     if (movie.poster_path && !uniqueMovieIds.has(movie.id)) {
                         uniqueMovieIds.add(movie.id);
                         movies.push(movie);
                     }
                 });


             }



             if (!movies.length) {

                 const fallbackUrl = `https://api.themoviedb.org/3/movie/now_playing?api_key=${apiKey}&language=en-IN&region=IN&page=1`;
                 const fallbackRes = await fetch(fallbackUrl);
                 const fallbackData = await fallbackRes.json();


                 (fallbackData.results || []).forEach(movie => {
                     if (["ta", "te", "ml", "kn"].includes(movie.original_language) && movie.poster_path && !uniqueMovieIds.has(movie.id)) {
                         uniqueMovieIds.add(movie.id);
                         movies.push(movie);
                     }
                 });
             }

             if (!movies.length) {
                 container_south.innerHTML = `<div class="text-center text-gray-900 dark:text-white py-6">No recent South Indian movie releases found.</div>`;
                 return;
             }


             container_south.innerHTML = movies.slice(0, 60).map(movie => {
                 const title = movie.title || "Untitled";
                 const rating = movie.vote_average?.toFixed(1) || "N/A";
                 const poster = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     "https://masalameter.micodetest.com/assets/images/png.png";

                 return `
                <div class="swiper-slide !w-[187px]">
                    <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                        <div class="relative group">
                            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                <img src="${poster}" alt="${title}" class="!h-[280px] !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                            </div>
                            <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-play text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>
                        <div class="px-1 pt-2 text-sm flex flex-col justify-between flex-grow">
                            <div class="flex justify-between">
                                <a href="movie-details/${movie.id}">
                                    <p class="!text-[16px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p>
                                </a>
                                <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                                    <i class="fa-solid fa-star !text-xs"></i>
                                    <span class="font-bold !text-xs">${rating}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
             }).join("");

             setTimeout(() => {
                 new Swiper(".newestsouthrelases", {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     navigation: {
                         nextEl: ".swiper-button-next",
                         prevEl: ".swiper-button-prev",
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1
                         },
                         768: {
                             slidesPerView: 3
                         },
                         1024: {
                             slidesPerView: 4
                         },
                         1280: {
                             slidesPerView: 5.5
                         },
                     },
                 });
             }, 200);


         } catch (err) {
             console.error(err);
             container_south.innerHTML = `<div class="text-center text-red-500 py-6">Failed to load newest South Indian movies. Check the console for API errors.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", loadNewestSouth);
 </script>



 <!-- marathi ott watch at home movies -->

 <script>
     async function loadmarathiottmovies() {
         const container = document.getElementById('watchathomeottmarathi');
         container.innerHTML = `<div class="text-white p-4 m-auto text-center">Loading...</div>`;


         const filterLanguages = "te|ta|ml|kn";
         let allMovies = [];

         const uniqueMovieIds = new Set();
         let page = 1;

         const MAX_PAGES_TO_FETCH = 5;
         let totalPages = 1;

         try {
             do {

                 const url = `https://api.themoviedb.org/3/discover/movie?` +
                     `api_key=${TMDB_API_KEY}` +
                     `&sort_by=release_date.desc` +
                     `&watch_region=IN` +
                     `&with_watch_monetization_types=flatrate` +
                     `&with_original_language=mr` +
                     `&language=en-US` +
                     `&page=${page}`;

                 const res = await fetch(url);


                 if (!res.ok) {
                     throw new Error(`TMDB API call failed with status: ${res.status}`);
                 }

                 const data = await res.json();
                 totalPages = data.total_pages;


                 (data.results || []).forEach(movie => {

                     if (!uniqueMovieIds.has(movie.id)) {
                         uniqueMovieIds.add(movie.id);
                         allMovies.push(movie);
                     }
                 });

                 page++;
             } while (page <= totalPages && page <= MAX_PAGES_TO_FETCH);

             if (allMovies.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 m-auto text-center">No streaming Marathi movies found.</div>`;
                 return;
             }


             container.innerHTML = allMovies.map(movie => {
                 const image = movie.poster_path ?
                     `https://image.tmdb.org/t/p/w500${movie.poster_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 const rating = movie.vote_average.toFixed(1);


                 return `
                <div class="swiper-slide !w-[187px]">
                    <div class="!w-[187px] bg-white dark:bg-black transition-all duration-300 rounded-xl overflow-hidden h-full flex flex-col">
                        <div class="relative">
                            <div class="relative group">
                                <div class="relative !h-[280px] overflow-hidden !rounded-md">
                                    <img src="${image}" alt="${movie.title}" class="!h-[280px] sm:h-[220px] !object-cover transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                                </div>
                                <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn" data-id="${movie.id}">
                                    <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-play text-white text-2xl"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="px-1 pt-2 flex-grow flex flex-col">
                            <div class="flex justify-between">
                                <a href="${baseUrl}/${movie.id}">
                                    <p class="text-gray-900 dark:text-white font-semibold !text-[18px] truncate w-[120px]">${movie.title}</p>
                                </a>
                                <div class="text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1">
                                <i class="fa-solid fa-star !text-xs"></i>
                                <span class="font-bold !text-xs">${rating}/10</span>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
             }).join('');




             new Swiper('.watchathomeottmarathi', {
                 slidesPerView: 1.1,
                 spaceBetween: 16,
                 loop: false,
                 navigation: {
                     nextEl: '.swiper-button-next',
                     prevEl: '.swiper-button-prev',
                 },
                 breakpoints: {
                     640: {
                         slidesPerView: 1.2
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 on: {
                     slideChange: function() {
                         const prev = document.querySelector('.swiper-button-prev');
                         const next = document.querySelector('.swiper-button-next');
                         prev.classList.toggle('disabled', this.isBeginning);
                         next.classList.toggle('disabled', this.isEnd);
                     },
                     afterInit: function() {
                         this.emit('slideChange');
                     }
                 }
             });


         } catch (error) {
             console.error("Error loading South OTT movies:", error);
             container.innerHTML = `<div class="!text-gray-900 dark:text-white p-4 m-auto text-center">Failed to load Marathi movies on OTT.</div>`;
         }
     }

     document.addEventListener("DOMContentLoaded", loadmarathiottmovies);
 </script>

















 <!-- newset bollywood -->

 <script>
     const container = document.getElementById('newest-bollywood-container');

     const getGenreNames = (genreIds, genresMap) => {
         return genreIds.map(id => genresMap[id]).filter(Boolean).join(', ') || 'Drama';
     };

     const fetchGenres = async () => {
         const res = await fetch(`https://api.themoviedb.org/3/genre/movie/list?api_key=${TMDB_API_KEY}&language=en-IN`);
         const data = await res.json();
         const genresMap = {};
         data.genres.forEach(g => genresMap[g.id] = g.name);
         return genresMap;
     };

     const loadNewestBollywood = async () => {
         const today = new Date().toISOString().split('T')[0];
         const genresMap = await fetchGenres();

         const url = `https://api.themoviedb.org/3/discover/movie?` +
             `api_key=${TMDB_API_KEY}&language=en-IN&region=IN` +
             `&with_original_language=hi&with_production_countries=IN` +
             `&sort_by=release_date.desc&release_date.lte=${today}&page=1`;


         try {
             const res = await fetch(url);
             const data = await res.json();
             const top3 = (data.results || []).slice(0, 6);

             if (!top3.length) {
                 container.innerHTML = '<div class="text-white">No recent Bollywood releases found.</div>';
                 return;
             }

             container.innerHTML = top3.map(movie => {
                 const title = movie.title || 'Untitled';
                 const rating = movie.vote_average?.toFixed(1) || '7.0';
                 const poster = movie.poster_path ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` : 'https://masalameter.micodetest.com/assets/images/png.png';
                 const genre = getGenreNames(movie.genre_ids, genresMap);
                 const runtime = '02h 00m'; // TMDb discover API doesn't return runtime

                 return `
     
      
      






       <!--  new code ui -->
      <div class="swiper-slide !w-[187px]">
        <div class=" !w-[187px] bg-white dark:bg-black   transition-all duration-300 rounded-xl  overflow-hidden h-full flex flex-col">
    
             <!-- Image & Actions -->
                    <div class="relative">
  


            <div class="relative group">


            <div class="relative !h-[280px] overflow-hidden !rounded-md">
                <img src="${poster}" alt="${title}" class=" !h-[280px]  !object-cover sm:h-[220px] transition-transform duration-300 hover:scale-[1.03] !rounded-md">
                </div>

                <!-- Play Button Overlay -->
           <a href="javascript:void(0)"
   class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full p-3 watch-trailer-btn"
  data-id="${movie.id}">

  <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
    <i class="fa-solid fa-play text-white text-2xl"></i>
  </div>

    </a>
                </div>

      <!-- Rating Badge -->
      

      <!-- Bookmark Button -->
     <!-- <button class="absolute top-3 right-[8px]  bg-black/70 hover:bg-black/90 p-2 rounded-md backdrop-blur-sm shadow-sm transition">
        <i class="fa fa-bookmark text-yellow-400 text-[13px]"></i>
      </button>-->
    </div>

    <!-- Content Section -->
    <div class="px-1 pt-2  text-sm flex flex-col justify-between flex-grow">
      <!-- Title -->
      <div class="flex justify-between">
     <a href="movie-details/${movie.id}"> <p class="!text-[16px] font-semibold text-gray-900 dark:text-white leading-snug truncate w-[120px]">${title}</p></a>
     <div class="  text-[#fe9a00] !text-xs px-2 py-1 rounded flex items-center gap-1 ">
        <i class="fa-solid fa-star !text-xs"></i>
        <span class="font-bold !text-xs">${rating}</span>
      </div>
      </div>


      <!-- Release & Genre -->
    

     

      <!-- Buttons -->
      
    </div>
        </div>
            </div>
      
      
      
      
      
      
      `;
             }).join('');
         } catch (err) {
             console.error(err);
             container.innerHTML = '<div class="text-red-500 p-4">Failed to load latest releases.</div>';
         }
     };

     loadNewestBollywood();
 </script>

 <script>
     const container = document.getElementById('top-artists-container');

     const fetchTopArtists = async () => {
         const url = `https://api.themoviedb.org/3/trending/person/week?api_key=${TMDB_API_KEY}`;

         try {
             const res = await fetch(url);
             const data = await res.json();
             const topArtists = data.results.slice(0, 12); // Get top 12

             container.innerHTML = topArtists.map(artist => {
                 const name = artist.name;
                 const role = artist.known_for_department || 'Celebrity';
                 const profilePath = artist.profile_path ?
                     `https://image.tmdb.org/t/p/w300${artist.profile_path}` :
                     'https://masalameter.micodetest.com/assets/images/png.png';

                 return `
          <div class="w-[calc(50%-8px)] sm:w-[calc(33.333%-10px)] md:w-[calc(25%-10px)] lg:w-[calc(16.666%-12px)] text-center group">
            <div class="relative mx-auto w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden ring-2 ring-yellow-400 group-hover:ring-4 transition-all duration-300">
              <img src="${profilePath}" alt="${name}" class="w-full h-full !object-cover" />
              <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center"></div>
            </div>
            <h5 class="mt-3 text-lg font-semibold group-hover:text-yellow-400 transition-colors">${name}</h5>
            <p class="text-sm text-gray-400">${role}</p>
          </div>
        `;
             }).join('');
         } catch (error) {
             console.error('Failed to fetch artists:', error);
             container.innerHTML = '<div class="text-red-500">Failed to load artists.</div>';
         }
     };

     fetchTopArtists();
 </script>

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const swiper = new Swiper('.reviewSwiper', {
             slidesPerView: 1,
             spaceBetween: 20,
             pagination: {
                 el: '.swiper-pagination',
                 clickable: true,
             },
             navigation: {
                 nextEl: '.swiper-button-next-review',
                 prevEl: '.swiper-button-prev-review',
             },
             breakpoints: {
                 640: {
                     slidesPerView: 2,
                 },
                 768: {
                     slidesPerView: 3,
                 },
                 1024: {
                     slidesPerView: 4,
                 },
             }
         });
     });
 </script>

 <script>
     const allSlides = document.querySelectorAll('.reel-slide');
     const modal = document.getElementById('videoModal');
     const reelContainer = document.getElementById('reelContainer');

     allSlides.forEach(slide => {
         slide.addEventListener('click', () => {

             reelContainer.innerHTML = '';
             document.body.classList.add('no-scroll');


             allSlides.forEach(s => {
                 const videoId = s.getAttribute('data-video');
                 const iframe = document.createElement('iframe');

                 iframe.src = `https://www.youtube.com/embed/${videoId}?controls=0&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1&fs=0&playsinline=1`;
                 iframe.allow = "autoplay; encrypted-media; gyroscope; picture-in-picture";
                 iframe.className = "snap-center w-[300px] sm:w-[340px] md:w-[380px] h-[560px] rounded-2xl shadow-xl";
                 iframe.frameBorder = "0";
                 iframe.loading = "lazy";

                 reelContainer.appendChild(iframe);
             });


             modal.classList.remove('hidden');
         });
     });

     function closeModal() {
         modal.classList.add('hidden');
         reelContainer.innerHTML = '';
         document.body.classList.remove('no-scroll');
     }
 </script>





 <!-- trending videos play pause -->
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const video = document.getElementById('reel-video');
         const controlBtn = document.querySelector('.video-control-btn');
         const playIcon = document.querySelector('.play-icon');
         const pauseIcon = document.querySelector('.pause-icon');


         controlBtn.addEventListener('click', function() {
             if (video.paused) {
                 video.play();
                 playIcon.classList.add('hidden');
                 pauseIcon.classList.remove('hidden');
             } else {
                 video.pause();
                 playIcon.classList.remove('hidden');
                 pauseIcon.classList.add('hidden');
             }
         });


         video.addEventListener('click', function() {
             if (video.paused) {
                 video.play();
                 playIcon.classList.add('hidden');
                 pauseIcon.classList.remove('hidden');
             } else {
                 video.pause();
                 playIcon.classList.remove('hidden');
                 pauseIcon.classList.add('hidden');
             }
         });

         // Show play icon when video ends
         video.addEventListener('ended', function() {
             playIcon.classList.remove('hidden');
             pauseIcon.classList.add('hidden');
         });
     });
 </script>
 <script>
     const platformMap = {
         'netflix': 8,
         'amazonprimevideo': 119,
         'hotstar': 122, // Disney+ Hotstar
         'jiohotstar': 122, // alias if you want
         'jio_cinema': 475,
         'mxplayer': 372,
         'sonyliv': 531,
         'zee5': 232,
         'voot': 283,
         'erosnow': 367,
         'hoichoi': 370,
         'hungamaplay': 206,
         'youtube': 192,
         'apple_tv': 350,
         'google_play': 3
     };
     let swipers = {};
     let loadedTabs = new Set(); // to track already loaded tabs

     function getGenreName(id) {
         const genreMap = {
             28: "Action",
             35: "Comedy",
             18: "Drama",
             10749: "Romance",
             27: "Horror",
             53: "Thriller",
             14: "Fantasy",
             878: "Sci-Fi"
         };
         return genreMap[id] || "Genre";
     }

     function generateMovieCard(movie) {
         const {
             title,
             name,
             poster_path,
             vote_average,
             release_date,
             genre_ids = []
         } = movie;

         const movieTitle = title || name || 'Untitled';
         const genreTags = genre_ids.slice(0, 3).map(id => `<span>${getGenreName(id)}</span>`).join('/');

         return `
        <div class="swiper-slide">
            <div class="bg-white dark:bg-black rounded-xl !w-[187px] overflow-hidden h-full flex flex-col">
                <div class="relative group">
                    <div class="relative !h-[280px] overflow-hidden !rounded-md">
                        <img src="https://image.tmdb.org/t/p/w500${poster_path}" 
                            alt="${movieTitle}" class="!h-[280px] !object-cover !rounded-md" />
                    </div>
                    <a href="javascript:void(0)" class="absolute z-20 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 watch-trailer-btn" data-id="${movie.id}">
                        <div class="border-4 border-white w-[60px] h-[60px] rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-play text-white text-2xl"></i>
                        </div>
                    </a>
                </div>
                <div class="px-2 py-2 flex-grow flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                    <a href="${baseUrl}/${movie.id}">
                        <p class="text-[16px] font-semibold text-gray-900 dark:text-white truncate w-[120px]">${movieTitle}</p></a>
                        <div class="text-[#FE9A00] text-xs px-2 py-1 flex items-center gap-1">
                            <i class="fa-solid fa-star text-xs"></i>
                            <span>${vote_average?.toFixed(1) || 'N/A'}/10</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
     }

     async function fetchAndRender(platform) {
         const movieListId = `movie-list-${platform}`;
         const container = document.getElementById(movieListId);

         if (!container) return;

         container.innerHTML = `<div class="text-white p-4">Loading...</div>`;

         try {
             const url = "{{ url('/get_movies') }}?platform=" + platform;
             const res = await fetch(url);
             const data = await res.json();

             if (!Array.isArray(data)) throw new Error("Invalid data");

             if (data.length === 0) {
                 container.innerHTML = `<div class="text-gray-900 dark:text-white p-4 text-center">No movies found on this platform.</div>`;
                 return;
             }

             container.innerHTML = data.map(generateMovieCard).join('');

             if (swipers[platform]) {
                 swipers[platform].destroy(true, true);
             }

             swipers[platform] = new Swiper(`#${platform} .tabs-streaming-slider`, {
                 slidesPerView: 2,
                 spaceBetween: 16,
                 breakpoints: {
                     320: {
                         slidesPerView: 1.5
                     },
                     375: {
                         slidesPerView: 1.8
                     },
                     480: {
                         slidesPerView: 2.5
                     },
                     640: {
                         slidesPerView: 2.5
                     },
                     768: {
                         slidesPerView: 3.5
                     },
                     1024: {
                         slidesPerView: 4.5
                     },
                     1280: {
                         slidesPerView: 5.5
                     },
                 },
                 navigation: {
                     nextEl: `#${platform} .swiper-button-next`,
                     prevEl: `#${platform} .swiper-button-prev`,
                 },
             });

         } catch (err) {
             console.error(err);
             container.innerHTML = `<div class="text-gray-900 dark:text-white p-4">Failed to load movies.</div>`;
         }
     }

     function loadTab(platform) {
         if (!loadedTabs.has(platform)) {
             fetchAndRender(platform);
             loadedTabs.add(platform);
         }
     }

     // Optional: load the first tab (netflix) by default
     document.addEventListener("DOMContentLoaded", () => {
         loadTab("netflix");
     });
 </script>


 <!-- trailer modal  -->
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const watchButtons = document.querySelectorAll('[data-id]');
         const modal = document.getElementById('trailerModal');
         const closeModal = document.getElementById('closeModal');
         const trailerIframe = document.getElementById('trailerIframe');


         const apiKey = "{{ env('TMDB_API_KEY') }}";

         watchButtons.forEach(button => {
             button.addEventListener('click', async function() {
                 const movieId = this.getAttribute('data-id');

                 try {

                     const res = await fetch(`https://api.themoviedb.org/3/movie/${movieId}/videos?api_key=${apiKey}&language=en-US`);
                     const data = await res.json();

                     const trailer = data.results.find(v => v.type === "Trailer" && v.site === "YouTube");

                     if (trailer) {
                         const trailerKey = trailer.key;

                         trailerIframe.src = `https://www.youtube.com/embed/${trailerKey}?autoplay=1&mute=1&loop=1&controls=0&modestbranding=1&rel=0&playlist=${trailerKey}&enablejsapi=1`;

                         modal.classList.remove('hidden');
                         modal.classList.add('flex');
                     } else {
                         alert("Trailer not available.");
                     }
                 } catch (error) {
                     console.error(error);
                     alert("Error loading trailer.");
                 }
             });
         });

         closeModal.addEventListener('click', function() {
             modal.classList.add('hidden');
             modal.classList.remove('flex');
             trailerIframe.src = '';
         });

         modal.addEventListener('click', function(e) {
             if (e.target === modal) {
                 modal.classList.add('hidden');
                 modal.classList.remove('flex');
                 trailerIframe.src = '';
             }
         });
     });
 </script>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const container = document.getElementById('newest-bollywood-container');
         const modal = document.getElementById('trailerModal');
         const closeModal = document.getElementById('closeModal');
         const trailerIframe = document.getElementById('trailerIframe');

         const TMDB_API_KEY = "{{ env('TMDB_API_KEY') }}";


         container.addEventListener('click', async function(e) {
             const btn = e.target.closest('.watch-trailer-btn');
             if (!btn) return;

             const movieId = btn.getAttribute('data-id');

             try {
                 const res = await fetch(`https://api.themoviedb.org/3/movie/${movieId}/videos?api_key=${TMDB_API_KEY}&language=en-US`);
                 const data = await res.json();

                 const trailer = data.results.find(v => v.type === "Trailer" && v.site === "YouTube");
                 if (trailer) {
                     const trailerKey = trailer.key;
                     trailerIframe.src = `https://www.youtube.com/embed/${trailerKey}?autoplay=1&mute=1&loop=1&controls=0&modestbranding=1&rel=0&playlist=${trailerKey}&enablejsapi=1`;
                     modal.classList.remove('hidden');
                     modal.classList.add('flex');
                 } else {
                     alert("Trailer not available.");
                 }
             } catch (error) {
                 console.error(error);
                 alert("Error loading trailer.");
             }
         });


         closeModal.addEventListener('click', function() {
             modal.classList.add('hidden');
             modal.classList.remove('flex');
             trailerIframe.src = '';
         });

         modal.addEventListener('click', function(e) {
             if (e.target === modal) {
                 modal.classList.add('hidden');
                 modal.classList.remove('flex');
                 trailerIframe.src = '';
             }
         });
     });
 </script>


 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const modal = document.getElementById('trailerModal');
         const closeModal = document.getElementById('closeModal');
         const trailerIframe = document.getElementById('trailerIframe');

         const TMDB_API_KEY = "{{ env('TMDB_API_KEY') }}";


         document.body.addEventListener('click', async function(e) {
             const btn = e.target.closest('.watch-trailer-btn');
             if (!btn) return;

             const movieId = btn.getAttribute('data-id');

             try {
                 const res = await fetch(`https://api.themoviedb.org/3/movie/${movieId}/videos?api_key=${TMDB_API_KEY}&language=en-US`);
                 const data = await res.json();

                 const trailer = data.results.find(v => v.type === "Trailer" && v.site === "YouTube");
                 if (trailer) {
                     const trailerKey = trailer.key;
                     trailerIframe.src = `https://www.youtube.com/embed/${trailerKey}?autoplay=1&mute=1&loop=1&controls=0&modestbranding=1&rel=0&playlist=${trailerKey}&enablejsapi=1`;
                     modal.classList.remove('hidden');
                     modal.classList.add('flex');
                 } else {
                     alert("Trailer not available.");
                 }
             } catch (error) {
                 console.error(error);
                 alert("Error loading trailer.");
             }
         });


         closeModal.addEventListener('click', function() {
             modal.classList.add('hidden');
             modal.classList.remove('flex');
             trailerIframe.src = '';
         });


         modal.addEventListener('click', function(e) {
             if (e.target === modal) {
                 modal.classList.add('hidden');
                 modal.classList.remove('flex');
                 trailerIframe.src = '';
             }
         });
     });
 </script>


 <!-- tabs which  shows the movie based on regiion  -->
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const mainButtons = document.querySelectorAll('[data-tab-btn]');
         const mainSections = document.querySelectorAll('.tab-section');

         const subButtons = document.querySelectorAll('[data-subtab-btn]');
         const subSections = document.querySelectorAll('.subtab-section');

         // Main Tabs
         window.openTab = function(tabName) {
             mainSections.forEach(sec => sec.classList.toggle('hidden', sec.id !== tabName));
             mainButtons.forEach(btn => {
                 if (btn.dataset.tabBtn === tabName) {
                     btn.classList.add('bg-[#fe9a00]', 'text-white');
                     btn.classList.remove('bg-gray-200', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');
                 } else {
                     btn.classList.remove('bg-[#fe9a00]', 'text-white');
                     btn.classList.add('bg-gray-200', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');
                 }
             });

             // Agar regional open ho to default Marathi dikhana
             if (tabName === 'regional') {
                 openSubTab('marathi');
             }
         };

         // Sub Tabs
         window.openSubTab = function(subTabName) {
             subSections.forEach(sec => sec.classList.toggle('hidden', sec.id !== subTabName));
             subButtons.forEach(btn => {
                 if (btn.dataset.subtabBtn === subTabName) {
                     btn.classList.add('bg-red-600', 'text-white');
                     btn.classList.remove('bg-gray-200', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');
                 } else {
                     btn.classList.remove('bg-red-600', 'text-white');
                     btn.classList.add('bg-gray-200', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');
                 }
             });
         };

         // Default Hindi open
         openTab('hindi');
     });
 </script>



 @include('include/footer')