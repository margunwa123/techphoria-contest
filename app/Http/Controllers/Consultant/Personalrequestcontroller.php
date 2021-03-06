<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\PersonalRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalRequestController extends Controller
{
  private $mainDir = 'consultant.personal_request.';
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('checkrole:consultant');
  }

  public function index()
  {
    $personalRequests = PersonalRequest::where('consultant_id', Auth::user()->consultant->id)->get();
    return view($this->mainDir . 'index', compact('personalRequests'));
  }

  public function accept(Request $request, PersonalRequest $personalRequest)
  {
    Project::MakeProject($personalRequest->toArray());
    $personalRequest->delete();
    return redirect(route('consultant.project.index'));
  }

  public function reject(Request $request, PersonalRequest $personalRequest)
  {
    $personalRequest->delete();
    return redirect()->back();
  }
}
