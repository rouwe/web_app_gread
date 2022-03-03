let menuIsOpen = false;
(function menuSystem() {
    // Controls the mobile menu for
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
    * Changes the top margin of main content and navigation depending on the viewport
    */
    function changeMarginTop(screenWidth) {
        // 
        const mainContainer = document.getElementsByClassName('main-container')[0];
        const navigation = document.getElementsByClassName('navigation')[0];
        if (menuIsOpen) {
            // console.log(screenWidth, menuIsOpen);
            const navHeight = document.getElementsByClassName('navigation-outline')[0].offsetHeight;
            const headerHeight = document.getElementsByClassName('header-container')[0].offsetHeight;
            // console.log(navHeight)
            if (screenWidth <= 500) {
                mainContainer.style.marginTop = `${navHeight + 5}px`;
                navigation.style.top = `${headerHeight}px`;
            }
            else if (screenWidth <= 568) {
                mainContainer.style.marginTop = `${navHeight + 4}px`
                navigation.style.top = `${headerHeight}px`;
            }
            else if (screenWidth <= 1024) {
                mainContainer.style.marginTop = `${navHeight + 5}px`;
                navigation.style.top = `${headerHeight}px`;
        }
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
    }, 100);
})();
(function activePage() {
    // Controls the look of the active page
    const pagesURL = {
        home: {
            href: './'
        },
        add: {
            href: './add'
        },
        edit: {
            href: './edi'
        },
        delete: {
            href: './del'
        },
        about: {
            href: './abo'
        }
    }
    let currentPageURL = document.URL;
    const splitURL = currentPageURL.split('/');
    const targURL = splitURL.slice(-1);
    pageActionURL = './' + targURL[0].slice(0,3);
    for (const page in pagesURL ) {
        if (pagesURL[page].href === pageActionURL) {
            let targetElement = document.getElementById(`${page}`);
            let targetElementBox = targetElement.firstElementChild;
            let iconPath = targetElementBox.firstElementChild.firstElementChild;
            targetElementBox.style.backgroundColor = 'var(--active)';
            targetElementBox.style.boxShadow = '0px 0px 2px #FFFFFF'; 
            iconPath.style.stroke = '#FFFFFFE6';
        }
    }
    // Page that uses GET for 'page=' number 
    const homePage = 'home';
    const patterns = ['/?page=', '/?filter', '/?query'];
    for (const pattern of patterns) {
        const hasIndex = currentPageURL.indexOf(pattern);
        if (hasIndex !== -1) {
            let targetElement = document.getElementById(homePage);
            let targetElementBox = targetElement.firstElementChild;
            let iconPath = targetElementBox.firstElementChild.firstElementChild;
            targetElementBox.style.backgroundColor = 'var(--active)';
            targetElementBox.style.boxShadow = '0px 0px 2px #FFFFFF'; 
            iconPath.style.stroke = '#FFFFFFE6';
        }
    }
})();