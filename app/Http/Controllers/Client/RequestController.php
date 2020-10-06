<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
  private $mainDir = "client.request.";
  private $mainRoute = "client.request.";

  private function validator(Request $request)
  {
    return $request->validate([
      ''
    ]);
  }

  public function __construct()
  {
    $this->middleware('auth')->only(['create', 'store', 'edit', 'update']);
  }

  public function index()
  {
    $companies = auth()->user()->companies();
    $requests = [];
    foreach ($companies as $company) {
      foreach ($company->requests as $request) {
        array_push($requests, $request);
      }
    }
    return view($this->mainDir . 'index', compact('requests'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view($this->mainDir . 'create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $requests = ModelsRequest::where();
    return redirect(route($this->mainRoute . 'show', compact('requests')));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(ModelsRequest $request)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(ModelsRequest $request)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ModelsRequest $clientRequest)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(ModelsRequest $request)
  {
    $company = $request->company;
    $request->delete();
    return redirect(route('client.company.show', $company->id));
  }
}
