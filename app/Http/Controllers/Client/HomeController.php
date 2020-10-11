<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  private $mainDir = 'client.';
  private $mainRoute = 'client.';

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('checkrole:client');
  }
  public function index()
  {
    $user = Auth::user();
    return view($this->mainDir . 'home', compact('user'));
  }
}
