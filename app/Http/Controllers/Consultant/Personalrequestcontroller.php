<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalRequestcontroller extends Controller
{
  private $mainDir = 'consultant.personal_request.';
  private $mainRoute = 'consultant.personal_request.';
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view($this->mainDir . 'index');
  }
}
