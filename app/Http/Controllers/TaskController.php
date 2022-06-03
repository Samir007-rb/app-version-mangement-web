<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TaskController extends BaseController
{
    public function __construct()
    {
        $this->title = 'Tasks';
        $this->resources = 'tasks.';
        parent::__construct();
        $this->route = 'tasks.';
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Task::where('project_id', $id)->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('templates.index_actions', [
                        'id' => $data->id, 'route' => $this->route
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return redirect()->route('projects.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $info = $this->crudInfo();
        $info['projects'] = Project::all();
        $info['projectId'] = $request->project_id;
        return view($this->createResource(), $info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        $data = $request->all();
        $tasks = new Task($data);
        $tasks->project_id = $request->project_url_Id;
        $tasks->save();

        return redirect()->route('projects.show', $request->project_url_Id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $info = $this->crudInfo();
        $info['item'] = $task;
        return view($this->showResource(), $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $info = $this->crudInfo();
        $info['item'] = $task;
        $info['projects'] = Project::all();
        $info['projectId'] = $task->project_id;
        return view($this->editResource(), $info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        $data = $request->all();
        $task->project_id = $request->project_url_Id;
        $task->update($data);

        return redirect()->route('projects.show', $request->project_url_Id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }
}
