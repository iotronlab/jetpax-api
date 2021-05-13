<?php

namespace App\Http\Controllers;

use App\Models\BusinessForm;
use App\Models\CreatorForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

        return response()->json($valid_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    public function uploadCreatorForm(Request $request)
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

        //  DB::table('contact_forms')->insert($data);
        CreatorForm::updateOrCreate($valid_data);

        return response()->json($valid_data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, ContactForm $contactForm)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    // public function destroy(ContactForm $contactForm)
    // {
    //     //
    // }
}
