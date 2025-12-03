<?php

namespace App\Services\Installs;

use Illuminate\Support\Facades\Http;

class Obsidian implements InstallSource
{
  public static function installs(string $identifier): int
  {
    $response = Http::withHeaders([
      'Accept' => 'application/json'
    ])->get('https://raw.githubusercontent.com/obsidianmd/obsidian-releases/HEAD/community-plugin-stats.json');

    if ($response->failed()) {
      return 0;
    }

    $data = $response->json();

    return $data[strtolower($identifier)]['downloads'];
  }
}
