<?php

namespace App\Http\Controllers;

use App\Patron;
use App\Category;
use App\Rules\CPF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'phones' => request('phones'),
            'emails' => request('emails'),
            'social_medias' => request('social_medias'),
            'secretaries' => request('secretaries'),
            'dependents' => request('dependents'),
            'addresses' => request('addresses'),
            'marital_status' => request('marital_status'),
        ]);

        if (request('has_copatron')) {
            $patron->copatron()->create([
                'name' => request('copatron')['name'],
                'email' => request('copatron')['email'],
                'birthday' => new Carbon(request('copatron')['birthday']),
            ]);
        }

        $patron->categories()->attach(collect(request('categories'))->pluck('id')->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function show(Patron $patron)
    {
        $patron = Patron::whereId($patron->id)->with(['copatron', 'categories'])->first();
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
        $patron = Patron::whereId($patron->id)->with(['copatron', 'categories'])->first();
        return view('patrons.edit')->with([
            'patron' => $patron,
            'categories' => Category::where('applicable_to', 'patron')->get()
        ]);
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
        if (request()->has('change_status')) {
            return $patron->changeStatus()->fresh();
        }

        $this->validateRequest($request, $patron);

        $patron->update([
            'avatar' => request('avatar'),
            'name' => strtolower(request('name')),
            'birthday' => new Carbon(request('birthday')),
            'cpf' => request('cpf'),
            'bio' => strtolower(request('bio')),
            'occupation' => strtolower(request('occupation')),
            'company' => strtolower(request('company')),
            'pointed_by' => strtolower(request('pointed_by')),
            'phones' => request('phones'),
            'emails' => request('emails'),
            'social_medias' => request('social_medias'),
            'secretaries' => request('secretaries'),
            'dependents' => request('dependents'),
            'addresses' => request('addresses'),
            'marital_status' => request('marital_status'),
        ]);

        $patron->fresh();

        if ($patron->copatron && request('has_copatron')) {
            $patron->copatron()->update([
                'name' => request('copatron')['name'],
                'email' => request('copatron')['email'],
                'birthday' => new Carbon(request('copatron')['birthday']),
            ]);
            return;
        }

        if ($patron->copatron && !request('has_copatron')) {
            $patron->copatron()->delete();
            return;
        }

        if (!$patron->copatron && request('has_copatron')) {
            $patron->copatron()->create([
                'name' => request('copatron')['name'],
                'email' => request('copatron')['email'],
                'birthday' => new Carbon(request('copatron')['birthday']),
            ]);
            return;
        }
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
            'cpf' =>  [
                "required",
                'max:11',
                $patron ? Rule::unique('patrons')->ignore($patron->id) : 'unique:patrons,cpf',
                new CPF
            ],
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
