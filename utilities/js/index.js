(function shortenDescription() {
    /* Limits the number of characters being displayed
    * @selector - used for target element(s) to be shortened
    */
   const isUserLoggedIn = document.getElementById('default-home') === null;
    if (isUserLoggedIn) {
        const recordsArr = document.getElementsByClassName('gread-description');
        const recordLength = recordsArr.length;
        const maxLength = 45;
        if (recordLength > 0) {
            for (let i = 0; i < recordsArr.length; i++) {
                const targetElement = recordsArr[i];
                const description = recordsArr[i].innerHTML;
                // Check text length
                if (description.length > maxLength) {
                    const trimmedText = description.slice(0, maxLength) + '...';
                    targetElement.innerHTML = trimmedText;
                }
            }
        }
    }
})();
(function isLoggedIn() {
    const notLoggedPage = document.getElementById('default-home') === null;
    // Check if user is logged in
    if (notLoggedPage) {
        const targetActions = ['edit', 'delete'];
        for (const action of targetActions) {
            const target = document.getElementById(action);
            target.addEventListener("click", modifyRecordRedirect);
        }
    }
})();
function displaySelectOption(action) {
    // Display each records modification links
    const recordLinkArr = document.getElementsByClassName('unchecked');
    for (const recordLink of recordLinkArr) {
        recordLink.style.display = 'block';
        // Modify parent URL based on action
        const recordLinkParent = recordLink.parentElement;
        const recordLinkParentGetDataIndex = recordLinkParent.getAttribute('href').indexOf('.php');
        const recordLinkParentHref = recordLinkParent.getAttribute('href').slice(recordLinkParentGetDataIndex);
        const newHref = './' + action + recordLinkParentHref;
        recordLinkParent.setAttribute('href', newHref);
    }
}
(function checkIfRedirect() {
    // Check if redirect from other (action, delete) page
    const currentURL = document.URL;
    const pattern = '?act=';
    const matchIdx = currentURL.indexOf(pattern);
    if (matchIdx != -1) {
        const redirectAction = currentURL.slice(matchIdx + pattern.length);
        displaySelectOption(redirectAction);
    }
})();

function modifyRecordRedirect() {
    // Make sure that the user is in index when selecting record to modify
    // let action = this;
    let action = this.getAttribute('id');
    const homeURL = 'http://localhost/web_apps/gread/';
    const currentURL = document.location.href;
    if (currentURL !== homeURL) {
        const pattern = '?act=';
        const matchIdx = currentURL.indexOf(pattern);
        if (matchIdx == -1) {
            window.open(homeURL + '?act=' + action, '_self');
        }
    } else {
        displaySelectOption(action);
    }
};
const greadContentContainer = document.getElementsByClassName('gread-content-container')[0];
if (greadContentContainer !== undefined) {
    greadContentContainer.addEventListener("click", hideRecordLinks);
}

function hideRecordLinks() {
    // Hide record links
    const recordLinkArr = document.getElementsByClassName('unchecked');
    for (const recordLink of recordLinkArr) {
        recordLink.style.display = 'none';
    }
}

const filterArrow = document.getElementsByClassName('filter-arrow')[0];
if (filterArrow !== undefined) {
    filterArrow.addEventListener("click", toggleFilter);
}
function displayFilter(filterForm)  {
    // Display filter
    filterForm.style.display = 'flex';
    filterForm.style.opacity = '1';
}
function hideFilter(filterForm) {
    // Hides filter
    filterForm.style.display = 'none';
    filterForm.style.opacity = '0.6';
}
function toggleFilter() {
    // Display options for filters
    const filterForm = document.getElementsByClassName('filter-form')[0];
    const displayStatus = filterForm.style.display;
    if (displayStatus === 'none' || displayStatus === '') {
        // Display
        displayFilter(filterForm);
    } else {
        // Hide
        hideFilter(filterForm);
    }
}
