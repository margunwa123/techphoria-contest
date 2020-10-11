<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  private $mainDir = 'consultant.';
  private $mainRoute = 'consultant.';

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('checkrole:consultant');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user = Auth::user();
    return view($this->mainDir . 'home', compact('user'));
  }
}
