<?php

/**
* Récupère une image à partir d'une URL, la redimensionne tout en conservant la transparence, et la retourne.
*
* @param string $imageUrl L'URL de l'image à récupérer.
* @param int $newWidth La nouvelle largeur de l'image.
* @param int $newHeight La nouvelle hauteur de l'image.
* @return string L'image redimensionnée au format d'origine ou PNG si indéterminé.
* @throws Exception Si l'image ne peut pas être récupérée ou redimensionnée.
*/
function resizeImageFromUrl(string $imageUrl, int $newWidth, int $newHeight): array
{
    // Récupérer l'image à partir de l'URL
    $imageContent = file_get_contents($imageUrl);
    if ($imageContent === false) {
        throw new Exception("Impossible de récupérer l'image à partir de l'URL : $imageUrl");
    }
    
    // Créer une image à partir du contenu
    $image = imagecreatefromstring($imageContent);
    if ($image === false) {
        throw new Exception("Impossible de créer une image à partir du contenu.");
    }
    
    // Obtenir les dimensions de l'image originale
    $originalWidth = imagesx($image);
    $originalHeight = imagesy($image);

    // Déterminer le format de l'image d'origine
    $imageInfo = getimagesizefromstring($imageContent);
    $originalFormat = $imageInfo[2]; // 1 = GIF, 2 = JPG, 3 = PNG

    // Créer une nouvelle image avec les nouvelles dimensions
    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

    // Gérer la transparence pour les formats PNG et GIF
    if ($originalFormat == IMAGETYPE_PNG || $originalFormat == IMAGETYPE_GIF) {
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
        $transparent = imagecolorallocatealpha($resizedImage, 0, 0, 0, 127);
        imagefill($resizedImage, 0, 0, $transparent);
    }

    // Redimensionner l'image originale et la copier dans la nouvelle image
    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
    
    // Démarrer la mise en mémoire tampon de sortie
    ob_start();
    
    // Envoyer l'image redimensionnée au format d'origine ou PNG si indéterminé
    switch ($originalFormat) {
        case IMAGETYPE_GIF:
            imagegif($resizedImage);
            $contentType = 'image/gif';
            break;
        case IMAGETYPE_JPEG:
            imagejpeg($resizedImage, null, 100); // Qualité maximale pour JPEG
            $contentType = 'image/jpeg';
            break;
        case IMAGETYPE_PNG:
            imagepng($resizedImage, null, 0); // Compression maximale pour PNG 
            $contentType = 'image/png';
            break;
        default:
            imagepng($resizedImage, null, 0); // Compression maximale pour PNG par défaut
            $contentType = 'image/png';
            break;
    }
    
    // Récupérer le contenu de l'image redimensionnée à partir du tampon de sortie
    $resizedImageContent = ob_get_clean();
    
    // Libérer les ressources
    imagedestroy($image);
    imagedestroy($resizedImage);
    
    // Retourner l'image redimensionnée et son type MIME
    return ['content' => $resizedImageContent, 'contentType' => $contentType];
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['imageUrl']) || !isset($_GET['width']) || !isset($_GET['height'])) {
            echo "Mauvais nombre d'argument fournis";
            exit();
        }
        
        $imageUrl = $_GET['imageUrl'];
        $width = (int)$_GET['width'];
        $height = (int)$_GET['height'];
        
        $resizedImageData = resizeImageFromUrl($imageUrl, $width, $height);

        // Définir les en-têtes pour la mise en cache et le type d'image
        header('Content-Type: ' . $resizedImageData['contentType']);
        header('Cache-Control: public, max-age=31536000'); // Cache pendant 1 an
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');

        // Afficher l'image redimensionnée
        echo $resizedImageData['content'];
    } catch (Exception $e) {
        // Gérer les erreurs
        echo "Erreur : " . $e->getMessage();
    }
}
?>