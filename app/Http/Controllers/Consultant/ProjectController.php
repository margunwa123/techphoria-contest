<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  /**
   * Display the specified resource.
   *
   * @param  int  Project $project
   * @return \Illuminate\Http\Response
   */
  public function index(Project $project)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  Project $project
   * @return \Illuminate\Http\Response
   */
  public function show(Project $project)
  {
    //
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
    //
  }
}
