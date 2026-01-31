<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Vish4395\LaravelFileViewer\LaravelFileViewer;

class FilePreviewController extends Controller
{
  public function filePreview($fileName)
  {
    $filePath = 'site/documents/' . $fileName;
    $fileUrl = asset('storage/' . $filePath);
    return LaravelFileViewer::show($fileName, $filePath, $fileUrl);
  }

  public function fileDocumentPreview(Document $document)
  {
    $filePath = $document->file_path;
    $fileUrl = asset('storage/' . $filePath);
    return LaravelFileViewer::show($document->name, $filePath, $fileUrl);
  }
}
