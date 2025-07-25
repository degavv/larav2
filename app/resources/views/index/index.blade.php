@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!Auth::guest())
            <div class="panel-body">
                <a href="{{ route('create') }}" class="btn btn-success">Upload photo</a>
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                Gallery
            </div>

            <div class="panel-body">

            </div>
        </div>
    </div>

@endsection