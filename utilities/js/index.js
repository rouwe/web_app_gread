(function shortenDescription() {
    /* Limits the number of characters being displayed
    * @selector - used for target element(s) to be shortened
    */
    const recordsArr = document.getElementsByClassName('gread-description');
    const recordLength = recordsArr.length;
    const maxLength = 56;
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
})();
const targetActions = ['edit', 'delete'];
for (const action of targetActions) {
    const target = document.getElementById(action);
    target.addEventListener("click", modifyRecordRedirect);
}

function modifyRecordRedirect() {
    // Make sure that the user is in index when selecting record to modify
    const action = this.getAttribute('id');
    const homeURL = 'http://localhost/web_apps/gread/';
    const currentURL = document.location.href;
    if (currentURL !== homeURL) {
        window.open(homeURL, '_self');
    } else {
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
};
const greadContentContainer = document.getElementsByClassName('gread-content-container')[0];
greadContentContainer.addEventListener("click", hideRecordLinks);

function hideRecordLinks() {
    // Hide record links
    const recordLinkArr = document.getElementsByClassName('unchecked');
    for (const recordLink of recordLinkArr) {
        recordLink.style.display = 'none';
    }
}