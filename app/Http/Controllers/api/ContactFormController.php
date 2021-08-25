<?php

namespace App\Http\Controllers\api;

use App\Events\FormSubmit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessForm;
use App\Models\CreatorForm;



class ContactFormController extends Controller
{
    /**
     * Upload form.
     *
     */


    public function uploadBusinessForm(Request $request)
    {
        $valid_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'business_name' => 'required',
            'business_link' => 'required',
            'contact' => 'required',
            'service' => 'required',
            'budget' => 'required',
            'details' => 'required',
        ]);


        $businessForm = BusinessForm::updateOrCreate($valid_data);
        event(new FormSubmit($businessForm));

        return response()->json($valid_data);
    }


    public function uploadCreatorForm(Request $request)
    {
        $valid_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'profile_name' => 'required',
            'profile_link' => 'required',
            'contact' => 'required',
            'location' => 'required',
            'details' => 'required',
        ]);


        //  DB::table('contact_forms')->insert($data);
        $creatorForm = CreatorForm::updateOrCreate($valid_data);

        event(new FormSubmit($creatorForm));
        return response()->json($valid_data);
    }
}
