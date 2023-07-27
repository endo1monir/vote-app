<x-mail::message>
    # Introduction

    The idea : {{$idea->title}}
    the status changed to : {{$idea->status->name}}
    <x-mail::button :url="'{{route('idea.show',$idea)}}'">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
