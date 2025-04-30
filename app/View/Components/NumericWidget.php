<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NumericWidget extends Component
{
    public string $title;
    public string $icon;
    public $value;
    public string $description;
    public string $color;
    public bool $isMoney;
    public bool $isHour;
    public bool $isPercent;
    public string $formattedValue;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title,
        $icon = 'fa-chart-bar',
        $value = 0,
        $description = '',
        $color = 'primary',
        $isMoney = false,
        $isHour = false,
        $isPercent = false 
    ) {
        $this->title = $title;
        $this->icon = $icon;
        $this->value = $value;
        $this->description = $description;
        $this->color = $color;
        $this->isMoney = filter_var($isMoney, FILTER_VALIDATE_BOOLEAN);
        $this->isHour = filter_var($isHour, FILTER_VALIDATE_BOOLEAN);
        $this->isPercent = filter_var($isPercent, FILTER_VALIDATE_BOOLEAN);
        $this->formattedValue = $this->formatValue();
    }

    protected function formatValue()
    {
        return match (true) {
            $this->isMoney => 'R$ ' . number_format($this->value, 2, ',', '.'),
            $this->isHour => sprintf('%02dh%02dm', floor($this->value), ($this->value - floor($this->value)) * 60),
            $this->isPercent => number_format($this->value * 100, 2) . '%',
            default => $this->value,
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.numeric-widget');
    }
}
