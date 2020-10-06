<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Company;
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
      'company_id' => ['required'],
      'finance_type' => ['required', 'max:255'],
      'description' => ['required'],
      'fee' => ['required', 'integer', 'min:0'],
      'criteria' => ['required']
    ]);
  }

  public function __construct()
  {
    $this->middleware('auth')->except('show');
    $this->middleware('checkrole:client')->except('show');
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
    $companies = auth()->user()->companies;
    return view($this->mainDir . 'create', compact('companies'));
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
    $company = Company::find($data['company_id']);
    $this->authorize('create', $company);
    return redirect(route($this->mainRoute . 'show', compact('request')));
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
