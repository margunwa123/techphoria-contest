<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
  private $mainDir = "client.project.";
  private $mainRoute = "client.project.";

  public function __construct()
  {
    $this->middleware('auth')->only(['index', 'destroy']);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  Project $project
   * @return \Illuminate\Http\Response
   */
  public function show(Project $project)
  {
    return view($this->mainDir . "show", compact('project'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  Project $project
   * @return \Illuminate\Http\Response
   */
  public function destroy(Project $project)
  {
    $company = $project->company;
    $project->delete();
    return redirect(route('client.company.show', $company->id));
  }
}
