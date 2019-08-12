<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    //
    protected $connection = 'secondary';
    protected $table = 'wp_nci_community';
    protected $fillable = ['id_community','name_community'];
}
