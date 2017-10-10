<?php

namespace App\Http\Controllers;

use App\Liveshow;
use Illuminate\Http\Request;

class ShowsController extends Controller
{
    public function shows()
    {
      $shows = Liveshow::orderBy('Date_D_M_Y', 'desc')
        ->get();

      return view('shows')
        ->with('shows', $shows);
    }
}
