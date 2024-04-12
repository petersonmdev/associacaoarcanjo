<?php

namespace App\Http\Controllers;

use App\Models\Assisted;
use Illuminate\Http\Request;

class AssistedController extends Controller
{

    public $currentStep = 1;
    public $name, $amount, $description, $status = 1, $stock;
    public $successMessage = '';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('app.assisted-list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$assisted = Assisted::create($request->all());
        return $assisted;*/
        return view('app.assisted-new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

    public function bind()
    {
        return view('app.assisted-with-voluntary');
    }

  public function firstStepNewAssisted()
  {
    $validatedData = $this->validate([
      'name' => 'required|unique:products',
      'amount' => 'required|numeric',
      'description' => 'required',
    ]);

    $this->currentStep = 2;
  }

  public function SecondStepNewAssisted()
  {
    $validatedData = $this->validate([
      'stock' => 'required',
      'status' => 'required',
    ]);

    $this->currentStep = 3;
  }

  public function submitFormNewAssisted()
  {
    Product::create([
      'name' => $this->name,
      'amount' => $this->amount,
      'description' => $this->description,
      'stock' => $this->stock,
      'status' => $this->status,
    ]);

    $this->successMessage = 'Família assistida cadastrada com sucesso!';

    $this->clearForm();

    $this->currentStep = 1;
  }

  /**
   * Write code on Method
   *
   * @return response()
   */
  public function backSteps($step)
  {
    $this->currentStep = $step;
  }

  /**
   * Write code on Method
   *
   * @return response()
   */
  public function clearFormNewAssisted()
  {
    $this->name = '';
    $this->amount = '';
    $this->description = '';
    $this->stock = '';
    $this->status = 1;
  }
}
