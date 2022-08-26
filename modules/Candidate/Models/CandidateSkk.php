<?php

namespace Modules\Candidate\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Models\MediaFile;


class CandidateSkk extends BaseModel
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
