<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Consultant;
use App\Models\PersonalRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalRequestController extends Controller
{
  private $mainDir = 'client.personal_request.';
  private $mainRoute = 'client.personal_request.';

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('checkrole:client');
  }

  public function validator(Request $personalRequest)
  {
    return $personalRequest->validate([
      'consultant_id' => ['required', 'integer'],
      'company_id' => ['required', 'integer'],
      'finance_type' => ['required', 'max:50'],
      'description' => ['required'],
      'fee' => ['required', 'integer', 'min:0', 'max:1000000000000'],
    ]);
  }

  public function index()
  {
    $companies = Auth::user()->companies;
    return view($this->mainDir . 'index', compact('companies'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $this->authorize('create', PersonalRequest::class);
    $consultant = Consultant::find($request->get('consultant'));
    $companies = $request->user()->companies;
    return view($this->mainDir . 'create', compact('consultant', 'companies'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $personalRequest
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->authorize('create', PersonalRequest::class);
    $data = $this->validator($request);

    $personalRequest = new PersonalRequest($data);
    $personalRequest->save();

    return redirect(route($this->mainRoute . 'index'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $personalRequest
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, PersonalRequest $personalRequest)
  {
    $this->authorize('update', $personalRequest);
    $data = $this->validator($request);

    $personalRequest->update($data);

    return redirect(route($this->mainRoute . 'index', $personalRequest->id));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(PersonalRequest $personalRequest)
  {
    $this->authorize('destroy', $personalRequest);
    $company = $personalRequest->company;
    $personalRequest->delete();

    return redirect(route('client.company.show', $company->id));
  }
}
