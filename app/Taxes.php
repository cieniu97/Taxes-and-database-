<?php
```
Classes in this file are meant to calculate taxes from different countries
```

interface Tax
{
    public function calc(float $price): float;
}


```
Class Taxes is a middle man for the Tax interface
As one can imagine, there are a lot of countries out there, each with different taxes system.
Therfore class Taxes is an adapter for possible future code and functionality expansion

```
class Taxes implements Tax{
    protected $processor;

    public function __construct($processor){
        $this->processor = $processor;
    }

    public function calc(float $price): float{
        return $this->processor->getTax($price);
    }
}

// Calculate tax in Germany
class GermanTax{
    public function getTax(float $price): float{
        return $price*0.3;
    }
}

// Calculate tax in Britan
class BritishTax{
    public function getTax(float $price): float{
        return $price*0.15;
    }
}

// Calculate tax in Poland
class PolishTax{
    public function getTax(float $price): float{
        return $price*0.23;
    }
}
