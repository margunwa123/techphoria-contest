<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\ApplyRequest;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyRequestController extends Controller
{
  private $mainDir = 'consultant.apply_request.';
  private $mainRoute = 'consultant.apply_request.';

  public function validator(Request $request)
  {
    return $request->validate([
      'title' => ['required', 'max:255'],
      'body' => ['required'],
      'request_id' => ['required', 'int']
    ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $applyRequests = ApplyRequest::where('consultant_id', Auth::user()->consultant->id)->get();
    return view($this->mainDir . 'index', compact('applyRequests'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $this->validator($request);
    $data['consultant_id'] =  Auth::user()->consultant->id;

    $applyRequest = new ApplyRequest($data);
    $applyRequest->save();
    return redirect(route($this->mainRoute . 'index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(ApplyRequest $applyRequest)
  {
    $this->authorize('delete', $applyRequest);

    $applyRequest->delete();

    return redirect(route($this->mainDir . 'index'));
  }
}
