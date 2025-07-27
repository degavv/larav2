@extends('layouts.app')

@section('content')
    <div class="panel-body">
        @include('common.errors')

        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="file" class="col-sm-3 control-label">Photo</label>

                <div class="col-sm-4">
                    <input type="file" name="file" id="file" class="form-control" accept="image/png, image/jpeg">
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