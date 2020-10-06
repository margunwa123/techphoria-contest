<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
  private $mainDir = 'consultant.request.';
  private $mainRoute = 'consultant.request.';
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view($this->mainDir . 'index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  ModelsRequest $request
   * @return \Illuminate\Http\Response
   */
  public function show(ModelsRequest $request)
  {
    return view($this->mainDir . 'show', compact('request'));
  }

  /**
   * Accept a request
   *
   * @param  int  ModelsRequest $request
   * @return \Illuminate\Http\Response
   */
  public function accept(ModelsRequest $request)
  {
    return redirect(route('consultant.apply_request.create', compact('request')));
  }
  public function reject(ModelsRequest $request)
  {
    //
  }
}
