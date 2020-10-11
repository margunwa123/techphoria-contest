<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\CompletedProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
  private $mainDir = 'consultant.project.';
  private $mainRoute = 'consultant.project.';

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('checkrole:consultant');
  }
  /**
   * Display the specified resource.
   *
   * @param  int  Project $project
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $projects = Project::where('consultant_id', Auth::user()->consultant->id)->get();
    $completedProjects = CompletedProject::where('consultant_id', Auth::user()->consultant->id)->get();
    return view($this->mainDir . 'index', compact('projects', 'completedProjects'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  Project $project
   * @return \Illuminate\Http\Response
   */
  public function show(Project $project)
  {
    $this->authorize('view', $project);
    return view($this->mainDir . 'show', compact('project'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  Project $project
   * @return \Illuminate\Http\Response
   */
  public function destroy(Project $project)
  {
    $this->authorize('delete', $project);
    $completedProject = new CompletedProject($project->toArray());
    $completedProject->save();
    $project->delete();
    return redirect(route($this->mainRoute . 'index'));
  }

  public function cancel(Project $project)
  {
    $this->authorize('delete', $project);
    $project->delete();
    return redirect(route($this->mainRoute . 'index'));
  }
}
