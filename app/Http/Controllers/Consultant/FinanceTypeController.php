<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Consultant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceTypeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('checkrole:consultant');
  }

  public function edit()
  {
    $consultant = Auth::user()->consultant;
    return view('consultant.finance_type.edit', compact('consultant'));
  }

  public function update(Request $request)
  {
    $consultant = Auth::user()->consultant;
    $data = $request->validate([
      'finance_type' => ['required', 'min:5', 'max:50'],
    ]);
    $consultant->update($data);

    return redirect(route('consultant.profile.show', $consultant->id));
  }
}
