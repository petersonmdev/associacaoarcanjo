<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
  public function user(Request $request, $id)
  {
    $user = UserRepository::find($id);
    return view('app.configuration.user', [
      'id' => $id,
      'user' => $user
    ]);
  }
}
