<?php

namespace App\Console\Commands;

use App\MicrosoftAzureJob;
use Illuminate\Console\Command;
use WindowsAzure\Common\Internal\MediaServicesSettings;
use WindowsAzure\Common\ServicesBuilder;

class UpdateJobStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'azure:update-job-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update job statuses.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $restProxy = ServicesBuilder::getInstance()->createMediaServicesService(
            new MediaServicesSettings('lunfelhackathon', '8rPzGIYyFP3agGrLrfwDNLu7igKS3KMe5C8LLaKY/Zw=')
        );

        $jobs = MicrosoftAzureJob::all();

        foreach ($jobs as $job) {
            $azureJob = $restProxy->getJob($job->job_id);
            $result = $restProxy->getJobStatus($azureJob);
            $job->status = MicrosoftAzureJob::JOB_STATUS_MAP[$result];
            $job->save();
        }
    }
}
