<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Project;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;

class ArchiveController extends BaseController
{
    public function __construct()
    {
        $this->title = 'Archives';
        $this->resources = 'archives.';
        parent::__construct();
        $this->route = 'archives.';
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Archive::where('project_id', $id)->orderBy('id', 'DESC')->get();
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
        return redirect()->route('projects.show', $id);
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
            'name' => 'required|string'
        ]);

        $data = $request->all();
        $archives = new Archive($data);
        $archives->project_id = $request->project_url_Id;
        $archives->save();


        if ($request->file('files') && count($request->file('files')) > 0) {
            foreach ($request->file('files') as $document) {
                $name = round(microtime(true) * 1000) . '-' . rand(111, 999);
                $fileName = $name . '.' . $document->extension();
                $media = $archives->addMedia($document)
                    ->usingName($name)
                    ->usingFileName($fileName)
                    ->toMediaCollection('archives');
                $media->save();
            }
        }

        return redirect()->route('projects.show', $request->project_url_Id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function show(Archive $archive)
    {
        $info = $this->crudInfo();
        $info['item'] = $archive;
        return view($this->showResource(), $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param \App\Models\Archive $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Archive $archive)
    {
        $info = $this->crudInfo();
        $info['item'] = $archive;
        $info['projects'] = Project::all();
        $info['projectId'] = $archive->project_id;
        return view($this->editResource(), $info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $archive)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $data = $request->all();
        $archive->project_id = $request->project_url_Id;
        $archive->update($data);

        if ($request->file('files') && count($request->file('files')) > 0) {
            foreach ($request->file('files') as $document) {
                $name = round(microtime(true) * 1000) . '-' . rand(111, 999);
                $fileName = $name . '.' . $document->extension();
                $media = $archive->addMedia($document)
                    ->usingName($name)
                    ->usingFileName($fileName)
                    ->toMediaCollection('archives');
                $media->save();
            }
        }

        return redirect()->route('projects.show', $request->project_url_Id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archive $archive)
    {
        $archive->delete();
        return back();
    }

    function deleteFile(Request $request)
    {
        $media = Media::findOrFail($request->id);
        $media->delete();
        return response()->json(['status' => true, 'message' => 'Deleted Successfully']);
    }
}
