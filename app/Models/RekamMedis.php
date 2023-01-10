<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

//region ### Additional namespace #
//endregion

/**
 * App\Models\AnakAsuh
 *
 * @property integer                      $anakasuh_id
 * @property string                       $nama
 * @property null|string                  $tempat_lahir
 * @property null|Carbon                  $tgl_lahir
 * @property null|string                  $gender
 * @property null|integer                 $anak_ke
 * @property null|integer                 $is_yatim
 * @property null|integer                 $is_sebelum_yatim
 * @property null|integer                 $yatim_umur
 * @property null|Carbon                  $tgl_masuk
 * @property integer                      $is_alumni
 * @property null|Carbon                  $tgl_lulus
 * @property null|Carbon                  $created_at
 * @property null|Carbon                  $updated_at
 *
 * @property-read Collection|Kordes[]     $kordeses
 * @property-read Collection|Parents[]    $parentses
 * @property-read Collection|Pendidikan[] $pendidikans
 * @property-read Collection|Pengasuh[]   $pengasuhs
 * @property-read Dokumen                 $dokumen
 *
 * @method static Builder|AnakAsuh whereAnakasuhId($value)
 * @method static Builder|AnakAsuh whereNama($value)
 * @method static Builder|AnakAsuh whereTempatLahir($value)
 * @method static Builder|AnakAsuh whereTglLahir($value)
 * @method static Builder|AnakAsuh whereGender($value)
 * @method static Builder|AnakAsuh whereAnakKe($value)
 * @method static Builder|AnakAsuh whereIsYatim($value)
 * @method static Builder|AnakAsuh whereIsSebelumYatim($value)
 * @method static Builder|AnakAsuh whereYatimUmur($value)
 * @method static Builder|AnakAsuh whereTglMasuk($value)
 * @method static Builder|AnakAsuh whereIsAlumni($value)
 * @method static Builder|AnakAsuh whereTglLulus($value)
 * @method static Builder|AnakAsuh whereCreatedAt($value)
 * @method static Builder|AnakAsuh whereUpdatedAt($value)
 *
 * @method static Builder|AnakAsuh query()
 *
 * @method static Collection|AnakAsuh[]     all($columns = ['*'])
 * @method static AnakAsuh|null             find($id, $columns = ['*'])
 * @method static Collection|AnakAsuh[]     findMany($ids, $columns = ['*'])
 * @method static AnakAsuh                  findOrNew($id, $columns = ['*'])
 * @method static AnakAsuh                  findOrFail($id, $columns = ['*'])
 * @method static AnakAsuh|null             first($columns = ['*'])
 * @method static AnakAsuh                  firstOrFail($columns = ['*'])
 * @method static AnakAsuh                  firstOrNew($attributes, $values = array())
 * @method static AnakAsuh                  firstOrCreate($attributes, $values = ['*'])
 * @method static AnakAsuh                  updateOrCreate($attributes, $values = ['*'])
 * @method static Collection|AnakAsuh[]     get($columns = ['*'])
 */
class RekamMedis extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rekam_medis';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rekam_medis_id';

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
        'rekam_medis_id',
        'tgl_periksa',
        'keluhan',
        'diagnosa',
        'obat',
        'keterangan',
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
    protected $dates = [
        'tgl_periksa',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'rekam_medis_id'=> 'integer',
        'tgl_periksa'   => 'date:d-m-Y',
        'keluhan'       => 'string',
        'diagnosa'      => 'string',
        'obat'          => 'string',
        'keterangan'    => 'string',
        'anakasuh_id'   => 'integer',
    ];

    /**
     * @return HasOne|Builder|Dokumen
     */
    public function anakasuh()
    {
        return $this->hasOne(AnakAsuh::class, 'anakasuh_id', 'anakasuh_id');
    }
}
