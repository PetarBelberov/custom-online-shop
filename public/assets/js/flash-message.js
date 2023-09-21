setTimeout(function() {
    var flashMessage = document.querySelector('.flash-message');
    if (flashMessage) {
        flashMessage.remove();
    }
}, 5000); // 5000 milliseconds = 5 seconds