<?php
use PHPUnit\Framework\TestCase;
final class TaxesTest extends TestCase
{
    public function testCorrectTaxIsReturned(): void
    {
        require 'app/Taxes.php';
        
        $german = new Taxes(new GermanTax);
        $british = new Taxes(new BritishTax);
        $polish = new Taxes(new PolishTax);

        $this->assertEquals(30, $german->calc(100));
        $this->assertEquals(15, $british->calc(100));
        $this->assertEquals(23, $polish->calc(100));
    }
}
?>