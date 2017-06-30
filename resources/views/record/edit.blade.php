@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Form::open(['route' => ['record.update', $id]]) }}
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-12">
                {{Form::label("desc", "Description: ")}}
            </div>
            <div class="col-12" style="margin: 15px;">
                {{Form::textarea("desc", $desc, ['class' => 'form-control', 'style' => 'font-size: 1.5em;'])}}
            </div>
            <div class="col-12" style="margin: 15px;">
                {{Form::submit('Submit', ['class' => 'btn btn-primary', 'style' => 'cursor: pointer;'])}}
                <a href="{{ route('record.index') }}" class="btn btn-default" style="margin-left: 15px;">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
