<?php

/**
 * Redimensionne une image à partir d'une URL en conservant la transparence.
 *
 * @param string $imageUrl URL de l'image source.
 * @param int $newWidth Nouvelle largeur de l'image.
 * @param int $newHeight Nouvelle hauteur de l'image.
 * @return array Un tableau contenant le contenu de l'image redimensionnée et son type MIME.
 * @throws Exception Si une erreur se produit lors du traitement de l'image.
 */
function resizeImageFromUrl(string $imageUrl, int $newWidth, int $newHeight): array
{
    // Validation de l'URL
    if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
        throw new Exception("URL invalide : $imageUrl");
    }

    // Récupération du contenu de l'image depuis l'URL
    $imageContent = file_get_contents($imageUrl);
    if ($imageContent === false) {
        throw new Exception("Erreur lors de la récupération de l'image.");
    }

    // Création de l'image à partir du contenu
    $image = imagecreatefromstring($imageContent);
    if ($image === false) {
        throw new Exception("Erreur lors de la création de l'image à partir du contenu.");
    }

    // Récupération des dimensions et du format d'origine
    $originalWidth = imagesx($image);
    $originalHeight = imagesy($image);
    $imageInfo = getimagesizefromstring($imageContent);
    $originalFormat = $imageInfo[2];

    // Création d'une nouvelle image avec les nouvelles dimensions
    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

    // Conservation de la transparence pour les PNG et GIF
    if (in_array($originalFormat, [IMAGETYPE_PNG, IMAGETYPE_GIF])) {
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
        imagefill($resizedImage, 0, 0, imagecolorallocatealpha($resizedImage, 0, 0, 0, 127));
    }

    // Redimensionnement de l'image
    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    // Capture de la sortie de la fonction d'image
    ob_start();

    // Enregistrement de l'image redimensionnée dans le format approprié
    switch ($originalFormat) {
        case IMAGETYPE_GIF:
            imagegif($resizedImage);
            $contentType = 'image/gif';
            break;
        case IMAGETYPE_JPEG:
            imagejpeg($resizedImage, null, 70); // Qualité JPEG à 70%
            $contentType = 'image/jpeg';
            break;
        default:
            imagepng($resizedImage, null, 2); // Compression PNG niveau 2 0-9 
            $contentType = 'image/png';
            break;
    }
    $resizedImageContent = ob_get_clean();

    // Libération des ressources
    imagedestroy($image);
    imagedestroy($resizedImage);

    // Retourne le contenu et le type de contenu de l'image redimensionnée
    return ['content' => $resizedImageContent, 'contentType' => $contentType];
}

// Vérification si la requête est une requête GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        // Vérification si les paramètres nécessaires sont présents dans l'URL
        if (!isset($_GET['imageUrl'], $_GET['width'], $_GET['height'])) {
            throw new Exception("Paramètres manquants dans l'URL.");
        }

        // Récupération des paramètres de l'URL
        $imageUrl = $_GET['imageUrl'];
        $width = (int)$_GET['width'];
        $height = (int)$_GET['height'];

        // Appel de la fonction de redimensionnement
        $resizedImageData = resizeImageFromUrl($imageUrl, $width, $height);

        // Envoi des en-têtes HTTP pour l'image redimensionnée
        header('Content-Type: ' . $resizedImageData['contentType']);
        header('Cache-Control: public, max-age=31536000'); // Cache pendant 1 an
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');

        // Affichage de l'image redimensionnée
        echo $resizedImageData['content'];

    } catch (Exception $e) {
        // Affichage d'un message d'erreur en cas d'exception
        echo "Erreur : " . $e->getMessage();
    }
}
?>