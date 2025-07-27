<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examinations extends Model
{
    protected $table = 'examinations';  
    protected $fillable = [
        'user_id',
        'patient_name',
        'age',
        'sex',
        'cp',
        'trestbps',
        'chol',
        'fbs',
        'restecg',
        'thalach',
        'exang',
        'prediction', 
        'shap_values',
        'explanation',
    ];

    protected $casts = [
        'shap_values' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
