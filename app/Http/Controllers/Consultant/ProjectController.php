<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

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
  public function index(Project $project)
  {
    return view($this->mainDir . 'index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  Project $project
   * @return \Illuminate\Http\Response
   */
  public function show(Project $project)
  {
    return view($this->mainDir . 'show');
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
    $project->delete();
    return redirect(route($this->mainRoute . 'index'));
  }
}
