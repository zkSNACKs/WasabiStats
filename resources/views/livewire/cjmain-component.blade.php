<div class="humanmonitor my-4 text-light">
    <p>Coinjoin main net lobbies</p>
    <div class="row">
        @if ($cjMain)
            @foreach ($cjMain as $key => $item)
                <div class="col-6 col-sm col-xl-3 mb-3">
                    <div class="feature-box @if(!$item['isBlameRound']) active @endif">
                        <p class="mb-0"><strong>Round ID:</strong> <span class="text-blue">{{$item['roundId']}}</span></p>
                        <p class="mb-0">
                        @if($item['isBlameRound'])
                            <span class="text-pink">Blame round</span>
                        @else
                            <span class="text-pink">New round</span>
                        @endif
                        </p>
                        <p class="mb-0"><strong>Input count:</strong> <span class="text-orange">{{$item['inputCount']}}</p>
                        <p class="mb-0"><strong>Max suggested amount:</strong> <span class="text-orange">{{$item['maxSuggestedAmount']}}</span></p>
                        @if (isset($item['allowedInputAmounts']))
                            <p class="mb-0"><strong>Min input amount:</strong> <span class="text-orange">{{$item['allowedInputAmounts']['min']}}</span></p>
                        @endif
                        @if ($item['phase'] === 'InputRegistration')
                            <p class="mb-0"><strong>Next phase in:</strong> <span class="text-blue">{{$item['inputRegistrationRemaining']}}</span></p>
                        @endif
                        <p><strong>Phase:</strong> <span class="text-blue">{{$item['phase']}}</span></p>
                    </div>
                </div>
            @endforeach
        @endif
        @if ($nodata)
            {{$nodata}}
        @endif
    </div>

</div>
