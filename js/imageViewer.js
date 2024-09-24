document.addEventListener("DOMContentLoaded", function () {
    const images = ["/images/pot1.jpg", "/images/pot2.jpg"];
    let currentImageIndex = 0;

    // Fonction pour charger et afficher l'image
    function loadImage() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", images[currentImageIndex], true);
        xhr.responseType = "blob";

        xhr.onload = function () {
            if (xhr.status === 200) {
                const imgBlob = xhr.response;
                const imgUrl = URL.createObjectURL(imgBlob);
                
                // Mise à jour de l'image dans le viewer
                const imageViewer = document.getElementById("image-viewer");
                imageViewer.innerHTML = `<img src="${imgUrl}" alt="Image ${currentImageIndex + 1}" class="viewer-img" />`;

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

    // Démarre le défilement des images
    loadImage();
    setInterval(nextImage, 3000); // Change d'image toutes les 3 secondes
});
