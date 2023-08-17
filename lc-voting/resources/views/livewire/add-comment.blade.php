<div x-data="{ isOpen:false}"
     x-init="Livewire.on('commentAdded',()=>{
     isOpen=false
     });
             Livewire.hook('message.processed', (message, component) => {
              console.log(message)
              if(['gotoPage','nextPage','previousPage'].includes(message.updateQueue[0].method))
              {
const allComments=document.querySelectorAll('.comment-container')
const firstComment = allComments[0]
firstComment.scrollIntoView({behavior:'smooth'})
              }
             if (message.updateQueue[0].payload.event === 'commentAdded' && message.component.fingerprint.name === 'idea-comments'){
             const allComments=document.querySelectorAll('.comment-container')
const lastComment = allComments[allComments.length-1]
console.log(lastComment)
 lastComment.scrollIntoView({ behavior: 'smooth'})
 lastComment.classList.remove('bg-white')
                lastComment.classList.add('bg-green-50')
                setTimeout(() => {
                    lastComment.classList.remove('bg-green-50')
                    lastComment.classList.add('bg-white')
                }, 5000)
             }
             })
     "


     class="relative">
    <button
        @click="isOpen = !isOpen
        if(isOpen)
        $nextTick(()=>$refs.comment.focus())
        "
        type="button"
        class="flex items-center justify-center h-11 w-32 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
    >
        Reply
    </button>
    <div x-cloak x-show="isOpen" @click.away="isOpen = false" @keydown.esc="isOpen = false"
         x-transition.origin.top.left.duration.500ms
         class="absolute z-10 w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
        @auth
            <form wire:submit.prevent="AddComment" action="#" class="space-y-4 px-4 py-6">
                <div>
                            <textarea x-ref="comment" wire:model.defer="comment" name="comment" id="comment" cols="30"
                                      rows="4"
                                      class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                                      placeholder="Go ahead, don't be shy. Share your thoughts..."></textarea>
                </div>

                <div class="flex items-center space-x-3">
                    <button
                        type="submit"
                        class="flex items-center justify-center h-11 w-1/2 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                    >
                        Post Comment
                    </button>
                    <button
                        type="button"
                        class="flex items-center justify-center w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                    >
                        <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        <span class="ml-1">Attach</span>
                    </button>
                </div>

            </form>
        @else
            <div class="px-4 py-6">
                <p class="font-normal">Please login or create an account to post a comment.</p>
                <div class="flex items-center space-x-3 mt-8">
                    <a
                        href="{{ route('login') }}"
                        class="w-1/2 h-11 text-sm text-center bg-blue text-white font-semibold rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                    >
                        Sign Up
                    </a>
                </div>
            </div>
        @endauth
    </div>
</div>
