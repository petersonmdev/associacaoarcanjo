<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
      $user = UserRepository::find($id);
      return view('app.account.index', [
        'id' => $id,
        'user' => $user
      ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $user = UserRepository::find($id);
      return view('app.account.index', [
        'id' => $id,
        'user' => $user
      ]);
    }

    public function showSecurity(string $id)
    {
      $user = UserRepository::find($id);
      return view('app.account.security', [
        'id' => $id,
        'user' => $user
      ]);
    }

    public function showLoginHistory(string $id)
    {
      $user = UserRepository::find($id);
      return view('app.account.login-history', [
        'id' => $id,
        'user' => $user
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
