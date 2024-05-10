document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.show-all-images').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            var galleryId = this.getAttribute('data-lightbox');


            document.querySelectorAll(`[data-lightbox="${galleryId}"]`).forEach(function (image) {
                image.style.display = 'block';
            });

            document.querySelector(`[data-lightbox="${galleryId}"]`).click();
        });
    });
});


