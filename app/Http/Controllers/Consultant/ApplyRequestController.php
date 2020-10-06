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
    $companies = Auth::user()->companies;
    return view($this->mainDir . 'index', compact('companies'));
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

    Auth::user()->companies->create($data);

    return redirect(route($this->mainRoute . 'index'));
  }

  public function create(Request $request, ModelsRequest $consultantRequest)
  {
    return view($this->mainDir . 'create');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(ApplyRequest $applyRequest)
  {
    return view($this->mainDir . 'edit', compact('applyRequest'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ApplyRequest $applyRequest)
  {
    $data = $this->validator($request);

    $applyRequest->update($data);

    return redirect(route($this->mainRoute . 'show', $applyRequest->id));
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(ApplyRequest $applyRequest)
  {
    $applyRequest->delete();

    return redirect($this->mainDir . 'index');
  }
}
