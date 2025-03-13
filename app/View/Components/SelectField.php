<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectField extends Component
{
    public $name;
    public $options;
    public $selected;

    public function __construct($name, $options, $selected = null)
    {
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
    }

    public function render()
    {
        return view('components.select-field');
    }
}
