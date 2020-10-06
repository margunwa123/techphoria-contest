<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
  private $mainDir = 'client.company.';
  private $mainRoute = 'client.company.';

  public function validator(Request $request)
  {
    $date_now = date('Y-m-d');
    return $request->validate([
      'name' => ['required', 'max:255'],
      'city' => ['required', 'max:255'],
      'found_date' => ['required', 'date', 'before:' . $date_now],
      'description' => ['required'],
      'company_field' => ['required', 'max:50'],
      'phone' => ['required', 'max:31'],
    ]);
  }

  public function __construct()
  {
    $this->middleware('auth')->except(['show']);
    $this->middleware('checkrole:client')->except('show');
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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->authorize('create');
    return view($this->mainDir . 'create');
  }

  public function show(Company $company)
  {
    $requests = $company->requests;
    $projects = $company->projects;
    $completedProjects = $company->completedProjects;
    return view($this->mainDir . 'show', compact('company', 'projects', 'completedProjects', 'requests'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->authorize('create', Company::class);
    $data = $this->validator($request);

    Auth::user()->companies()->create($data);

    return redirect(route($this->mainRoute . 'index'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Company $company)
  {
    $this->authorize('update', $company);

    $request["name"] = $company->name;
    $data = $this->validator($request);
    $company->update($data);

    return redirect(route($this->mainRoute . 'index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Company $company)
  {
    $this->authorize('delete', $company);

    $company->delete();

    return redirect(route($this->mainRoute . 'index'));
  }
}
