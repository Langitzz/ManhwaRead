<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\ManhwaMonitoringController;

class ManhwaController extends ManhwaMonitoringController
{
    protected function view(): string
    {
        return 'supervisor.manhwa';
    }
}