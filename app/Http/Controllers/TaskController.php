<?php

namespace App\Http\Controllers;

use URL;
use DataTables;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Stevebauman\Location\Facades\Location;
use Worksome\IpGeolocation\Facades\IpGeolocation;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Task::select('*');
            return Datatables::of($data)
                ->addColumn('user_name', function ($row) {
                    return $row->user->name ?? '';
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.tasks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {

        // $timezones = timezone_identifiers_list();
        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'user_id'       => auth()->user()->id,
            // 'timezone'      => $location->timezone ?? 'UTC'
        ];

        $task = Task::create($data);
        if ($task) {

            return response()->json([
                'status_code' => Response::HTTP_OK,
                'success'     => TRUE,
                'error'       => FALSE,
                'data'        => [],
                'message'     => 'Created Successfully'
            ]);
        } else {
            return response()->json([
                'status_code'   => Response::HTTP_UNPROCESSABLE_ENTITY,
                'success'       => FALSE,
                'error'         => TRUE,
                'data'          => [],
                'message'       => "doesn't Created! Try again ",
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
