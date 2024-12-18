<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'message', 'status'];

    // Status için accessor
    public function getStatusBadgeAttribute()
    {
        return $this->status 
            ? '<span class="badge bg-success">Oxundu</span>'
            : '<span class="badge bg-warning">Oxunmadı</span>';
    }
}