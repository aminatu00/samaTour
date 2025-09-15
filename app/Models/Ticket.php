<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'numero_ticket',
        'status',   // en_attente, appelé, terminé
        'category', // standard, urgent
    ];

    // Relation avec l'utilisateur (patient)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
