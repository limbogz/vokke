<?php

namespace App\Services\Kangaroo\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Kangaroo
 *
 * @author Limuel Bassig
 * @since 2023.09.07
 * @package App\Services\Kangaroo\Models
 */
class Kangaroo extends Model
{
    /**
     * @var string
     */
    protected $table = 'kangaroos';

    /**
     * @var string
     */
    protected $primaryKey = 'kangaroo_id';

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'weight',
        'height',
        'gender',
        'color',
        'friendliness',
        'birthday'
    ];

}
