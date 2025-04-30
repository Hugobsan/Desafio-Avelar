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
        $isHour = false
    ) {
        $this->title = $title;
        $this->icon = $icon;
        $this->value = $value;
        $this->description = $description;
        $this->color = $color;
        $this->isMoney = filter_var($isMoney, FILTER_VALIDATE_BOOLEAN);
        $this->isHour = filter_var($isHour, FILTER_VALIDATE_BOOLEAN);
        $this->formattedValue = $this->formatValue();
    }

    protected function formatValue()
    {
        if ($this->isMoney) {
            return 'R$ ' . number_format($this->value, 2, ',', '.');
        } elseif ($this->isHour) {
            $h = floor($this->value);
            $m = ($this->value - $h) * 60;
            return sprintf('%02dh%02dm', $h, $m);
        }
        return $this->value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.numeric-widget');
    }
}
