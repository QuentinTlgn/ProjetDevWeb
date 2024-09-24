document.addEventListener("DOMContentLoaded", function () {
    let images = [];
    let currentImageIndex = 0;

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
                    const path = imageElements[i].getElementsByTagName("path")[0].textContent;
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
        const xhr = new XMLHttpRequest();
        xhr.open("GET", images[currentImageIndex].path, true);
        xhr.responseType = "blob";

        xhr.onload = function () {
            if (xhr.status === 200) {
                const imgBlob = xhr.response;
                const imgUrl = URL.createObjectURL(imgBlob);
                
                // Mise à jour de l'image dans le viewer
                const imageViewer = document.getElementById("image-viewer");
                imageViewer.innerHTML = `<img src="${imgUrl}" alt="${images[currentImageIndex].title}" class="viewer-img" />`;

                // Révoquer l'URL une fois que l'image est chargée
                imageViewer.querySelector('img').onload = function() {
                    URL.revokeObjectURL(imgUrl);
                };
            }
        };

        xhr.send();
    }

    // Fonction pour passer à l'image suivante
    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length; // Retourne à la première image après la dernière
        loadImage();
    }

    // Démarre le chargement des images depuis le XML
    loadImagesFromXML();
    setInterval(nextImage, 3000); // Change d'image toutes les 3 secondes
});
