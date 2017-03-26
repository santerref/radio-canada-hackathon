<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MicrosoftAzureJob extends Model
{

    const JOB_STATUS_MAP = ['Queued', 'Scheduled', 'Processing', 'Finished', 'Error', 'Canceled', 'Canceling'];

    protected $fillable = ['asset_id', 'job_id', 'media_id', 'status'];

}
