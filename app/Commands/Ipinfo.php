<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use LaravelZero\Framework\Commands\Command;

use function Termwind\{render};

class Ipinfo extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'ipinfo';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Get ip info from ip-api.com';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ipInfo = Http::get('http://ip-api.com/json')->json();

        render(<<<HTML
                <div class="px-1 my-1">
                    <span class="mr-1">
                        IP Address:
                    </span>
                    <span class="px-1 bg-blue-300 text-black">{$ipInfo['query']}</span>
                    <div class="mt-1">
                        <div class="flex space-x-1">
                            <span class="font-bold">Country</span>
                            <span class="flex-1 content-repeat-['.'] text-gray"></span>
                            <span class="text-green">{$ipInfo['country']}</span>
                        </div>
                        <div class="flex space-x-1">
                            <span class="font-bold">Region</span>
                            <span class="flex-1 content-repeat-['.'] text-gray"></span>
                            <span class="text-green">{$ipInfo['regionName']}</span>
                        </div>
                        <div class="flex space-x-1">
                            <span class="font-bold">City</span>
                            <span class="flex-1 content-repeat-['.'] text-gray"></span>
                            <span class="text-green">{$ipInfo['city']}</span>
                        </div>
                        <div class="flex space-x-1">
                            <span class="font-bold">Timezone</span>
                            <span class="flex-1 content-repeat-['.'] text-gray"></span>
                            <span class="text-green">{$ipInfo['timezone']}</span>
                        </div>
                        <div class="flex space-x-1">
                            <span class="font-bold">ISP</span>
                            <span class="flex-1 content-repeat-['.'] text-gray"></span>
                            <span class="text-green">{$ipInfo['isp']}</span>
                        </div>
                    </div>
                </div>
            HTML);
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
