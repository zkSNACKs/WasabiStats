<div class="humanmonitor my-4 text-light">
    <p>HumanMonitor</p>
    <div class="row"> 
        @foreach ($humanMonitor as $key => $item)
        <div class="col-md-3">
            <div class="feature-box">
                <p class="mb-0">{{$key+1}}</p>
                <p class="mb-0">roundId: {{$item->roundId}}</p>
                <p class="mb-0">isBlameRound: {{$item->isBlameRound}}</p>
                <p class="mb-0">inputCount: {{$item->inputCount}}</p>
                <p class="mb-0">maxSuggestedAmount: {{$item->maxSuggestedAmount}}</p>
                <p class="mb-0">inputRegistrationRemaining: {{$item->inputRegistrationRemaining}}</p>
                <p class="mb-0">phase: {{$item->phase}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
