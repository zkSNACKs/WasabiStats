
<header class="py-1 mb-4">
    <div class="container-fluid search">
        <form wire:submit.prevent="searchCount()">
            <div class="row align-items-center">
                <div class="col-2 col-md-auto">
                    <img src="/assets/img/logo.svg" class="logo" />
                </div>
                <div class="col-10 col-md-3">
                    <select id="type" class="form-select my-1" wire:model="cat">
                        <option>Choose version...</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('cat') <p class="text-danger">{{$message}}</p> @enderror
                </div>
                <div class="col-6 col-md-2">
                    <input type="text" id="from_date" class="form-control my-1" autocomplete="off" placeholder="First: {{$mindate->downloaded_at}}" wire:model.lazy="from_date">
                    @error('from_date') <p class="text-danger">{{$message}}</p> @enderror
                </div>
                <div class="col-6 col-md-2">
                    <input type="text" id="to_date" class="form-control my-1" autocomplete="off" placeholder="YYYY-MM-DD" wire:model.lazy="to_date">
                    @error('to_date') <p class="text-danger">{{$message}}</p> @enderror
                </div>
                <div class="col-12 col-md-auto">
                    <button col-auto="submit" class="btn btn-primary my-1 w-100">Search</button>
                </div>
                @if(isset($total))
                <div class="col text-end">
                    <div class="container text-small my-1">
                         Downloads: <strong>Total:</strong> {{$total}} |
                        <strong>By Date:</strong> {{$totalsearchdate}} |
                        <strong>Yesterday:</strong> {{$daily}}
                    </div>
                </div>
                @endif
            </div>
        </form>
    </div>
</header>
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
