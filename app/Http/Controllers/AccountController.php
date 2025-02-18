<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
  public function index(Request $request, $id)
  {
    return view('app.account.index', [
      'id' => $id
    ]);
  }
}
