<?php

namespace App\Http\Controllers;

use App\Records;
use App\Times;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $recordsData = Records::where('user_id', Auth::user()->id)->where('is_deleted', 0)->orderBy('seq', 'asc')->get();
        $records = [];
        $totalTime = 0;
        foreach ($recordsData as $record) {
            $payload = [
                'id' => $record->id,
                'desc' => $record->desc,
                'seq' => $record->seq,
                'totalTime' => 0,
                'times' => []
            ];

            $times = Times::where('record_id', $record->id)
                ->where('is_deleted', 0)
                ->orderBy('start_time', 'asc')
                ->get();
            foreach ($times as $time) {
                array_push($payload['times'], [
                    'id' => $time->id,
                    'start_time' => $time->start_time,
                    'end_time' => $time->end_time
                ]);

                $startTime = $time->start_time ? date_create($time->start_time)->getTimestamp() : time();
                $endTime = $time->end_time ? date_create($time->end_time)->getTimestamp() : time();
                $payload['totalTime'] += ($endTime - $startTime);
            }
            $totalTime += $payload['totalTime'];
            $payload['totalTime'] = $this->timeFormat($payload['totalTime']);
            array_push($records, $payload);
        }

        $totalTime = $this->timeFormat($totalTime);
        return view('record.index', ['records' => $records, 'totalTime' => $totalTime]);
    }

    private function timeFormat($time) {
        $hour = (int) ($time / 3600);
        $time = $time % 3600;
        $minute = (int) ($time / 60);
        $second = $time % 60;
        return "{$hour} hor {$minute} min {$second} sec";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('record.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();

        Records::create([
            'desc' => $data['desc'],
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('record.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $record = Records::find($id);
        return view('record.edit', ['id' => $id, 'desc' => $record->desc]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = $request->all();

        Records::find($id)
            ->update([
            'desc' => $data['desc'],
        ]);

        return redirect(route('record.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Records::find($id)->update([
            'is_deleted' => 1,
            'deleted_at' => Carbon::now()
        ]);

        return redirect(route('record.index'));
    }
}
