<?php

namespace App\Http\Controllers;

use App\Project;
use App\Sponsor;
use App\Category;
use App\Rules\CNPJ;
use Illuminate\Http\Request;
use App\Jobs\GoogleDriveUpload;
use Illuminate\Validation\Rule;

class SponsorController extends Controller
{
    protected $directory = 'logos';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $sponsors = new Sponsor;
            return $sponsors->search(request()->all());
        }
        return view('sponsors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sponsors.create')->with([
            'categories' => Category::where('applicable_to', 'sponsor')->get(),
            'projects' => Project::get()
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
        $this->validateRquest($request);

        Sponsor::create([
            'category_id' => json_decode(request('category'))->id,
            'project_id' => json_decode(request('project'))->id,
            'avatar' => request('avatar'),
            'logo' => request()->file('logo') !== null ? $this->logo($request) : null,
            'razao_social' => strtolower(request('razao_social')),
            'nome_fantasia' => strtolower(request('nome_fantasia')),
            'cnpj' => request('cnpj'),
            'occupation_area' => strtolower(request('occupation_area')),
            'proxy' => json_decode(request('proxy')),
            'social_medias' => json_decode(request('social_medias')),
            'addresses' => json_decode(request('addresses')),
            'people_to_contact' => json_decode(request('people_to_contact')),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        return view('sponsors.show')->with(['sponsor' => $sponsor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        $sponsor = Sponsor::whereId($sponsor->id)->with(['category', 'project'])->first();
        return view('sponsors.edit')->with([
            'sponsor' => $sponsor,
            'categories' => Category::where('applicable_to', 'sponsor')->get(),
            'projects' => Project::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        if (request()->has('change_status')) {
            return $sponsor->changeStatus()->fresh();
        }

        $this->validateRquest($request, $sponsor);

        $sponsor->update([
            'category_id' => json_decode(request('category'))->id,
            'project_id' => json_decode(request('project'))->id,
            'avatar' => request('avatar'),
            'logo' => request()->file('logo') !== null ? $this->logo($request) : request('logo'),
            'razao_social' => strtolower(request('razao_social')),
            'nome_fantasia' => strtolower(request('nome_fantasia')),
            'cnpj' => request('cnpj'),
            'occupation_area' => strtolower(request('occupation_area')),
            'proxy' => json_decode(request('proxy')),
            'social_medias' => json_decode(request('social_medias')),
            'addresses' => json_decode(request('addresses')),
            'people_to_contact' => json_decode(request('people_to_contact')),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }

    /**
     *
     */
    protected function validateRquest(Request $request, Sponsor $sponsor = null)
    {
        request()->validate([
            'avatar' => 'nullable',
            'category' => 'required',
            'project' => 'required',
            'razao_social' => 'required|max:255',
            'nome_fantasia' => 'required|max:255',
            'cnpj' => [
                "required",
                'max:14',
                $sponsor ? Rule::unique('sponsors')->ignore($sponsor->id) : 'unique:sponsors,cnpj',
                new CNPJ
            ],
            'occupation_area' => 'required|max:255',
            'proxy' => 'required',
            'social_medias' => 'nullable',
            'addresses' => 'required',
            'people_to_contact' => 'required',
        ]);
    }

    /**
     *
     */
    protected function logo(Request $request)
    {
        $fileName = time() . '.' . request()->file('logo')->getClientOriginalExtension();

        request()->file('logo')->move(public_path($this->directory), $fileName);
        GoogleDriveUpload::dispatch($fileName);

        return $fileName;
    }
}
