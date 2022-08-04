<div class="setting">
    <div class="container my-4">
        <h2>Settings</h2>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
    @if ($data)
        <div class="container">
            <p>Current default version: {{$data->version_id}} - {{$data->categories->name}}</p>
            <form wire:submit.prevent="saveSettings()">
                <div class="setting-form">
                    <div class="col-10 col-md-3">
                        <select id="type" class="form-select my-1" wire:model="version_id">
                            <option>Choose version...</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('version_id') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                    <div class="col-12 col-md-auto">
                        <button col-auto="submit" class="btn btn-primary my-1 w-100">Save</button>
                    </div>
                </div>
            </form>
            <hr>
        </div>
    @else
        <div class="container">
            <p>Choose default version!</p>
            <form wire:submit.prevent="setSetting()">
                <div class="setting-form">
                    <div class="col-10 col-md-3">
                        <select id="type" class="form-select my-1" wire:model="version_id">
                            <option>Choose version...</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('version_id') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                    <div class="col-12 col-md-auto">
                        <button col-auto="submit" class="btn btn-primary my-1 w-100">Save</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
</div>
