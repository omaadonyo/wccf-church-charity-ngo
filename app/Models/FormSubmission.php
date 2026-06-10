<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'type', 'message', 'form_data'];

    protected function casts(): array
    {
        return ['form_data' => 'array'];
    }
}
