@extends('layouts.app')

@section('js')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: '70vh',                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true                  // set focus to editable area after initializing summernote
            });

            $('.submit').click(function(e) {
                e.preventDefault();
                $('#desc').val($('#summernote').summernote('code'));
                $('form').submit();
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        {{ Form::open(['route' => 'record.store']) }}
        <div class="row">
            <div class="col-12">
                {{Form::label("desc", "Description: ")}}
            </div>
            <div class="col-12" style="margin: 15px;">
                <div id="summernote"></div>
                {{Form::hidden("desc", '')}}
            </div>
            <div class="col-12" style="margin: 15px;">
                {{Form::submit('Submit', ['class' => 'btn btn-primary submit', 'style' => 'cursor: pointer;'])}}
                <a href="{{ route('record.index') }}" class="btn btn-default" style="margin-left: 15px;">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
