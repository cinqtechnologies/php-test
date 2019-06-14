<?php

declare(strict_types=1);

namespace Ecommerce\Business;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class UploadBusiness extends BusinessAbstract
{
    private $file;
    private $path;

    public function setFile(array $file): self
    {
        $this->file = $file;
        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function upload(): string
    {
        if (empty($this->file['logo'])) {
            return '';
        }

        $uploadedFile = $this->file['logo'];

        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            return '';
        }

        $extension = end(explode('.', $uploadedFile->getClientFilename()));
        $uploadFileName = sprintf('%s.%s', time(), $extension);
        $filePath = sprintf('%s%s', $this->path, $uploadFileName);
        $uploadedFile->moveTo($filePath);

        return $filePath;
    }
}
