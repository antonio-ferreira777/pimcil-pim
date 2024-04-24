<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuggestsValue extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'suggests_values';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'suggest_id',
        'value',
        'language_id',
        'country_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function suggest()
    {
        return $this->belongsTo(Suggest::class, 'suggest_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
