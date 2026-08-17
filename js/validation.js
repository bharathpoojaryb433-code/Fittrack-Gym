function validateForm(form) {

    let valid = true;

    const requiredFields =
        form.querySelectorAll("[required]");

    requiredFields.forEach(field => {

        field.style.borderColor = "";

        if (field.value.trim() === "") {

            field.style.borderColor = "#ef4444";

            valid = false;
        }
    });

    if (!valid) {

        alert("Please fill all required fields.");

    }

    return valid;
}


document.addEventListener("DOMContentLoaded", () => {

    const forms =
        document.querySelectorAll("form.validate");

    forms.forEach(form => {

        form.addEventListener("submit", event => {

            if (!validateForm(form)) {

                event.preventDefault();

            }

        });

    });

});