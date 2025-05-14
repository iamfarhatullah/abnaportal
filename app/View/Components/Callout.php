<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Callout extends Component
{
    public $message;
    public $type;

    public function __construct($message = 'Error', $type = 'danger')
    {
        $this->message = $message;
        $this->type = $type;
    }

    public function render()
    {
        return view('components.callout');
    }
}
