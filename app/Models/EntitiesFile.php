<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntitiesFile extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'entities_files';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'entity_id',
        'file_id',
        'display_order',
        'is_default',
        'to_use',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
