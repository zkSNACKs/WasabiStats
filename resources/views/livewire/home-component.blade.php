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

<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/pikaday.js')}}"></script>


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
