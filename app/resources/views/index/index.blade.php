@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
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
                @foreach ($photos as $photo)
                    <div class="container">
                        <img style="max-width:80%" src="{{ asset('photos/' . $photo->name) }}" alt="{{ $photo->name }}">
                        <p>author: {{ $photo->user->name }}</p>
                        @if ($photo->user->id === Auth::user()->id)
                            <form action="{{ route('destroy', $photo->id) }}" method="post" class="form-inline pull-left"
                                style="margin-right: 5px;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                            <a class="btn btn-warning pull-left" href="{{ route('edit', $photo->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <div class="clearfix"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection