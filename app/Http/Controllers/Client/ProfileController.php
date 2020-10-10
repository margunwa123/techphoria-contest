<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  private $mainDir = 'client.profile.';
  private $mainRoute = 'client.profile.';

  public function show($id)
  {
    $user = User::find($id);
    return view($this->mainDir . 'show', compact('user'));
  }


  public function update(Request $request, $id) {
    $user = User::find($id);
    $data = [
      "name" => $request['name'],
      "email" => $request['email'],
      "gender" => $request['gender'],
      "age" => $user->age,
      "phone" => $request['phone'],
      "job" => $request['job']
    ];
    $user->update($data);
    return redirect('/');
  }
}
