(function menuSystem() {
    // Controls the mobile menu
    const openMenuButton = document.getElementsByClassName('open-menu')[0];
    const closeMenuButton = document.getElementsByClassName('close-menu')[0];
    const navigationBox = document.getElementsByClassName('navigation')[0];
    const header = document.getElementsByClassName('header-container')[0];
    const mainContainer = document.getElementsByClassName('main-container')[0];
    // Functionalities
    const openMenu = () => {
        // Display the navigation menu
        console.log(openMenuButton);
        openMenuButton.style.display = 'none';
        closeMenuButton.style.display = 'block';
        navigationBox.style.display = 'flex';
        header.style.borderBottomWidth = '2.5px';
        header.style.borderBottomColor = 'var(--primary)';
        mainContainer.style.marginTop = '266px';
        menuIsActive = true;
    }
    const closeMenu = () => {
        // Closes the navigation menu
        console.log(closeMenuButton);
        openMenuButton.style.display = 'block';
        closeMenuButton.style.display = 'none';
        navigationBox.style.display = 'none';
        header.style.borderBottomWidth = '1.5px';
        header.style.borderBottomColor = '#999999CC';
        mainContainer.style.marginTop = '0px';
    }
    // Add Event Listener
    openMenuButton.addEventListener('click', openMenu);
    closeMenuButton.addEventListener('click', closeMenu);
})();