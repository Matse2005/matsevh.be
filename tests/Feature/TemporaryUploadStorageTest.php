<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;

// Anonymous visitors can upload temporary files through any Filament page,
// the login page included, so these files must never land in a web-served folder.
it('stores livewire temporary uploads outside the public storage folder', function () {
    // FileUploadConfiguration::disk() returns a fake disk under tests, so resolve it the way production does.
    $disk = config('livewire.temporary_file_upload.disk') ?: config('filesystems.default');

    expect(Storage::disk($disk)->path(''))->not->toStartWith(storage_path('app/public'));
});

it('keeps the default local disk private', function () {
    expect(Storage::disk('local')->path(''))->not->toStartWith(storage_path('app/public'));
});

it('rejects php files as livewire temporary uploads', function (string $name) {
    $file = UploadedFile::fake()->create($name, 1, 'application/x-php');

    $validator = Validator::make(['file' => $file], ['file' => FileUploadConfiguration::rules()]);

    expect($validator->fails())->toBeTrue();
})->with(['shell.php', 'SHELL.PHP', 'shell.phtml', 'shell.phar', 'shell.jpg.php']);

it('accepts images and documents as livewire temporary uploads', function (string $name) {
    $file = UploadedFile::fake()->create($name, 10);

    $validator = Validator::make(['file' => $file], ['file' => FileUploadConfiguration::rules()]);

    expect($validator->fails())->toBeFalse();
})->with(['photo.jpg', 'logo.png', 'logo.svg', 'cv.pdf', 'letter.docx']);
