<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  public function show(Profile $profile)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  Profile $profile
   * @return \Illuminate\Http\Response
   */
  public function edit(Profile $profile)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  Profile $profile
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Profile $profile)
  {
    //
  }
}
