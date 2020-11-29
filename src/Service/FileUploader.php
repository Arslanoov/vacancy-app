<?php

declare(strict_types=1);

namespace App\Service;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class FileUploader
{
    private string $dir;
    private string $prefix;

    public function __construct(string $dir, string $prefix)
    {
        $this->dir = $dir;
        $this->prefix = $prefix;
    }

    public function upload(UploadedFile $file): string
    {
        $uploaded = $file->move($this->dir, Uuid::uuid4()->toString() . $file->getClientOriginalExtension());
        return $this->prefix . $uploaded->getFilename();
    }
}
