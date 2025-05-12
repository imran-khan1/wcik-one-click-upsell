document.addEventListener('DOMContentLoaded', function () {
    
    const upsellModal = document.getElementById('wcik-upsell-modal');
    const closeModalButton = document.getElementById('wcik-close-modal');

    // Check if the close button exists before adding event listeners
    if (closeModalButton) {
        // Display the upsell modal after a short delay
        setTimeout(function () {
             console.log(122);
            upsellModal.style.display = 'block';
           
        }, 3000); // Display after 3 seconds

        // Close the modal when the close button is clicked
        closeModalButton.addEventListener('click', function () {
            upsellModal.style.display = 'none';
             console.log(132);
        });
    }

    // Close the modal if the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (event.target === upsellModal) {
            upsellModal.style.display = 'none';
             console.log(142);
        }
    });
});