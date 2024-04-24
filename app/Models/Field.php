<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'fields';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'input'        => 'Input',
        'textarea'     => 'Textarea',
        'checkbox'     => 'Checkbox',
        'radio'        => 'Radio',
        'select'       => 'Select',
        'select_multi' => 'Select Multi',
        'file'         => 'File',
        'int'          => 'Integer',
        'float'        => 'Float',
        'tree'         => 'Tree',
    ];

    protected $fillable = [
        'name',
        'description',
        'type',
        'default',
        'nullable',
        'taxonomy_id',
        'channel_id',
        'channels_transversality',
        'language_transversality',
        'display_order',
        'data_source',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function form_blocs()
    {
        return $this->belongsToMany(FormBloc::class);
    }

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class, 'taxonomy_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
