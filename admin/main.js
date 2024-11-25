const togglePassword = (elem) => {
  let field = document.querySelector(elem).type;
  document.querySelector(elem).type = field == "password" ? "text" : "password";
};

const switchTheme = (color) => {
  localStorage.theme = color;
  window.location.reload();
};

if (document.getElementById("showpassword")) {
  document.getElementById("showpassword").addEventListener("click", (e) => {
    let selectorpass = "#password";
    let field = document.querySelector(selectorpass).type;
    let showbtn = document.querySelector("#showpassword");
    togglePassword(selectorpass);
    if (field == "password") {
      showbtn.children[0].classList.add("hidden");
      showbtn.children[1].classList.remove("hidden");
    } else {
      showbtn.children[1].classList.add("hidden");
      showbtn.children[0].classList.remove("hidden");
    }
    document.querySelector(selectorpass).focus();
  });
}

if (document.getElementById("remebtn")) {
  document.getElementById("remebtn").addEventListener("click", (e) => {
    document.getElementById("remebtn").children[2].checked =
      !document.getElementById("remebtn").children[2].checked;
  });
}

// Fucntion for previewing images
function setupImagePreview(fileInput, input, restore = false) {
  const file = fileInput.files[0];
  const fileinp = document.getElementById(input);
  const imagePreview = fileinp.nextElementSibling;
  if (restore) imagePreview.setAttribute("data-restore", imagePreview.src);

  if (file) {
    const reader = new FileReader();

    reader.onload = function (e) {
      imagePreview.src = e.target.result;
      imagePreview.style.display = "block";
    };

    reader.readAsDataURL(file);
  }
}

function checkImage(
  file,
  bfu = false,
  placeholder = false,
  resetImage = false
) {
  // BFU = Button for uploading
  const imagePreview = file.nextElementSibling;
  const imagePreviousImage = imagePreview.getAttribute("data-restore");
  const fileParent = file.parentElement;
  const buttonForUploading = bfu ? file.parentElement.nextElementSibling : "";
  const placeholderElement = file.previousElementSibling;

  if (file.files.length >= 1) {
    if (placeholder) placeholderElement.style.display = "none";
    fileParent.classList.add("checkboard");
    fileParent.classList.remove("fileupload");
    if (bfu) buttonForUploading.style.display = "block";
  } else {
    if (placeholder) placeholderElement.style.display = "grid";
    fileParent.classList.remove("checkboard");
    fileParent.classList.add("fileupload");
    if (bfu) buttonForUploading.style.display = "none";
    if (resetImage) imagePreview.src = imagePreviousImage;
    else imagePreview.style.display = "none";
  }
}

// Dialogue Box implementation
const setupConfirmationDialog = (
  formSelector,
  message,
  imageUrl = "",
  badgeText = null
) => {
  const form = document.querySelector(formSelector);
  const dialog = document.getElementById("confirmationDialog");
  const dialogMessage = document.getElementById("dialogMessage");
  const dialogImage = document.getElementById("dialogImage");
  const confirmButton = document.getElementById("confirmButton");
  const cancelButton = document.getElementById("cancelButton");
  const dialogBadge = document.getElementById("dialogBadge");

  // Function to show the dialog
  function showDialog() {
    if (badgeText) {
      dialogBadge.style.display = true;
      dialogBadge.textContent = badgeText;
    } else {
      dialogBadge.style.display = false;
      dialogBadge.textContent = "";
    }
    dialogMessage.textContent = message;
    if (imageUrl) {
      let prefixLocation = dialogImage.getAttribute("data-src");
      dialogImage.children[0].src =
        prefixLocation + imageUrl + "?" + Math.floor(Date.now() / 1000);
      dialogImage.classList.remove("hidden");
    } else {
      dialogImage.classList.add("hidden");
    }
    dialog.classList.remove("hidden");
  }

  // Function to hide the dialog
  function hideDialog() {
    dialog.classList.add("hidden");
  }

  // Event listener for form submission
  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately
    showDialog();

    confirmButton.focus();

    // Confirm button click event
    confirmButton.addEventListener("click", function () {
      form.submit(); // Submit the form
    });

    // Cancel button click event
    cancelButton.addEventListener("click", function () {
      hideDialog(); // Hide the dialog
    });
  });
};

function countCharacters(containerSelector) {
  document.querySelectorAll(containerSelector).forEach((container) => {
    // Get the textarea ID and maximum characters from data attributes
    const textareaId = container.getAttribute("data-textarea-id");
    const maxCharacters = parseInt(
      container.getAttribute("data-max-characters"),
      10
    );

    if (!textareaId || isNaN(maxCharacters)) {
      console.error(`Invalid data attributes in container ${container.id}`);
      return;
    }

    const textarea = document.getElementById(textareaId);
    if (!textarea) {
      console.error(`Textarea with id ${textareaId} not found.`);
      return;
    }

    // Create and append the character count display element if not already present
    let charCountDisplay = container.querySelector(".char-count-display");
    if (!charCountDisplay) {
      charCountDisplay = document.createElement("p");
      charCountDisplay.className = "char-count-display";
      charCountDisplay.title = "Character count";
      container.appendChild(charCountDisplay);
    }

    function updateCharacterCount() {
      const text = textarea.value;
      const charCount = text.length;
      charCountDisplay.textContent = `${charCount}/${maxCharacters}`;
    }

    textarea.addEventListener("input", updateCharacterCount);

    // Initial update
    updateCharacterCount();
  });
}

// Function to add a new textbox
function addNewTextbox(container_name) {
  const container = document.getElementById(container_name);
  const iconDelete = container.querySelector("button[type='button']").innerHTML;

  // Create a new div element to hold the textbox and button
  const newDiv = document.createElement("div");
  newDiv.className = "textbox-row";

  // Create a new input element for the textbox
  const newInput = document.createElement("input");
  newInput.type = "text";
  newInput.name = "new_item_names[]";
  newInput.placeholder = "Enter your new item";
  newDiv.appendChild(newInput);

  // Create a remove button
  const removeButton = document.createElement("button");
  removeButton.type = "button";
  removeButton.innerHTML = iconDelete;
  removeButton.onclick = function () {
    removeTextbox(removeButton);
  };
  newDiv.appendChild(removeButton);

  // Append the new div to the container
  container.appendChild(newDiv);
  newInput.focus();
}

// Function to remove a textbox
function removeTextbox(button) {
  const row = button.parentNode;
  const input = row.querySelector('input[type="text"]');
  input.value = ""; // Clear the value
  row.style.display = "none"; // Hide the row
}

const checkprevioususername = (element, username) => {
  const btn = element.parentElement.nextElementSibling;
  if (element.value != username && element.value.length > 1) {
    if (btn.type == "submit") {
      btn.style.display = "inline-block";
      btn.disabled = false;
    } else {
      btn.style.display = "none";
      btn.disabled = true;
    }
  } else {
    btn.style.display = "none";
    btn.disabled = true;
  }
};

const checkpassword = (element) => {};

const checkusername = (element, message_text, username = null) => {
  const msgtext = document.getElementById(message_text);
  if (username != null && element.value == username) {
    msgtext.children[0].classList.add("hidden");
    msgtext.children[1].classList.add("hidden");
    return;
  }
  formData = new FormData();
  formData.append("username", element.value);

  fetch("modules/accounts_check.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => {
      return res.text();
    })
    .then((data) => {
      if (data != -1) {
        if (parseInt(data) == 1) {
          msgtext.children[0].classList.add("hidden");
          msgtext.children[1].classList.remove("hidden");
        } else {
          msgtext.children[0].classList.remove("hidden");
          msgtext.children[1].classList.add("hidden");
        }
      } else {
        msgtext.children[0].classList.add("hidden");
        msgtext.children[1].classList.add("hidden");
      }
    })
    .catch((err) => {
      console.error(err);
    });
};

// Main Function
document.addEventListener("DOMContentLoaded", () => {
  document.querySelector("main").classList.remove("load-animation");
  // Dashboard page reset
  if (document.getElementById("reset_logo"))
    setupConfirmationDialog(
      "#reset_logo",
      "Are you sure you want to revert to the previously saved logo?",
      "uploads/header_logo_old.webp",
      "Previous Logo"
    );
  if (document.getElementById("changeHeroImage"))
    setupConfirmationDialog(
      "#changeHeroImage",
      "Are you sure you want to change the hero section image?",
      "uploads/hsimg.webp",
      "Previous Hero Image"
    );
  if (document.getElementById("removeApplicants"))
    setupConfirmationDialog(
      "#removeApplicants",
      "Are you sure you want to remove all the entries?"
    );
  if (document.getElementById("update_about"))
    setupConfirmationDialog(
      "#update_about",
      "Are you sure you want to update the about page data?"
    );
  if (document.getElementById("aboutlistitems"))
    setupConfirmationDialog(
      "#aboutlistitems",
      "All the blank fields will be removed. Are you sure you want to update the list?"
    );
  if (document.getElementById("update_approach"))
    setupConfirmationDialog(
      "#update_approach",
      "Are you sure you want to update the content of approach section?"
    );
  if (document.getElementById("approachlistitems"))
    setupConfirmationDialog(
      "#approachlistitems",
      "All the blank fields will be removed. Are you sure you want to update the list?"
    );
  if (document.getElementById("update_expertise"))
    setupConfirmationDialog(
      "#update_expertise",
      "Are you sure you want to update?"
    );
  if (document.getElementById("update_service"))
    setupConfirmationDialog(
      "#update_service",
      "Blank fields will be hidden. Are you sure you want to update service content?"
    );
  if (document.getElementById("update_solution"))
    setupConfirmationDialog(
      "#update_solution",
      "Blank fields will be hidden. Are you sure you want to update solution content?"
    );
  if (document.getElementById("update_project"))
    setupConfirmationDialog(
      "#update_project",
      "Blank fields will be hidden. Are you sure you want to update project content?"
    );
  if (document.getElementById("update_career"))
    setupConfirmationDialog(
      "#update_career",
      "Blank fields will be hidden. Are you sure you want to update careers content?"
    );
  if (document.getElementById("focus_update"))
    setupConfirmationDialog(
      "#focus_update",
      "Are you sure you want to update content?"
    );
  if (document.getElementById("footercontent"))
    setupConfirmationDialog(
      "#footercontent",
      "Are you sure you want to update content?"
    );
  if (document.getElementById("update_contact"))
    setupConfirmationDialog(
      "#update_contact",
      "Are you sure you want to update content?"
    );
  if (document.getElementById("phonelistitems"))
    setupConfirmationDialog(
      "#phonelistitems",
      "Are you sure you want to update phone numbers?"
    );
  if (document.getElementById("maillistitems"))
    setupConfirmationDialog(
      "#maillistitems",
      "Are you sure you want to update e-mails?"
    );
  if (document.getElementById("automail_update"))
    setupConfirmationDialog(
      "#automail_update",
      "Are you sure you want to update email?"
    );
  if (document.getElementById("currentusername"))
    setupConfirmationDialog(
      "#currentusername",
      "You might be logged out in this process. Are you sure you want to update?"
    );
  if (document.getElementById("change_password"))
    setupConfirmationDialog(
      "#change_password",
      "Are you sure you want to change your password?"
    );
  if (document.getElementById("update-user"))
    setupConfirmationDialog(
      "#update-user",
      "Are you sure you want to update user details?"
    );
  if (document.getElementById("confirmbanner"))
    setupConfirmationDialog(
      "#confirmbanner",
      "Are you sure you want to update the banner page?",
      document.getElementById("confirmbanner").getAttribute("data-imagepath"),
      "Previous Banner Image"
    );
  // All the delete button setup
  if (document.querySelectorAll(".delete-button").length > 0) {
    document.querySelectorAll(".delete-button").forEach((button) => {
      const form = button.closest("form"); // Find the closest form
      const formSelector = `#${form.attributes.id.nodeValue}`;
      setupConfirmationDialog(
        formSelector,
        "Are you sure you want to delete this?"
      );
    });
  }

  // Get all forms in the document
  const forms = document.querySelectorAll("form");
  // Iterate over each form
  forms.forEach((form) => {
    form.addEventListener("submit", (event) => {
      // Get the submit button within the form
      const submitButton = form.querySelector('button[type="submit"]');
      const btnText = submitButton.innerHTML;
      // Check if the submit button exists
      if (submitButton) {
        // Disable the submit button to prevent multiple clicks
        submitButton.disabled = true;
        submitButton.innerHTML = `
        <svg class="animate-spin h-5 w-5 text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 12a9 9 0 1 1-6.219-8.56" />
        </svg>`;
        setTimeout(() => {
          submitButton.disabled = false;
          submitButton.innerHTML = `${btnText}`;
        }, 3000);
      }
    });
  });

  // Initialize the character count functionality for all containers with the data-character-count attribute
  countCharacters("[data-character-count]");

  if (document.getElementById("confirmationDialog")) {
    document
      .getElementById("confirmationDialog")
      .addEventListener("submit", (e) => {
        e.preventDefault();
      });
  }
});
