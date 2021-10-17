<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bordereau extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public const ETAT_SELECT = [
        'incomplet'                                         => 'incomplet',
        'rejetté'                                           => 'rejetté',
        'vérifie'                                           => 'vérifie',
        'en cours de vérifications'                         => 'en cours de vérifications',
        'soumit au centre de traitement pour la validation' => 'soumit au centre de traitement pour la validation',
    ];

    public $table = 'bordereaus';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'team_id',
        'etat',
        'note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
