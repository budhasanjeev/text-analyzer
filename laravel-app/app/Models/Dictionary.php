<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dictionary
 * 
 * @property int      id
 * @property varchar  jp_word
 * @property varchar  en_translation
 * @property char     deleted_flag
 * @property datetime created_at
 * @property datetime updated_at
 */ 

class Dictionary extends Model
{
    /** @var string */
    protected $table = 'dictionary_tbl';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $fillable = [
        'jp_word',
        'en_translation',
        'created_at',
        'updated_at'
    ];

    public const DELETED_FLAG = 'deleted_flag';

    public static function booted(): void
    {
        static::addGlobalScope('deleted', function (Builder $builder) {
            $builder->where(static::DELETED_FLAG, 0);
        });
    }
}