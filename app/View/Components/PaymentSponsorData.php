<?php

namespace App\View\Components;

use App\Sponsor;
use Illuminate\View\Component;

class PaymentSponsorData extends Component
{
    public $person;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Sponsor $person)
    {
        $this->person = $person;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.payment-sponsor-data');
    }
}
