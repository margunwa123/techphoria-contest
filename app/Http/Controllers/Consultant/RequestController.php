<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  ModelsRequest $request
   * @return \Illuminate\Http\Response
   */
  public function show(ModelsRequest $request)
  {
    //
  }

  /**
   * Accept a request
   *
   * @param  int  ModelsRequest $request
   * @return \Illuminate\Http\Response
   */
  public function accept(ModelsRequest $request)
  {
    //
  }
  public function reject(ModelsRequest $request)
  {
    //
  }
}
