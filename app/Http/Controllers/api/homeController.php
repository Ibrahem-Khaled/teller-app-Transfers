<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AppNotification;
use App\Models\Slider;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function getingSliders()
    {
        $sliders = Slider::all();

        if ($sliders->count() == 0) {
            return response()->json(['message' => 'No sliders found'], 404);
        }

        $sliders = $sliders->map(function ($slider) {
            $slider->image = url('storage/' . $slider->image);
            return $slider;
        });

        return response()->json($sliders, 200);
    }


    public function getingNotification()
    {
        $notifications = AppNotification::all();

        if ($notifications->count() == 0) {
            return response()->json(['message' => 'No notifications found'], 404);
        }

        $notifications = $notifications->map(function ($notification) {
            $notification->image = url('storage/' . $notification->image);
            return $notification;
        });

        return response()->json($notifications, 200);
    }

}
