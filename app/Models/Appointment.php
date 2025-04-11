<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Table associée (facultatif si le nom du modèle est "appointment" au pluriel par défaut)
    protected $table = 'appointments';

    // Champs autorisés à être assignés en masse
    protected $fillable = [
        'date_appointment',
        'start_time',
        'end_time',
        'Availability',
    ];

    // Pour éviter les erreurs si tu veux faire $appointment->availability en minuscule
    public function getAvailabilityAttribute($value)
    {
        return strtolower($value);
    }

    public function setAvailabilityAttribute($value)
    {
        $this->attributes['Availability'] = strtolower($value);
    }
}
