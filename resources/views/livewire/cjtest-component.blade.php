<div class="humanmonitor my-4 text-light">
    <p>Coinjoin test net lobbies</p>
    <div class="row">
        @if ($cjTest)
            @foreach ($cjTest as $key => $item)
                <div class="col-md-3 mb-3">
                    <div class="feature-box">
                        <p class="mb-0"><strong>roundId:</strong> {{$item['roundId']}}</p>
                        <p class="mb-0"><strong>isBlameRound:</strong> {{$item['isBlameRound']}}</p>
                        <p class="mb-0"><strong>inputCount:</strong> {{$item['inputCount']}}</p>
                        <p class="mb-0"><strong>maxSuggestedAmount:</strong> {{$item['maxSuggestedAmount']}}</p>
                        <p class="mb-0"><strong>inputRegistrationRemaining:</strong> {{$item['inputRegistrationRemaining']}}</p>
                        <p><strong>phase:</strong> {{$item['phase']}}</p>
                    </div>
                </div>
            @endforeach
        @endif
        @if ($nodata)
            {{$nodata}}
        @endif
    </div>

</div>
