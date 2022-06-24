<div class="humanmonitor my-4 text-light">
    <p>HumanMonitor</p>

    @foreach ($humanMonitor as $key => $item)
        <div>
            <p class="mb-0">{{$key+1}}</p>
            <p class="mb-0">roundId: {{$item->roundId}}</p>
            <p class="mb-0">isBlameRound: {{$item->isBlameRound}}</p>
            <p class="mb-0">inputCount: {{$item->inputCount}}</p>
            <p class="mb-0">maxSuggestedAmount: {{$item->maxSuggestedAmount}}</p>
            <p class="mb-0">inputRegistrationRemaining: {{$item->inputRegistrationRemaining}}</p>
            <p class="mb-0">phase: {{$item->phase}}</p>
        </div>
    @endforeach
</div>
