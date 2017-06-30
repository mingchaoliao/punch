<?php

namespace App\Http\Controllers;

use App\Times;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param int  $record_id
     * @return \Illuminate\Http\Response
     */
    public function create($record_id) {
        return view('time.create', ['record_id' => $record_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $record_id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $record_id) {
        $data = $request->all();

        if(!$data['start_time'] || !$data['end_time']) {
            return back()->withInput();
        }

        Times::create([
            'record_id' => $record_id,
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
        ]);

        return redirect(route('record.index'));
    }

    /**
     * start a time for record
     *
     * @param  int  $record_id
     * @return \Illuminate\Http\Response
     */
    public function start($record_id)
    {
        Times::create([
            'record_id' => $record_id,
            'start_time' => Carbon::now()
        ]);

        return redirect(route('record.index'));
    }

    /**
     * start a time for record
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function end($id)
    {
        Times::find($id)->update([
            'end_time' => Carbon::now()
        ]);

        return redirect(route('record.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $time = Times::find($id);

        return view('time.edit', ['time' => $time]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        Times::find($id)
            ->update([
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time']
            ]);

        return redirect(route('record.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Times::find($id)->update([
            'is_deleted' => 1,
            'deleted_at' => Carbon::now()
        ]);

        return redirect(route('record.index'));
    }
}
