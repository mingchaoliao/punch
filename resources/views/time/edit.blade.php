@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Form::open(['route' => ['time.update', $time->id]]) }}
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-12">
                {{Form::label("start_time", "Start time: ")}}
            </div>
            <div class="col-12" style="margin: 15px;">
                {{Form::text("start_time", $time->start_time, ['class' => 'form-control'])}}
            </div>
            <div class="col-12">
                {{Form::label("end_time", "End time: ")}}
            </div>
            <div class="col-12" style="margin: 15px;">
                {{Form::text("end_time", $time->end_time, ['class' => 'form-control'])}}
            </div>
            <div class="col-12" style="margin: 15px;">
                {{Form::submit('Submit', ['class' => 'btn btn-primary', 'style' => 'cursor: pointer;'])}}
                <a href="{{ route('record.index') }}" class="btn btn-default" style="margin-left: 15px;">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
