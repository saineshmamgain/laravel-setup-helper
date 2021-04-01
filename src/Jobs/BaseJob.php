<?php

namespace SaineshMamgain\SetupHelper\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * File: BaseJob.php
 * Author: Sainesh Mamgain
 * Email: saineshmamgain@gmail.com
 * Date: 12/03/21
 * Time: 8:52 PM.
 */
abstract class BaseJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
}
