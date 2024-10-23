<?php

/**
* Récupère une image à partir d'une URL, la redimensionne et la retourne.
*
* @param string $imageUrl L'URL de l'image à récupérer.
* @param int $newWidth La nouvelle largeur de l'image.
* @param int $newHeight La nouvelle hauteur de l'image.
* @return string L'image redimensionnée au format JPEG.
* @throws Exception Si l'image ne peut pas être récupérée ou redimensionnée.
*/
function resizeImageFromUrl(string $imageUrl, int $newWidth, int $newHeight): string
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
    
    // Créer une nouvelle image avec les nouvelles dimensions
    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
    // Redimensionner l'image originale et la copier dans la nouvelle image
    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
    
    // Démarrer la mise en mémoire tampon de sortie
    ob_start();
    
    // Envoyer l'image redimensionnée au format JPEG
    imagejpeg($resizedImage);
    
    // Récupérer le contenu de l'image redimensionnée à partir du tampon de sortie
    $resizedImageContent = ob_get_clean();
    
    // Libérer les ressources
    imagedestroy($image);
    imagedestroy($resizedImage);
    
    // Retourner l'image redimensionnée au format JPEG
    return $resizedImageContent;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if(!isset(($_GET['imageUrl'])) || (!isset($_GET['width'])) || (!isset($_GET['height']))){
            echo "Mauvais nombre d'argument fournis";
            exit();
        }
        
        $imageUrl = $_GET['imageUrl'];
        $width = $_GET['width'];
        $height = $_GET['height'];
        
        $resizedImage = resizeImageFromUrl($imageUrl, $width, $height);

        // Définir les en-têtes pour la mise en cache
        header('Content-Type: image/jpeg');
        header('Cache-Control: public, max-age=31536000'); // Cache pendant 1 an
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');

        // Afficher l'image redimensionnée (depuis le cache ou nouvellement générée)
        echo $resizedImage;
    } catch (Exception $e) {
        // Gérer les erreurs
        echo "Erreur : " . $e->getMessage();
    }
}
?>