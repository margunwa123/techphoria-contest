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
  public function show(User $user)
  {
    return view($this->mainDir . 'show');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  User $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  User $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'username' => ['required', 'unique:users'],
      'gender' => ['required', 'string'],
      'age' => ['required', 'integer', 'min:0', 'max:100'],
      'phone' => ['required', 'string'],
      'job' => ['required', 'string'],
    ]);
    $user->update($data);

    return redirect(route($this->mainRoute . 'index'));
  }
}
