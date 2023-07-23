<nav class="flex items-center justify-between text-xs">
    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="setStatus('All')" href="#" class="@if($status == 'all') border-b-4 pb-3 border-blue @endif">All Ideas ({{$statusCount['all_status']}})</a></li>
        <li><a wire:click.prevent="setStatus('Considering')" href="#"
               class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue
               @if($status == 'Considering') border-b-4 pb-3 border-blue @endif
               ">Considering
                ({{$statusCount['considering']}})</a></li>
        <li><a wire:click.prevent="setStatus('InProgress')" href="#"
               class="text-gray-400 @if($status == 'In Progress') border-b-4 pb-3 border-blue @endif transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">In
                Progress ({{$statusCount['in_progress']}})</a></li>
    </ul>

    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="setStatus('implemented')" href="#"
               class="text-gray-400 transition duration-150 @if($status == 'implemented') border-b-4 pb-3 border-blue @endif ease-in border-b-4 pb-3 hover:border-blue">Implemented
                ({{$statusCount['implemented']}})</a></li>
        <li><a wire:click.prevent="setStatus('Closed')" href="#"

               class=" @if($status == 'Closed') border-b-4 pb-3 border-blue @endif text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Closed
                ({{$statusCount['closed']}})</a></li>
    </ul>
</nav>
