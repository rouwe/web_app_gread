let menuIsOpen = false;
(function menuSystem() {
    // Controls the mobile menu
    const openMenuButton = document.getElementsByClassName('open-menu')[0];
    const closeMenuButton = document.getElementsByClassName('close-menu')[0];
    const navigationBox = document.getElementsByClassName('navigation')[0];
    const header = document.getElementsByClassName('header-container')[0];
    const mainContainer = document.getElementsByClassName('main-container')[0];
    // Functionalities
    const openMenu = (marginTop = '266px') => {
        // Display the navigation menu
        openMenuButton.style.display = 'none';
        closeMenuButton.style.display = 'block';
        navigationBox.style.display = 'flex';
        header.style.borderBottomWidth = '2.5px';
        header.style.borderBottomColor = 'var(--primary)';
        mainContainer.style.marginTop = marginTop;
        menuIsOpen = true;
    }
    const closeMenu = () => {
        // Closes the navigation menu
        openMenuButton.style.display = 'block';
        closeMenuButton.style.display = 'none';
        navigationBox.style.display = 'none';
        header.style.borderBottomWidth = '1.5px';
        header.style.borderBottomColor = '#999999CC';
        mainContainer.style.marginTop = '0px';
        menuIsOpen = false;
    }
    // Add Event Listener
    openMenuButton.addEventListener('click', openMenu);
    closeMenuButton.addEventListener('click', closeMenu);
})();
(function checkViewWidth() {
    /* Checks if the screen width matches that of a mobile or tablet device.
    * Changes the top margin of main content depending on the viewport
    */
    function changeMarginTop(screenWidth) {
        // 
        const mainContainer = document.getElementsByClassName('main-container')[0];
        if (menuIsOpen) {
            // console.log(screenWidth, menuIsOpen);
            if (screenWidth <= 375) {mainContainer.style.marginTop = '266px';}
            else if (screenWidth <= 425) {mainContainer.style.marginTop = '267px';}
            else if (screenWidth <= 500) {mainContainer.style.marginTop = '273px';}
            else if (screenWidth <= 568) {mainContainer.style.marginTop = '280px';}
            else if (screenWidth <= 640) {mainContainer.style.marginTop = '288px';}
            else if (screenWidth <= 768 || screenWidth <= 836) {mainContainer.style.marginTop = '299px';}
        } else {
            mainContainer.style.marginTop = '0px';
        }
    }
    setInterval(() => {
        const screenWidthTrack = setInterval(() => {
            // console.log("Check screen width!");
            changeMarginTop(window.innerWidth);
        }, 1000);
        if (window.innerWidth >= 836) {
            clearInterval(screenWidthTrack);
            changeMarginTop(window.innerWidth);
        } else {
            screenWidthTrack;
        }
    }, 50);
})();
