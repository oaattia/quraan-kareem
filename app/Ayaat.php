<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ayaat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ayaats';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * Ayah belong to one Soraah
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soraah()
    {
        return $this->belongsTo(Soraah::class, 'soraah_id');
    }
}
