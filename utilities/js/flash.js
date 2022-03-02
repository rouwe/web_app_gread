(function flashMessage() {
    // Display message container
    const messageContainer = document.querySelector('#flash-message');
    const childLength = messageContainer.children.length;
    let messageLength = 0;
    if (childLength > 1) {
        messageLength = document.getElementsByClassName('notification-message')[0].innerHTML.length;
        messageContainer.style.display = 'flex';
        messageContainer.style.opacity = 1;
        messageContainer.style.bottom = '1.5rem';
    }
    const hideMessage = () => {
        // Hide message container
        messageContainer.style.bottom = '-10rem';
        setTimeout(() => {
            messageContainer.style.display = 'none';
        }, 2000);
    }
    // Make flash message duration depends on the length of message
    if (messageLength <= 40) {
        setTimeout(hideMessage, 3000);
    } else {
        const timePerChar = 25;
        const duration = 3000 + (messageLength * timePerChar);
        setTimeout(hideMessage, duration);
    }
})();