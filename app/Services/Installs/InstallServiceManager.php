<?php

namespace App\Services\Installs;

use InvalidArgumentException;

class InstallServiceManager
{
  public static function make(string $service): InstallSource
  {
    return match ($service) {
      'vscode' => new Vscode(),
      'obsidian' => new Obsidian(),
      default => throw new InvalidArgumentException("Unknown install source: {$service}")
    };
  }
}
