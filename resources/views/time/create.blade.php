@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Form::open(['route' => ['time.store', $record_id]]) }}
        <div class="row">
            <div class="col-12">
                {{Form::label("start_time", "Start time: ")}}
            </div>
            <div class="col-12" style="margin: 15px;">
                {{Form::text("start_time", '0000-00-00 00:00:00', ['class' => 'form-control'])}}
            </div>
            <div class="col-12">
                {{Form::label("end_time", "End time: ")}}
            </div>
            <div class="col-12" style="margin: 15px;">
                {{Form::text("end_time", '0000-00-00 00:00:00', ['class' => 'form-control'])}}
            </div>
            <div class="col-12" style="margin: 15px;">
                {{Form::submit('Submit', ['class' => 'btn btn-primary', 'style' => 'cursor: pointer;'])}}
                <a href="{{ route('record.index') }}" class="btn btn-default" style="margin-left: 15px;">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
