<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  private $mainDir = 'client.request.';
  private $mainRoute = 'client.request.';

  public function show(User $user)
  {
    return view($this->mainDir . 'show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  User $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    $this->authorize('update', $user);

    return view($this->mainDir . 'edit');
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
    $this->authorize('update', $user);
  }
}
