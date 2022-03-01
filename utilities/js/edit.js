const textFields = document.getElementsByClassName('inpt-field');
for (const textField of textFields) {
    textField.addEventListener("keyup", textFieldLivePreview);
}

function textFieldLivePreview() {
    // Allows the user to directly see changes when editing text fields
    const previewTitle = document.getElementsByClassName('preview-title')[0].firstElementChild;
    const previewDescription = document.getElementsByClassName('preview-description')[0];
    // Check if title or description
    const currentField = this.getAttribute("id");
    if (currentField === 'title') {
        const currentFieldText = this.value;
        previewTitle.innerHTML = currentFieldText;
    }
    if (currentField === 'description') {
        const currentFieldText = this.value;
        previewDescription.innerHTML = currentFieldText;
    }
}
function thumbnailLivePreview() {
    // Allows the user to directly see changes when editing thumbnail
    const fileField = document.getElementsByClassName('inpt-file')[0];
    console.log(textFields, fileField)
}