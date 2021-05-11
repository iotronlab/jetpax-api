<?php

namespace App\Http\Controllers;

use App\Models\BusinessForm;

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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        BusinessForm::create($valid_data);

        return response()->json($valid_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
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
