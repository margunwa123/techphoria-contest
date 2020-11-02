<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyRequest extends Model
{
  use HasFactory;
  protected $guarded = [];

  public static function boot()
  {
    parent::boot();

    static::created(function ($applyRequest) {
      (new Notification([
        'title' => 'New applicants',
        'body' => 'A consultant applied to your request, check your request tab',
        'read' => False,
        'user_id' => $applyRequest->request->company->id
      ]))->save();
    });
  }

  public function request()
  {
    return $this->belongsTo(Request::class);
  }

  public function consultant()
  {
    return $this->belongsTo(Consultant::class);
  }
}
