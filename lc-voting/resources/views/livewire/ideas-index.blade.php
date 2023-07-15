<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="ideas-container space-y-6 my-6">
        @foreach($Ideas as $idea)

            <livewire:idea-index :key="$idea->id" :idea="$idea" :votesCount="$idea->votes_count" />
        @endforeach
        <div class="mt-3">
            {{$Ideas->links()}}
        </div>
    </div> <!-- end ideas-container -->

</div>
