<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChartunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('comercial.piechart');
    }

    public function getDataChart1()
    {
        $data['cols'][0]['label']    = 'Topping';
        $data['cols'][0]['type']       = 'string';

        $data['cols'][1]['label']    = 'Slices';
        $data['cols'][1]['type']       = 'string';

        $data['rows'][0]['c'][0]['v']     = 'Mushrooms';
        $data['rows'][0]['c'][1]['v']     = 3;

        $data['rows'][1]['c'][0]['v']     = 'Onions';
        $data['rows'][1]['c'][1]['v']     = 1;

        $data['rows'][2]['c'][0]['v']     = 'Olives';
        $data['rows'][2]['c'][1]['v']     = 1;

        $data['rows'][3]['c'][0]['v']     = 'Zucchini';
        $data['rows'][3]['c'][1]['v']     = 1;

        $data['rows'][4]['c'][0]['v']     = 'Pepperoni';
        $data['rows'][4]['c'][1]['v']     = 5;

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
