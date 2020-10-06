<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PersonalRequest;
use Illuminate\Http\Request;

class PersonalRequestController extends Controller
{
  private $mainDir = 'client.request.';
  private $mainRoute = 'client.request.';

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
   * @param  \Illuminate\Http\Request  $personalRequest
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $this->validator($request);

    $personalRequest = new PersonalRequest($data);
    $personalRequest->save();

    return redirect(route($this->mainRoute . 'index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(PersonalRequest $personalRequest)
  {
    return view($this->mainDir . 'show', compact('personalRequest'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(PersonalRequest $personalRequest)
  {
    return view($this->mainDir . 'edit', compact('personalRequest'));
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
    $data = $this->validator($request);

    $personalRequest->update($data);

    return redirect(route($this->mainRoute . 'show', $personalRequest->id));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(PersonalRequest $personalRequest)
  {
    $company = $personalRequest->company;
    $personalRequest->delete();

    return redirect(route('client.company.show', $company->id));
  }
}
