<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soraah extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'soraahs';

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
     * Soraah has many ayaat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ayaat()
    {
        return $this->hasMany(Ayaat::class, 'soraah_id');
    }
}
