<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ticket extends Component
{
    public $ticket_id;
    public $fare_det;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $fare)
    {
        $this->ticket_id = $id;
        $this->fare_det = $fare;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
                // dd(['ticket_id' => $this->ticket_id] + $this->fare_det);
        // return view('components.ticket', ['ticket_id' => $this->ticket_id] + $this->fare_det);
    }
}
