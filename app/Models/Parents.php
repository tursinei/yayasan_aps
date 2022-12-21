<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//region ### Additional namespace #
//endregion

/**
 * App\Models\Parents
 *
 * @property integer       $parent_id
 * @property string        $nama
 * @property integer       $is_ayah
 * @property null|string   $pekerjaan
 * @property null|string   $alamat
 * @property integer       $anakasuh_id
 *
 * @property-read AnakAsuh $anakAsuh
 *
 * @method static Builder|Parents whereParentId($value)
 * @method static Builder|Parents whereNama($value)
 * @method static Builder|Parents whereIsAyah($value)
 * @method static Builder|Parents wherePekerjaan($value)
 * @method static Builder|Parents whereAlamat($value)
 * @method static Builder|Parents whereAnakasuhId($value)
 *
 * @method static Builder|Parents query()
 *
 * @method static Collection|Parents[]     all($columns = ['*'])
 * @method static Parents|null             find($id, $columns = ['*'])
 * @method static Collection|Parents[]     findMany($ids, $columns = ['*'])
 * @method static Parents                  findOrNew($id, $columns = ['*'])
 * @method static Parents                  findOrFail($id, $columns = ['*'])
 * @method static Parents|null             first($columns = ['*'])
 * @method static Parents                  firstOrFail($columns = ['*'])
 * @method static Parents                  firstOrNew($attributes, $values = array())
 * @method static Parents                  firstOrCreate($attributes, $values = ['*'])
 * @method static Parents                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|Parents[]     get($columns = ['*'])
 */
class Parents extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parents';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'parent_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'nama',
        'is_ayah',
        'pekerjaan',
        'alamat',
        'anakasuh_id',
    ];

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_id'   => 'integer',
        'nama'        => 'string',
        'is_ayah'     => 'integer',
        'pekerjaan'   => 'string',
        'alamat'      => 'string',
        'anakasuh_id' => 'integer',
    ];

    /**
     * @return BelongsTo|Builder|AnakAsuh
     */
    public function anakAsuh()
    {
        return $this->belongsTo('App\Models\AnakAsuh', 'anakasuh_id', 'anakasuh_id');
    }

    //region ### User defined function #
    //endregion
}
