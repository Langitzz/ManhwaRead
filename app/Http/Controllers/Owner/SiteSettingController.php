<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\SiteSettingController as BaseSiteSettingController;
use App\Models\SiteSetting;
use Illuminate\View\View;

class SiteSettingController extends BaseSiteSettingController
{
    public function edit(): View
    {
        $siteSetting = SiteSetting::first();

        return view('owner.pengaturan', compact('siteSetting'));
    }
}