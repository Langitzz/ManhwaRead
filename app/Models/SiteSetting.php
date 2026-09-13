<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama_situs', 'logo', 'deskripsi', 'email_kontak'])]
class SiteSetting extends Model
{
    //
}