<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function readNotif(Notification $notification)
  {
    $notification->read = True;
    $notification->save();
  }

  public function destroy(Notification $notification)
  {
    $notification->delete();
  }
}
