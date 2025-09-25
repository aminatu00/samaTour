<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // On précise quels champs peuvent être remplis via create()
    protected $fillable = ['user_id', 'title', 'message', 'read_at'];

    // Cette méthode marque une notification comme lue
    public function markAsRead()
    {
        $this->read_at = now(); // Met à jour le champ read_at avec la date actuelle
        $this->save(); // Sauvegarde les changements dans la base de données
    }

    // Cette méthode vérifie si la notification a été lue
    public function isRead()
    {
        return $this->read_at !== null; // Si read_at n'est pas null, cela signifie que la notification a été lue
    }
}
