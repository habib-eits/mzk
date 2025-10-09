<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MonthPicker extends Component
{
    public function __construct(
        public ?string $id = null,
        public string $name = 'month',
        public ?string $value = null,         // expects "M-yyyy" like "Aug-2025"
        public ?string $placeholder = 'MMM-YYYY',
        public bool $autofocus = false,
        public bool $required = false,
        public ?string $class = null
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.month-picker');
    }
}
