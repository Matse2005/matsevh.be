<?php

namespace App\Services\Installs;

use Illuminate\Support\Facades\Http;

class Vscode implements InstallSource
{
  public static function installs(string $identifier): int
  {
    $payload = [
      'filters' => [
        [
          'criteria' => [
            ['filterType' => 7, 'value' => $identifier]
          ]
        ]
      ],
      'flags' => 914
    ];


    $response = Http::withHeaders([
      'Accept' => 'application/json;api-version=6.1-preview.1'
    ])->post('https://marketplace.visualstudio.com/_apis/public/gallery/extensionquery', $payload);

    if ($response->failed()) {
      return 0;
    }

    $data = $response->json();

    $stats = $data['results'][0]['extensions'][0]['statistics'] ?? [];

    foreach ($stats as $stat) {
      if ($stat['statisticName'] === 'install') {
        return (int) $stat['value'];
      }
    }

    return 0;
  }
}
