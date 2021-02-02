<?php

declare(strict_types=1);

namespace Common\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BaseJob implements ShouldQueue
{
    protected $eventsAfterProcessing = [];

    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
}
