<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//region ### Additional namespace #
//endregion

/**
 * App\Models\CalonYatama
 *
 * @property integer      $calon_id
 * @property null|Carbon  $tgl_masuk
 * @property null|integer $anak_ke
 * @property null|string  $tempat_lahir
 * @property null|string  $gender
 * @property null|integer $yatim_umur
 * @property string       $nama
 * @property null|integer $is_yatim
 * @property null|integer $is_sebelum_yatim
 * @property null|Carbon  $tgl_lahir
 * @property null|integer $user_id
 * @property null|Carbon  $created_at
 * @property null|Carbon  $updated_at
 *
 * @property-read Users   $usersUser
 *
 * @method static Builder|CalonYatama whereCalonId($value)
 * @method static Builder|CalonYatama whereTglMasuk($value)
 * @method static Builder|CalonYatama whereAnakKe($value)
 * @method static Builder|CalonYatama whereTempatLahir($value)
 * @method static Builder|CalonYatama whereGender($value)
 * @method static Builder|CalonYatama whereYatimUmur($value)
 * @method static Builder|CalonYatama whereNama($value)
 * @method static Builder|CalonYatama whereIsYatim($value)
 * @method static Builder|CalonYatama whereIsSebelumYatim($value)
 * @method static Builder|CalonYatama whereTglLahir($value)
 * @method static Builder|CalonYatama whereUserId($value)
 * @method static Builder|CalonYatama whereCreatedAt($value)
 * @method static Builder|CalonYatama whereUpdatedAt($value)
 *
 * @method static Builder|CalonYatama query()
 *
 * @method static Collection|CalonYatama[]     all($columns = ['*'])
 * @method static CalonYatama|null             find($id, $columns = ['*'])
 * @method static Collection|CalonYatama[]     findMany($ids, $columns = ['*'])
 * @method static CalonYatama                  findOrNew($id, $columns = ['*'])
 * @method static CalonYatama                  findOrFail($id, $columns = ['*'])
 * @method static CalonYatama|null             first($columns = ['*'])
 * @method static CalonYatama                  firstOrFail($columns = ['*'])
 * @method static CalonYatama                  firstOrNew($attributes, $values = array())
 * @method static CalonYatama                  firstOrCreate($attributes, $values = ['*'])
 * @method static CalonYatama                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|CalonYatama[]     get($columns = ['*'])
 */
class CalonYatama extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'calon_yatama';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'calon_id';

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
    public $timestamps = true;

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
        'calon_id',
        'tgl_masuk',
        'anak_ke',
        'tempat_lahir',
        'gender',
        'yatim_umur',
        'nama',
        'is_yatim',
        'is_sebelum_yatim',
        'tgl_lahir',
        'foto',
        'data_orangtua',
        'data_pengasuh',
        'user_id',
        'status',
        'alasan_tolak'
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
    protected $dates = [
        'tgl_masuk',
        'tgl_lahir',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'calon_id'         => 'integer',
        'anak_ke'          => 'integer',
        'tempat_lahir'     => 'string',
        'gender'           => 'string',
        'yatim_umur'       => 'integer',
        'nama'             => 'string',
        'is_yatim'         => 'string',
        'is_sebelum_yatim' => 'integer',
        'user_id'          => 'integer',
        'tgl_lahir'        => 'date:d-m-Y',
        'tgl_masuk'        => 'date:d-m-Y',
        'data_orangtua'    => 'string',
        'data_pengasuh'    => 'string',
    ];

    /**
     * @return BelongsTo|Builder|Users
     */
    public function usersUser()
    {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    //region ### User defined function #
    //endregion
}
