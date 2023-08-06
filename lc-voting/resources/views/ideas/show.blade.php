<x-app-layout>
    <div>
        <a href="{{$backUrl}}" class="flex items-center font-semibold hover:underline">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="ml-2">All ideas</span>
        </a>
    </div>

    <livewire:idea-show :idea="$idea" :votesCounts="$votesCounts"/>

    <div

    >
        <button>
            Toggle
        </button>
        <div
            x-cloak
            x-data="{isOpen:true}"
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-8"
            @keydown.escape.window="isOpen=false"
            class="z-20 flex justify-between max-w-xs sm:max-w-sm w-full fixed bottom-0 right-0 bg-white rounded-xl shadow-lg border px-4 py-5 mx-2 sm:mx-6 my-8"
        >
            <div class="flex items-center">
                <svg class="text-green h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="font-semibold text-gray-500 text-sm sm:text-base ml-2">Idea was updated successfully!</div>
            </div>
            <button @click="isOpen = false" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <x-modals-container :idea="$idea"/>
    <div class="comments-container relative space-y-6 ml-22 pt-4 my-8 mt-1">
        <div class="comment-container relative bg-white rounded-xl flex mt-4">
            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar"
                             class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full mx-4">
                    {{-- <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">A random title can go here</a>
                    </h4> --}}
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum dolor sit amet consectetur.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div x-data="{isOpen:false}" class="flex items-center space-x-2">
                            <button @click="isOpen=!isOpen"
                                    class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                <svg fill="currentColor" width="24" height="6">
                                    <path
                                        d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                        style="color: rgba(163, 163, 163, .5)">
                                </svg>
                                <ul x-cloak x-show.transition.origin.top.left="isOpen"
                                    keydown.escape.window="isOpen=false" @click.away="isOpen=false"
                                    class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                    <li><a href="#"
                                           class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark
                                            as Spam</a></li>
                                    <li><a href="#"
                                           class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete
                                            Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end comment-container -->
        {{--        <div class="is-admin comment-container relative bg-white rounded-xl flex mt-4">--}}
        {{--            <div class="flex flex-1 px-4 py-6">--}}
        {{--                <div class="flex-none">--}}
        {{--                    <a href="#">--}}
        {{--                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">--}}
        {{--                    </a>--}}
        {{--                    <div class="text-center uppercase text-blue text-xxs font-bold mt-1">Admin</div>--}}
        {{--                </div>--}}
        {{--                <div class="w-full mx-4">--}}
        {{--                    <h4 class="text-xl font-semibold">--}}
        {{--                        <a href="#" class="hover:underline">Status Changed to "Under Construction"</a>--}}
        {{--                    </h4>--}}
        {{--                    <div class="text-gray-600 mt-3 line-clamp-3">--}}
        {{--                        Lorem ipsum dolor sit amet consectetur.--}}
        {{--                    </div>--}}

        {{--                    <div class="flex items-center justify-between mt-6">--}}
        {{--                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">--}}
        {{--                            <div class="font-bold text-blue">Andrea</div>--}}
        {{--                            <div>&bull;</div>--}}
        {{--                            <div>10 hours ago</div>--}}
        {{--                        </div>--}}
        {{--                        <div class="flex items-center space-x-2">--}}
        {{--                            <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">--}}
        {{--                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>--}}
        {{--                                <ul class="hidden absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">--}}
        {{--                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>--}}
        {{--                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>--}}
        {{--                                </ul>--}}
        {{--                            </button>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div> <!-- end comment-container -->--}}
        {{--        <div class="comment-container relative bg-white rounded-xl flex mt-4">--}}
        {{--            <div class="flex flex-1 px-4 py-6">--}}
        {{--                <div class="flex-none">--}}
        {{--                    <a href="#">--}}
        {{--                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=4" alt="avatar" class="w-14 h-14 rounded-xl">--}}
        {{--                    </a>--}}
        {{--                </div>--}}
        {{--                <div class="w-full mx-4">--}}
        {{--                    --}}{{-- <h4 class="text-xl font-semibold">--}}
        {{--                        <a href="#" class="hover:underline">A random title can go here</a>--}}
        {{--                    </h4> --}}
        {{--                    <div class="text-gray-600 mt-3 line-clamp-3">--}}
        {{--                        Lorem ipsum dolor sit amet consectetur.--}}
        {{--                    </div>--}}

        {{--                    <div class="flex items-center justify-between mt-6">--}}
        {{--                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">--}}
        {{--                            <div class="font-bold text-gray-900">John Doe</div>--}}
        {{--                            <div>&bull;</div>--}}
        {{--                            <div>10 hours ago</div>--}}
        {{--                        </div>--}}
        {{--                        <div class="flex items-center space-x-2">--}}
        {{--                            <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">--}}
        {{--                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>--}}
        {{--                                <ul class="hidden absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">--}}
        {{--                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>--}}
        {{--                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>--}}
        {{--                                </ul>--}}
        {{--                            </button>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div> <!-- end comments-container -->
</x-app-layout>
