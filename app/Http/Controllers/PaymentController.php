<?php

namespace App\Http\Controllers;

use Exception;
use App\Patron;
use App\Payment;
use App\Sponsor;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\UploadFileToDrive;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    use UploadFileToDrive;

    protected $directory = 'recipts';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $payments = new Payment;
            return $payments->search(request()->all());
        }

        return view('payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (request()->has('patron')) {
            $patron = Patron::whereId(request('patron'))->where('status', 1)->first();
            if ($patron == null) {
                return abort(403, 'Pessoa Física não encontrada ou desativada no sistema.');
            }
        } else {
            $sponsor = Sponsor::whereId(request('sponsor'))->where('status', 1)->first();
            if ($sponsor == null) {
                return abort(403, 'Pessoa Jurídica não encontrada ou desativada no sistema.');
            }
        }

        return view('payments.create')
            ->with([
                'categories' => Category::where('applicable_to', request()->has('patron') ? 'payment-patron' : 'payment-sponsor')->get(),
                'person' => request()->has('patron') ? $patron : $sponsor
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
        $person = json_decode(request('person'));
        $person = property_exists($person, 'cpf') ? Patron::whereId($person->id)->first() : Sponsor::whereId($person->id)->first();

        $person->payments()->create([
            'category_id' => json_decode(request('category'))->id,
            'type' => json_decode(request('type')),
            'payment_method' => json_decode(request('payment_method'))->value,
            'value' => json_decode(request('value')),
            'due_date' => request('due_date'),
            'payment_info' => json_decode(request('payment_info')),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     *
     */
    public function updateParcel(Request $request, Payment $payment, $parcelId)
    {
        $payment_infoUpdated = [];
        $paymentInfo = array_map(function ($parcel) use ($parcelId, $request, &$payment_infoUpdated) {
            if ($parcel['id'] == $parcelId) {
                $parcel['payment_method'] = json_decode(request('payment_method'));
                $parcel['recipt'] = request()->file('recipt') !== null ? $this->uploadFile($request) : null;
                $parcel['status'] = Carbon::now();
                $payment_infoUpdated = $parcel;
            }
            return $parcel;
        }, $payment->payment_info);
        $payment->payment_info = $paymentInfo;

        $payment->save();

        return json_encode($payment_infoUpdated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    /**
     *
     */
    public function validateRequest(Request $request, Payment $payment = null)
    {
        request()->validate([
            'category' => 'required',
            'person' => 'required',
            'type' => 'required',
            'value' => 'required',
            'payment_method' => 'required',
            'due_date' => 'required|date',
            'payment_info' => 'required',
        ]);
    }

    public function downloadRecipt($fileName)
    {
        try {
            $dir = '/';
            $recursive = false;
            $contents = collect(Storage::cloud()->listContents($dir, $recursive));
            $file = $contents
                ->where('type', '=', 'file')
                ->where('filename', '=', pathinfo($fileName, PATHINFO_FILENAME))
                ->where('extension', '=', pathinfo($fileName, PATHINFO_EXTENSION))
                ->first();
            $rawData = Storage::cloud()->get($file['path']);

            return response($rawData, 200)
                ->header('ContentType', $file['mimetype'])
                ->header('Content-Disposition', "attachment; filename=$fileName");
        } catch (Exception $e) {
            $file = public_path($this->directory) . $fileName; // Windows Server
            return Response::download($file);
        }
    }
}
