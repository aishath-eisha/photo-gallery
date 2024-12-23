// Example of adding a light animation to the form when loaded
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.container').style.animation = 'zoomIn 1s ease-out';
});

@keyframes zoomIn {
    0% {
        transform: scale(0.8);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
