<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  private $mainDir = 'consultant.profile.';
  private $mainRoute = 'consultant.profile.';
  /**
   * Display the specified resource.
   *
   * @param  int  User $user
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::find($id);
    return view($this->mainDir . 'show', compact('user'));
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);
    $data = [
      "name" => $request['name'],
      "email" => $request['email'],
      "gender" => $request['gender'],
      "age" => $user->age,
      "phone" => $request['phone'],
      "job" => $request['job'],
      "rating" => $user->rating
    ];
    $user->update($data);
    return redirect('/');
  }
}
