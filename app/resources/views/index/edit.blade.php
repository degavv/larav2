@extends('layouts.app')

@section('content')
    <div class="panel-body">
        @include('common.errors')

        <form action="{{ route('update', [$photo->id]) }}" method="POST" enctype="multipart/form-data"
            class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="file" class="col-sm-3 control-label">Update Photo</label>

                <div class="col-sm-4">
                    <input type="file" name="file" id="file" class="form-control" accept="image/png, image/jpeg">
                    <div>
                        <h3>Current photo</h3>
                        <img src="{{ asset('photos/' . $photo->name) }}" alt="$photo->name">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Upload Photo
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection