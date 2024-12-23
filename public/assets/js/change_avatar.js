
//  avatar
document.querySelectorAll(".drop-avatar__input").forEach((inputElement) => {
    const dropavatarElement = inputElement.closest(".drop-avatar");
  
    dropavatarElement.addEventListener("click", (e) => {
        inputElement.click();
    });
  
    inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
        updateThumbnail(dropavatarElement, inputElement.files[0]);
        }
    });
  
    dropavatarElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropavatarElement.classList.add("drop-avatar--over");
    });
  
    ["dragleave", "dragend"].forEach((type) => {
        dropavatarElement.addEventListener(type, (e) => {
        dropavatarElement.classList.remove("drop-avatar--over");
        });
    });
  
    dropavatarElement.addEventListener("drop", (e) => {
        e.preventDefault();
  
        if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files;
        updateThumbnail(dropavatarElement, e.dataTransfer.files[0]);
        }
  
        dropavatarElement.classList.remove("drop-avatar--over");
    });
    });
  
    /**
     * Updates the thumbnail on a drop avatar element.
     *
     * @param {HTMLElement} dropavatarElement
     * @param {File} file
     */
    function updateThumbnail(dropavatarElement, file) {
    let thumbnailElement = dropavatarElement.querySelector(".drop-avatar__thumb");
  
    // First time - remove the prompt
    if (dropavatarElement.querySelector(".drop-avatar__prompt")) {
        dropavatarElement.querySelector(".drop-avatar__prompt").remove();
    }
  
    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-avatar__thumb");
        dropavatarElement.appendChild(thumbnailElement);
    }
  
    // thumbnailElement.dataset.label = file.name;
  
    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
        const reader = new FileReader();
  
        reader.readAsDataURL(file);
        reader.onload = () => {
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
        };
    } else {
        thumbnailElement.style.backgroundImage = null;
    }
    }