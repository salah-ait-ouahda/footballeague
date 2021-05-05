<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Player extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use HasFactory;

    public const SEXE_SELECT = [
        'masculin' => 'masculin',
        'féminin'  => 'féminin',
    ];

    public const CATEGORY_SELECT = [
        'U20' => 'U20',
        'U21' => 'U21',
        'U23' => 'U23',
    ];

    public const TRANCHE_SELECT = [
        'jeunes'          => 'jeunes',
        'junior'          => 'junior',
        'sénior'          => 'sénior',
        'accompagnateurs' => 'accompagnateurs',
    ];

    public const STATUS_SELECT = [
        'incomplet'                                         => 'incomplet',
        'rejetté'                                           => 'rejetté',
        'vérifie'                                           => 'vérifie',
        'en cours de vérifications'                         => 'en cours de vérifications',
        'soumit au centre de traitement pour la validation' => 'soumit au centre de traitement pour la validation',
    ];

    public $table = 'players';

    protected $appends = [
        'picture',
    ];

    protected $dates = [
        'birthday_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'team_id',
        'name',
        'prenom',
        'tranche',
        'cine',
        'sexe',
        'birthday_date',
        'status',
        'category',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function getPictureAttribute()
    {
        $file = $this->getMedia('picture')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getBirthdayDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthdayDateAttribute($value)
    {
        $this->attributes['birthday_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
