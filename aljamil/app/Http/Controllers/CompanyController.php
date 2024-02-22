<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
  //    get all companies 
  public function index()
  {
    $companies = Company::paginate(10);

    return view("pages/companies")->with("companies", $companies);
  }


  public function store(StoreCompanyRequest $request)
  {
    $company =  Company::create([
      'name' => $request->input("company_name")
    ]);

    if ($company instanceof Company) {
      toastr()->success("company added");
      return redirect()->route("company.index");
    }
    toastr()->error("something Error");
    return redirect()->back()->withErrors(["message" => "error in create"]);

  }


  public function edit(Company $company)
  {
    return view("pages/edit-company")->with("company", $company);
  }


  public function update(UpdateCompanyRequest $request, Company $company)
  {


    $company->update([
      "name" => $request->input("company_name"),
    ]);
    toastr()->success("company updated");

    return redirect()->to("company");
  }


  public function destroy(Company $company)
  {
    $company->delete();
    toastr()->success("company deleted");
    return redirect()->to("company");
  }
}
