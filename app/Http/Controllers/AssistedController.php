<?php

namespace App\Http\Controllers;

use App\Repositories\AddressRepository;
use App\Repositories\AssistedRepository;
use App\Repositories\ContactRepository;
use App\Repositories\DependentRepository;
use App\Repositories\IncomeRepository;
use App\Repositories\VoluntaryRepository;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
      return view('app.assisted.index');
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
        return view('app.assisted.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $assisted = AssistedRepository::find($id);
        $addresses = AddressRepository::find($assisted->address_id);
        $contacts = ContactRepository::find($assisted->contact_id);
        $dependents = DependentRepository::findByAssistedId($assisted->id);
        $incomes = IncomeRepository::findByAssistedId($assisted->id);
        $voluntary = VoluntaryRepository::find($assisted->voluntary_id);
        return view('app.assisted.show', [
          'assisted' => $assisted,
          'addresses' => $addresses,
          'contacts' => $contacts,
          'dependents' => $dependents,
          'incomes' => $incomes,
          'voluntary' => $voluntary
        ]);
    }

    public function showPdf(int $id)
    {
      $assisted = AssistedRepository::find($id);
      return view('app.assisted.pdf.show', [
        'id' => $id,
        'assisted' => $assisted
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
      $assisted = AssistedRepository::find($id);
      return view('app.assisted.update', [
        'id' => $id,
        'assisted' => $assisted
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
