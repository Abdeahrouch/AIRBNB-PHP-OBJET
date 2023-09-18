<?php

namespace App\Model\Repository;

use PDO;
use App\Model;

use App\Model\Photos;
use Core\Repository\Repository;

class PhotoRepository extends Repository
{
    public function getTableName(): string
    {
        return 'photos';
    }

    public function getPhotos($id)
    {

        $images = [];
        $q = sprintf('SELECT * FROM %s WHERE annonces_id = :id', $this->getTableName());

        $stmt = $this->pdo->prepare($q);

        if (!$stmt) return null;

        $stmt->execute(['id' => $id]);

        while ($image_data = $stmt->fetch()) {
            $images[] = new Photos($image_data);
        }
        return $images;
    }

    public function createPhoto($photo)
    {
        $request = sprintf(
            "INSERT INTO %s (image_path, annonces_id) VALUES (:image_path, :annonces_id)",
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($request);

        $stmt->execute([
            'image_path' => $photo->image_path,
            'annonces_id' => $photo->annonces_id
        ]);
        return null;
    }
}
