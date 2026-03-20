<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AddressRepository;
use App\Repositories\AssistedRepository;
use App\Repositories\ContactRepository;
use App\Repositories\VoluntaryRepository;

class VoluntaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('app.voluntary.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      return view('app.voluntary.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $voluntary = VoluntaryRepository::find($id);

      if (! $voluntary) {
        abort(404);
      }

      $address = $voluntary->address_id !== null
        ? AddressRepository::find((int) $voluntary->address_id)
        : null;

      $contacts = $voluntary->contact_id !== null
        ? ContactRepository::find((int) $voluntary->contact_id)
        : null;

      $assisteds = AssistedRepository::findByIdsComplete(
        AssistedRepository::findIdsByVoluntaryId((int) $voluntary->id)
      );

      return view('app.voluntary.show', [
        'voluntary' => $voluntary,
        'address' => $address,
        'contacts' => $contacts,
        'assisteds' => $assisteds,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $voluntary = VoluntaryRepository::find($id);
      return view('app.voluntary.update', [
        'id' => $id,
        'voluntary' => $voluntary
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bindAssisted()
    {
        return view('app.assisted-with-voluntary');
    }

    public function indexScripting()
    {
        return view('app.voluntary-rotarization');
    }
}
