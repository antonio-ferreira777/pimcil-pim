<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormBloc extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'form_blocs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'display_order',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function formBlocFields()
    {
        return $this->belongsToMany(Field::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
