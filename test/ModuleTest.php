<?php
namespace MonthlyBasis\GroupTest;

use MonthlyBasis\Group\Module;
use MonthlyBasis\LaminasTest\ModuleTestCase;
use PHPUnit\Framework\TestCase;

class ModuleTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        $this->module = new Module();
    }
}
