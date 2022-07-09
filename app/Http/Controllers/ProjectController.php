<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectFormRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        return view('welcome')->with('projects', Project::all());
    }

    public function store(ProjectFormRequest $request) {
        $project = new Project();

        $project->url = $request->url;
        $project->image_url = $request->image_url;
        $project->title = $request->title;
        $project->subtitle = $request->subtitle;
        $project->description = $request->description;

        if($project->save()) {
            return redirect()->route('home')->with(['message' => 'Успешно додадивте проект!', 'status' => 'success']);
        } else {
            return redirect()->route('home')->with(['message' => 'Се случи проблем при додавање на проект!', 'status' => 'danger']);
        }
    }

    public function update(ProjectFormRequest $request, Project $project) {
        $project->url = $request->url;
        $project->image_url = $request->image_url;
        $project->title = $request->title;
        $project->subtitle = $request->subtitle;
        $project->description = $request->description;

        if($project->save()) {
            return redirect()->route('home')->with(['message' => 'Успешно изменивте проект!', 'status' => 'success']);
        } else {
            return redirect()->route('home')->with(['message' => 'Се случи проблем при изменување на проект!', 'status' => 'danger']);
        }
    }

    public function destroy(Project $project) {
        if ($project->delete()) {
            return redirect()->route('home')->with(['message' => 'Успешно избришавте проект!', 'status' => 'success']);
        } else {
            return redirect()->route('home')->with(['message' => 'Се случи проблем при бришење на проект!', 'status' => 'danger']);
        }
    }
}
