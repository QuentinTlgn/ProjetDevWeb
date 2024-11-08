document.addEventListener("DOMContentLoaded", function () {
    let images = [];
    let currentImageIndex = 0;
    let loadedImages = {}; // Stocke les images chargées

    // Fonction pour charger les images à partir du fichier XML
    function loadImagesFromXML() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../imageViewerContent.xml", true); // Remplacez par le chemin vers votre fichier XML
        xhr.onload = function () {
            if (xhr.status === 200) {
                const xmlDoc = xhr.responseXML;
                const imageElements = xmlDoc.getElementsByTagName("image");

                // Parcourir les éléments d'image dans le XML
                for (let i = 0; i < imageElements.length; i++) {
                    const title = imageElements[i].getElementsByTagName("title")[0].textContent;
                    let path = imageElements[i].getElementsByTagName("path")[0].textContent;

                    // Reconstruire l'URL complète
                    path = `https://ruedespotiers.kubel.tech${path}`; 

                    images.push({ title, path }); // Ajouter l'image à la liste
                }

                // Charger la première image après avoir récupéré toutes les images
                loadImage();
            }
        };
        xhr.send();
    }

    // Fonction pour charger et afficher l'image
    function loadImage() {
        const currentImage = images[currentImageIndex];
        const imgUrl = currentImage.path; // URL de l'image originale
        const resizedUrl = `https://ruedespotiers.kubel.tech/php/img_resizer.php?imageUrl=${encodeURIComponent(imgUrl)}&width=600&height=400`;

        // Vérification si l'image est déjà chargée
        if (loadedImages[resizedUrl]) {
            displayImage(loadedImages[resizedUrl], currentImage.title); // Afficher l'image directement
        } else {
            // Chargement de l'image redimensionnée
            const img = new Image();
            img.src = resizedUrl;

            img.onload = function() {
                loadedImages[resizedUrl] = img; // Stocker l'image chargée
                displayImage(img, currentImage.title);
            };

            img.onerror = function() {
                // Gestion d'erreur si l'image ne peut pas être chargée
                console.error("Erreur lors du chargement de l'image :", resizedUrl);
            };
        }
    }

    // Fonction pour afficher l'image dans le viewer
    function displayImage(img, title) {
        const imageViewer = document.getElementById("image-viewer");
        imageViewer.innerHTML = `<img src="${img.src}" alt="${title}" class="viewer-img" />`;
    }

    // Fonction pour passer à l'image suivante
    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length; // Retourne à la première image après la dernière
        loadImage();
    }

    // Démarre le chargement des images depuis le XML
    loadImagesFromXML();
    setInterval(nextImage, 6000); // Change d'image toutes les 3 secondes
});