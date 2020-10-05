<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    private $mainDir = "client.project.";
    private $mainRoute = "client.project.";

    public function __construct()
    {
        $this->middleware('auth')->only(['index','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return redirect(route($this->mainRoute . "show", Auth::id()));
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
      $project->delete();
      return redirect(route('client.project.index'));
    }
}
