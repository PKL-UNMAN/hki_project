<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Apikeys;
use Illuminate\Support\Str;

class GenerateApiKey extends Command
{
    protected $signature = 'api:key';

    protected $description = 'Generate a new API key';

    public function handle()
    {
        $apiKey = Str::random(32);

        Apikeys::create([
            'client_name' => 'PLC', // Nama PLC atau klien
            'api_key' => $apiKey,
        ]);

        $this->info("New API key generated: $apiKey");
        return $apiKey;
    }
}
