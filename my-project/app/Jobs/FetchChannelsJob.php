<?php

namespace App\Jobs;

use App\Services\ExtremeService;
use App\Models\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class FetchChannelsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function handle(ExtremeService $extreme)
    {
        $channels = $extreme->fetchChannels($this->code);
        foreach ($channels as $ch) {
            $payload = [
                'name' => $ch['name'] ?? ($ch['title'] ?? 'Unknown'),
                'identifier' => $ch['identifier'] ?? ($ch['id'] ?? uniqid('ch_')),
                'meta' => $ch,
            ];
            Channel::updateOrCreate(['identifier' => $payload['identifier']], $payload);
        }
    }
}
