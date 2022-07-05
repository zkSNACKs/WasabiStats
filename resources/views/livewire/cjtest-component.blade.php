<div class="humanmonitor my-4 text-light">
    <p>Coinjoin test net lobbies</p>
    <div class="row">
        @if ($cjTest)
            @foreach ($cjTest as $key => $item)
                <div class="col-md-3 mb-3">
                    <div class="feature-box">
                        <p class="mb-0"><strong>roundId:</strong> <span class="text-blue">{{$item['roundId']}}</span></p>
                        <p class="mb-0"><strong>isBlameRound:</strong> <span class="text-pink">{{$item['isBlameRound']}}</span></p>
                        <p class="mb-0"><strong>inputCount:</strong> <span class="text-orange">{{$item['inputCount']}}</p>
                        <p class="mb-0"><strong>maxSuggestedAmount:</strong> <span class="text-orange">{{$item['maxSuggestedAmount']}}</span></p>
                        <p class="mb-0"><strong>inputRegistrationRemaining:</strong> <span class="text-blue">{{$item['inputRegistrationRemaining']}}</span></p>
                        <p><strong>phase:</strong> <span class="text-blue">{{$item['phase']}}</span></p>
                    </div>
                </div>
            @endforeach
        @endif
        @if ($nodata)
            {{$nodata}}
        @endif
    </div>

</div>
