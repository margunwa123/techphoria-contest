<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Consultant;

class ConsultantController extends Controller
{
  private $mainDir = 'client.consultant.';
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $consultants = Consultant::all()->sortBy('rating');
    return view($this->mainDir . 'index', compact('consultants'));
  }

  public function show(Consultant $consultant)
  {
    return redirect(route('consultant.profile.show', $consultant->id));
  }
}
