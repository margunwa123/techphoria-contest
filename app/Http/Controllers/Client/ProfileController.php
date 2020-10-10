<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Policies\ProfilePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  private $mainDir = 'client.profile.';
  private $mainRoute = 'client.profile.';

  public function __construct()
  {
    $this->middleware('auth')->only('update');
    $this->middleware('checkrole:client')->only('update');
  }

  public function show($id)
  {
    $user = User::find($id);
    if ($user->role == "consultant") {
      return redirect('/');
    }
    $this->authorize('view', $user);
    return view($this->mainDir . 'show', compact('user'));
  }


  public function update(Request $request, $id)
  {
    $user = User::find($id);
    $this->authorize('update', $user);
    if ($user->id != Auth::id()) {
      abort(403, 'You have no permission to update this file');
    }
    $data = [
      "name" => $request['name'],
      "email" => $request['email'],
      "gender" => $request['gender'],
      "phone" => $request['phone'],
      "job" => $request['job']
    ];
    $user->update($data);
    return redirect()->back();
  }
}
