<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    if ($user->role == "client") {
      return redirect('/');
    }
    $completedProjects = $user->consultant->completedProjects;
    $reviews = [];
    foreach ($completedProjects as $completedProject) {
      array_push($reviews, $completedProject->consultantRating);
    }
    return view($this->mainDir . 'show', compact('user', 'reviews'));
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);
    $data = [
      "name" => $request['name'],
      "email" => $request['email'],
      "age" => $user->age,
      "phone" => $request['phone'],
      "job" => $request['job']
    ];
    $user->update($data);
    return redirect()->back();
  }
}
