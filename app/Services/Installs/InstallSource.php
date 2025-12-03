<?php

namespace App\Services\Installs;

interface InstallSource
{
  public static function installs(string $identifier): int;
}
