@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-right">
                <a href="{{ route('record.create') }}" class="btn btn-primary">Create New Item</a>
            </div>
        </div>
        @foreach($records as $index => $record)
            <div class="row" style="margin-top: 5px;">
                <div class="col-lg-1" style="margin-top: 5px;">
                    @if(!count($record['times']) || $record['times'][count($record['times']) - 1]['end_time'])
                        <a href="{{ route('time.start', ['record_id' => $record['id']]) }}" class="btn btn-sm"
                           style="padding: 0;">
                            <i class="fa fa-play" aria-hidden="true" style="color: #5CB85C; font-size: 1em;"></i>
                        </a>
                    @elseif(!$record['times'][count($record['times']) - 1]['end_time'])
                        <a href="{{ route('time.end', ['id' => $record['times'][count($record['times']) - 1]['id']]) }}"
                           class="btn btn-sm" style="padding: 0;">
                            <i class="fa fa-stop" aria-hidden="true" style="color: #D9534F; font-size: 1em;"></i>
                        </a>
                    @endif

                    &nbsp;{{ $index + 1 }}.
                </div>

                <div class="col-lg-11">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 style="font-weight: bolder; font-size: 1.5em !important; margin: 5px 0;">{{ $record['desc'] }}</h2>
                            <div class="col-12 text-right">
                                <p style="display: inline;">Config: &nbsp;</p>
                                <a href="{{ route('time.create', ['record_id' => $record['id']]) }}" class="btn btn-sm"
                                   style="display: inline; padding: 0;">
                                    <i class="fa fa-clock-o" aria-hidden="true" style="color: #5BC0DE; font-size: 1em;"></i>
                                </a>

                                <a href="{{ route('record.edit', ['record_id' => $record['id']]) }}" class="btn btn-sm"
                                   style="margin-left: 10px; display: inline; padding: 0;">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #337AB7; font-size: 1em;"></i>
                                </a>

                                <a href="{{ route('record.destroy', ['record_id' => $record['id']]) }}" class="btn btn-sm"
                                   style="margin-left: 10px; display: inline; padding: 0;">
                                    <i class="fa fa-trash-o" aria-hidden="true" style="color: #D9534F; font-size: 1em;"></i>
                                </a>
                            </div>
                        </div>
                        @foreach($record['times'] as $time)
                            <div class="col-lg-12 text-right">
                                <p style="margin: 0;">{{ $time['start_time'] }} -
                                    @if($time['end_time'])
                                        {{ $time['end_time'] }}
                                    @else
                                        Not End Yet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endif
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('time.edit', ['id' => $time['id']]) }}" class="btn btn-sm"
                                       style="display: inline; padding: 0;">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"
                                           style="color: #337AB7; font-size: 1em;"></i>
                                    </a>
                                    <a href="{{ route('time.destroy', ['id' => $time['id']]) }}" class="btn btn-sm"
                                       style="margin-left: 10px; display: inline; padding: 0;">
                                        <i class="fa fa-trash-o" aria-hidden="true"
                                           style="color: #D9534F; font-size: 1em;"></i>
                                    </a>

                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
