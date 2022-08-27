<?php
namespace App\Services;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class CompanyService
{
    public function createOrUpdate(array $storeData) : CompanyProfile
    {
        $user = Auth()->user();
        $company = $user->company();
        return $company->updateOrCreate(
            ['user_id' => $user->id],
            $storeData
        );
    }
    
    /**
     * Upload and resizes the company logo
     *
     * @param Request $request
     * @return string|null
     */
    public function uploadLogo(Request $request) : string|null
    {
        $uploadPath = null;

        if ( $request->hasFile('company_logo')) {
            $this->removeLogoIfExists();

            $uploadPath = $request->file('company_logo')->store('logos', 'public');
            $uploadAbsolutePath = storage_path("app/public/$uploadPath");

            $interventionImage = Image::make($uploadAbsolutePath);
            $interventionImage->resize(100, 100, function ($const) {
                $const->aspectRatio();
            })->save($uploadAbsolutePath);
        }

        return $uploadPath;
    }

    private function removeLogoIfExists() : void
    {
        $company = Auth()->user()->company;
        if ($company && $company->logo_url )
            Storage::delete("public/$company->logo_url");
    }
}