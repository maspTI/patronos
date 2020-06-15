<?php

namespace App\Http\Controllers;

use App\Patron;
use App\Category;
use App\Rules\CPF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $patrons = new Patron;
            return $patrons->search(request()->all());
        }
        return view('patrons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patrons.create')->with([
            'categories' => Category::where('applicable_to', 'patron')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $patron = Patron::create([
            'avatar' => request('avatar'),
            'name' => strtolower(request('name')),
            'birthday' => new Carbon(request('birthday')),
            'cpf' => request('cpf'),
            'bio' => strtolower(request('bio')),
            'occupation' => strtolower(request('occupation')),
            'company' => strtolower(request('company')),
            'pointed_by' => strtolower(request('pointed_by')),
            'phones' => count(request('phones')) == 0 ? null : (request('phones')),
            'emails' => count(request('emails')) == 0 ? null : (request('emails')),
            'social_medias' => count(request('social_medias')) == 0 ? null : (request('social_medias')),
            'secretaries' => count(request('secretaries')) == 0 ? null : (request('secretaries')),
            'dependents' => count(request('dependents')) == 0 ? null : (request('dependents')),
            'marital_status' => request('marital_status')['value'],
        ]);

        if (request('has_copatron')) {
            $patron->copatron()->create([
                'name' => request('copatron')['name'],
                'email' => request('copatron')['email'],
                'birthday' => new Carbon(request('copatron')['birthday']),
            ]);
        }

        $patron->categories()->attach(collect(request('categories'))->pluck('id')->all());

        array_map(function ($address) {
            $address['country'] = json_encode($address['country']);
        }, request('addresses'));

        $patron->addresses()->createMany(request('addresses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function show(Patron $patron)
    {
        $patron = Patron::whereId($patron->id)->with(['addresses', 'copatron', 'categories'])->first();
        return view('patrons.show')->with(['patron' => $patron]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function edit(Patron $patron)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patron $patron)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patron $patron)
    {
        //
    }

    /**
     *
     */
    public function validateRequest(Request $request, Patron $patron = null)
    {
        request()->validate([
            'avatar' =>  "nullable",
            'name' =>  "required|max:250",
            'birthday' =>  "required|max:250",
            'cpf' =>  ["required", 'max:11', 'unique:patrons,cpf', new CPF],
            'bio' =>  "nullable",
            'occupation' =>  "nullable|max:255",
            'company' =>  "nullable|max:255",
            'pointed_by' =>  "nullable|max:255",
            'categories' =>  'required',
            'phones' =>  'required',
            'emails' =>  'required',
            'social_medias' =>  'nullable',
            'secretaries' =>  'nullable',
            'addresses' =>  'required',
            'copatron' =>  'nullable'
        ]);
    }
}
