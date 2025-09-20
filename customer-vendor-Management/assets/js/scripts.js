// Function for delete confirmation
function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
}

// Basic form validation example (can be attached to forms)
document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");
    forms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            const requiredFields = form.querySelectorAll("[required]");
            let valid = true;
            requiredFields.forEach((field) => {
                if (!field.value.trim()) {
                    valid = false;
                    alert("Please fill all required fields.");
                }
            });
            if (!valid) e.preventDefault();
        });
    });
});

// create
document
    .getElementById("profileInput")
    .addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(
                    "previewBox"
                ).innerHTML = `<img src="${e.target.result}" alt="Profile Preview">`;
            };
            reader.readAsDataURL(file);
        }
    });

// index
function confirmDelete() {
    return confirm("Are you sure you want to delete this customer?");
}


