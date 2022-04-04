<div class="container">
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
    @livewire('search-component')
    <button class="my-5" wire:click.prevent="storeData()">Save data</button>
</div>
@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>


<script>
    var picker = new Pikaday({

        field: document.getElementById('from_date'),
        format: 'YYYY-MM-DD'
     });
</script>
<script>
    var picker = new Pikaday({

        field: document.getElementById('to_date'),
        format: 'YYYY-MM-DD'
     });
</script>


@endpush
