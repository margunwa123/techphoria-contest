<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Consultant\ConsultantRating;
use Illuminate\Http\Request;

class ConsultantRatingController extends Controller
{
  public function validator(Request $request)
  {
    return $request->validate([
      'consultant_id' => ['required'],
      'completed_project_id' => ['required'],
      'rating' => ['required'],
      'review' => ['required'],
    ]);
  }

  public function update(Request $request, ConsultantRating $consultantRating)
  {
    $this->authorize('update', $consultantRating);
    $data = $this->validator($request);
    $consultantRating->update($data);
    $consultantRatings = ConsultantRating::where('consultant_id', $consultantRating->consultant_id)->get();
    $sumRating = 0;
    $numOfRatings = count($consultantRatings);
    foreach ($consultantRatings as $rating) {
      $sumRating += (int) $rating->rating;
    }
    $consultantRating->consultant->update([
      'rating' => $sumRating / $numOfRatings
    ]);
    return redirect()->back();
  }
}
