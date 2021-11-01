<?php

namespace Tests\Unit;

use App\Http\Controllers\Device;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class calculatingTempTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function CalcRealTempTrend()
    {
         $lastRoundDutyCircle =
        $UserTempTrend = (new Device())->getRealRoomTempTrend('','');
        $this->assertTrue(true);
    }
}
