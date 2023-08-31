<div class="comment-container @if($comment->is_status_update) is-status-update  {{ 'status'.Str::kebab($comment->status->name) }} @endif  relative bg-white rounded-xl flex mt-4">
    <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{$comment->user->getAvatar()}}" alt="avatar"
                     class="w-14 h-14 rounded-xl">
            </a>
            @if($comment->user->isAdmin())
                <div class="text-center uppercase text-blue text-xxs font-bold mt-1">Admin</div>
            @endif
        </div>
        <div class="w-full mx-4">
            {{-- <h4 class="text-xl font-semibold">
                <a href="#" class="hover:underline">A random title can go here</a>
            </h4> --}}
            <div class="text-gray-600 mt-3 line-clamp-3">
                @admin
                @if($comment->spam_reports > 0)
                    <p class="text-red"> Spam count : {{$comment->spam_reports}} </p>
                @endif
                @endadmin
                @if($comment->is_status_update)
                    <h4 class="text-xl font-semibold mb-3">
                        status changed to " {{ $comment->status->name  }} "
                    </h4>
                @endif
                <div> {{$comment->body}}</div>

            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div
                        class="@if($comment->is_status_update) text-blue @endif font-bold text-gray-900">{{$comment->user->name}}</div>
                    <div>&bull;</div>
                    @if($comment->user_id === $ideaUserId)
                        <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
                        <div>&bull;</div>
                    @endif
                    <div>{{$comment->created_at->diffForHumans()}}</div>
                </div>
                @auth
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
                                @can('update',$comment)
                                    <li><a @click="Livewire.emit('setEditComment',{{$comment->id}})"
                                           class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Edit
                                            Comment </a></li>
                                @endcan
                                <li><a @click="isOpen=false
                                Livewire.emit('setMarkAsSpamComment',{{$comment->id}})" @c href="#"
                                       class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark
                                        as Spam</a></li>
                                <li><a @click="isOpen=false
                                Livewire.emit('setMarkAsNotSpamComment',{{$comment->id}})" @c href="#"
                                       class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark
                                        as Not Spam</a></li>

                                @can('delete',$comment)
                                    <li><a href="#" @click="Livewire.emit('setDeleteComment',{{$comment->id}})"
                                           class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete
                                            Comment</a></li>
                                @endcan
                            </ul>
                        </button>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
