function validateUpdatePassForm(npform) {
    let isValid = true;

    // Reset error field styles
    const inputFields = npform.getElementsByTagName('input');
    for (let i = 0; i < inputFields.length; i++) {
        inputFields[i].classList.remove('error-field');
    }

    if (!npform.currentPassword.value) {
        displayError('currentPasswordError', "*Old Password is required");
        npform.currentPassword.classList.add('error-field');
        isValid = false;
    }
      
    if (!npform.newPassword.value) {
        displayError('newPasswordError', "*New Password is required");
        npform.newPassword.classList.add('error-field');
        isValid = false;
    }
   
    if (!npform.confirmNewPassword.value || npform.newPassword.value !== npform.confirmNewPassword.value) {
        displayError('confirmNewPasswordError', "*Passwords do not match");
        npform.confirmNewPassword.classList.add('error-field');
        isValid = false;
    }

    return isValid;
}

function displayError(errorElementId, message) {
    const errorElement = document.getElementById(errorElementId);
    if (errorElement) {
        errorElement.innerHTML = message;
    }
}
