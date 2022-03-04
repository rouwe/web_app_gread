(function paginationIsActive() {
    // Controls the look of pagination
    const paginationLinks = document.getElementsByClassName('pagination-link');
    // Reset active pagination to inactive
    const currentPageURL = document.URL;
    const homePage = 'http://localhost/web_apps/gread/';
    if (currentPageURL !== homePage) {
        const pageOne = paginationLinks[1];
        if (pageOne !== undefined) {
            pageOne.classList.remove('pagination-active');
        } 
    }
    for (const pageLink of paginationLinks) {
        const classCount = pageLink.classList.length;
        if (classCount === 1) {
            const hrefAttr = pageLink.getAttribute("href").slice(1,);
            const currentPageURL = document.URL;
            const matchIndex = currentPageURL.indexOf(hrefAttr);
            const isActive = currentPageURL.slice(matchIndex,) === hrefAttr;
            if (isActive) {
                pageLink.classList.add('pagination-active');
            }
        }
    }
})();