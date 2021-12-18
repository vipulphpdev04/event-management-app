<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\event;
use App\Models\Eventoccurnce;
use DataTables;


class EventManagementController extends Controller
{
    //Event list
    public function index(Request $request){
        if ($request->ajax()) {
            $data = event::select('*')->orderBy('id','DESC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" class="view btn btn-primary btn-sm">View</a>';
                           $btn .= '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                           $btn .= '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        //return response()->json( ['data' => $data] );
    }
    //Add event
    public function create(){
        return view('event.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'occurence' => 'required',
        ]);

        //echo '<pre>';print_r($request->all());exit;
        //Save event
        $data = new event;
        $data->title = $request->title;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        if($request->type1){
            $data->occurence = $request->type1. ' '.$request->type2;
        }else{
            $data->occurence = $request->type3. ' '.$request->type4.' '.$request->type5;
        }

        $data->save();

        //Event relation table store
        $Eventoccurnce = new Eventoccurnce();
        $Eventoccurnce->event_id = $data->id;
        $Eventoccurnce->recurrence_type = $data->occurence;
        $Eventoccurnce->type1 = $request->type1;
        $Eventoccurnce->type2 = $request->type2;
        $Eventoccurnce->type3 = $request->type3;
        $Eventoccurnce->save();

        return redirect('/')->with('success', 'Event added successfully !');
    }

}
