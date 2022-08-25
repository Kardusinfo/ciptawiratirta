<?php
namespace Modules\User\Models;
use Modules\Media\Models\MediaFile;


class User extends \App\User
{
  protected $table = 'bc_candidate_skk';

    protected $fillable = [
        'file_id',
        'origin_id',
        'is_default',
        'create_user',
        'update_user'
    ];

    public function media(){
        return $this->hasOne(MediaFile::class, 'id', 'file_id');
    }
}
