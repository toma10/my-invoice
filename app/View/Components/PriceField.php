<?php

namespace App\View\Components;

use App\Currency;
use Illuminate\View\Component;
use Illuminate\View\View;

class PriceField extends Component
{
    public ?float $price;

    public ?string $currency;

    public function __construct(?float $price = null, ?string $currency = null)
    {
        $this->price = $price;
        $this->currency = $currency;
    }

    public function render(): View
    {
        return view('components.price-field');
    }

    public function currencies(): array
    {
        $currencies = array_combine(
            Currency::keys(),
            Currency::values()
        );

        if (! $currencies) {
            return [];
        }

        return $currencies;
    }
}
