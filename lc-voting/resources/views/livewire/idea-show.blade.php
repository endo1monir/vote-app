<div class="idea-and-buttons container">
    <div class="idea-container bg-white rounded-xl flex mt-4">
        <div class="flex flex-1 px-4 py-6">
            <div class="flex-none">
                <a href="#">
                    <img src="{{$idea->user->getAvatar()}}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="w-full mx-4">
                <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline">{{$idea->title}}</a>
                </h4>
                <div class="text-gray-600 mt-3">
                    @admin
                    @if($idea->spam_reports > 0)
                        <p class="text-red"> Spam count : {{$idea->spam_reports}} </p>
                    @endif
                    @endadmin
                    {{$idea->description}}
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="font-bold text-gray-900">
                            {{$idea->user->name}}
                        </div>
                        <div>&bull;</div>
                        <div>{{$idea->created_at->diffForHumans()}}</div>
                        <div>&bull;</div>
                        <div>{{$idea->category->name}}</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">{{$idea->comments()->count()}} Comments</div>
                    </div>
                    <div class="flex items-center space-x-2" x-data="{isOpen:false}">
                        <div
                            class="{{$idea->status->classes}} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{$idea->status->name}}</div>
                        <div class="relative">
                            <button
                                @click="isOpen=!isOpen"
                                class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                <svg fill="currentColor" width="24" height="6">
                                    <path
                                        d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                        style="color: rgba(163, 163, 163, .5)">
                                </svg>
                            </button>
                            <ul x-cloak x-show.transition.origin.top.left="isOpen" @keydown.escape.window="isOpen=false"
                                @click.away="isOpen=false"
                                class=" absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">

                                @can('update',$idea)
                                    <li><a @click="
                                isOpen=false
                                $dispatch('custom-show-edit-modal')" href="#"
                                           class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Edit
                                            Idea</a></li>
                                @endcan

                                @auth
                                    <li><a @click="$dispatch('custom-show-spam-modal')" href="#"
                                           class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark
                                            as
                                            Spam</a></li>
                                @endauth
                                    @admin
                                        <li><a @click="$dispatch('custom-show-not-spam-modal')" href="#"
                                               class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark
                                                as not
                                                Spam</a></li>
                                    @endadmin
                                @can('delete',$idea)
                                    <li><a @click="isOpen=false
                                $dispatch('custom-show-delete-modal')" href="#"
                                           class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete
                                            Post</a></li>
                                @endcan
                            </ul>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end idea-container -->

    <div class="buttons-container flex items-center justify-between mt-6">
        <div class="flex items-center space-x-4 ml-6">
            <livewire:add-comment :key="uniqid()" :idea="$idea"/>

                @admin
                    <livewire:set-status :idea="$idea"/>
                @endadmin

        </div>

        <div class="flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">

                <div class="text-xl leading-snug @if($hasVoted) text-blue @endif">{{$votesCounts}}</div>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>
            @if($hasVoted)
                <button
                    wire:click.prevent="vote"
                    type="button"
                    class="bg-green text-white w-32 h-11 text-xs bg-gray-200 font-semibold uppercase rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                >
                    <span>Voted</span>
                </button>
            @else
                <button
                    type="button"
                    wire:click.prevent="vote"
                    class="w-32 h-11 text-xs bg-gray-200 font-semibold uppercase rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                >
                    <span>Vote</span>
                </button>
            @endif

        </div>
    </div> <!-- end buttons-container -->
</div>
