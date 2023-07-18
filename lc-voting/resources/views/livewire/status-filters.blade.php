<nav class="flex items-center justify-between text-xs">
    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="setStatus('all')" href="#" class="@if($status == 'all') border-b-4 pb-3 border-blue @endif">All Ideas (87)</a></li>
        <li><a wire:click.prevent="setStatus('Considering')" href="#"
               class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue
               @if($status == 'Considering') border-b-4 pb-3 border-blue @endif
               ">Considering
                (6)</a></li>
        <li><a wire:click.prevent="setStatus('InProgress')" href="#"
               class="text-gray-400 @if($status == 'InProgress') border-b-4 pb-3 border-blue @endif transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">In
                Progress (1)</a></li>
    </ul>

    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="setStatus('Implemented')" href="#"
               class="text-gray-400 transition duration-150 @if($status == 'Implemented') border-b-4 pb-3 border-blue @endif ease-in border-b-4 pb-3 hover:border-blue">Implemented
                (10)</a></li>
        <li><a wire:click.prevent="setStatus('Closed')" href="#"

               class=" @if($status == 'Closed') border-b-4 pb-3 border-blue @endif text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Closed
                (55)</a></li>
    </ul>
</nav>
