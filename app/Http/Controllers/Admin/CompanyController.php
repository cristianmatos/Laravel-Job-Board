<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CompanyService;

class CompanyController extends Controller
{

    public function __construct(
        private CompanyService $companyService){

    }

    /**
     * Show the form to create or edit the company profile
     *
     * @return View
     */
    public function create(Request $request, string $action = 'create')
    {
        return view('company.create', [
            'company' => $request->user()->company,
            'action' => $action
        ]);
    }

    /**
     * Create or update company profile
     *
     * @param Request $request
     * @return void
     */ 
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|max:255',
            'description' => 'max:500',
            'company_logo' => 'image|max:1024',
        ]);

        $data = [
            'company_name' => $request->company_name,
            'description' => $request->description
        ];

        $logoUrl =$this->companyService->uploadLogo($request);
        
        if ( $logoUrl)
            $data['logo_url'] = $logoUrl;

        $this->companyService->createOrUpdate($data);

        if ( $request->_action === 'edit')
            return back()->with('success',__('Your company profile has been updated!'));

        return redirect()->route('job.description');
    }
}
