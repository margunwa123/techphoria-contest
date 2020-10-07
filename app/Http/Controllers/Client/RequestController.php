<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Company;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
  private $mainDir = "client.request.";
  private $mainRoute = "client.request.";

  private function validator(Request $request)
  {
    return $request->validate([
      'company_id' => ['required', 'integer'],
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
    $companies = auth()->user()->companies;
    return view($this->mainDir . 'index', compact('companies'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $companies = auth()->user()->companies;
    if (count($companies) == 0) {
      return redirect(route('client.company.create'));
    };
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
    $modelRequest = new ModelsRequest($data);
    $modelRequest->save();
    return redirect(route($this->mainRoute . 'index'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $serverrequest, ModelsRequest $request)
  {
    $this->authorize('update', $request);
    $data = $this->validator($serverrequest);
    $request->update($data);
    return redirect(route($this->mainRoute . 'index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(ModelsRequest $request)
  {
    $this->authorize('delete', $request);
    $request->delete();
    return redirect(route('client.request.index'));
  }
}
