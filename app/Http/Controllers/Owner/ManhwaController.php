<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\ManhwaMonitoringController;

class ManhwaController extends ManhwaMonitoringController
{
    protected function view(): string
    {
        return 'owner.manhwa';
    }
}