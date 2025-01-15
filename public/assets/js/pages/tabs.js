document.addEventListener('DOMContentLoaded', function () {
    // Handle Continue button click
    const continueBtn = document.getElementById('continueBtn');
    if (continueBtn) {
        continueBtn.addEventListener('click', function () {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var password_confirmation = document.getElementById('password_confirmation').value;

            // Validate user account fields
            if (name && email && password && password_confirmation) {
                // Validate password match
                if (password !== password_confirmation) {
                    showTemporaryAlert('Passwords do not match.', 'danger');
                    return;
                }

                // Hide user account section and show business account section
                document.getElementById('userAccountSection').style.display = 'none';
                document.getElementById('businessAccountSection').style.display = 'block';
            } else {
                showTemporaryAlert('Please fill out all required fields for your account.', 'warning');
            }
        });
    }

    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.addEventListener('click', function () {
            var name = document.getElementById('business_name').value;
            var email = document.getElementById('business_email').value;
            var password = document.getElementById('business_phone').value;
            var password_confirmation = document.getElementById('business_description').value;

            // Validate user account fields
            if (name && email && password && password_confirmation) {
                // Hide user account section and show business account section
                document.getElementById('userAccountSection').style.display = 'none';
                document.getElementById('businessAccountSection').style.display = 'none';
            } else {
                showTemporaryAlert('Please fill out all required fields for your account.', 'warning');
            }
        });
    }

    const submitBusiness = document.getElementById('submitBusiness');
    if (submitBusiness) {
        submitBusiness.addEventListener('click', function (event) {
            //event.preventDefault();

            var business_name = document.getElementById('business_name').value.trim();
            var business_email = document.getElementById('business_email').value.trim();
            var business_phone = document.getElementById('business_phone').value.trim();
            var business_description = document.getElementById('business_description').value.trim();

            // Validate business account fields
            if (business_name && business_email && business_phone && business_description) {
                document.getElementById('businessForm').submit();
            } else {
                showTemporaryAlert('Please fill out all required fields for your business account.', 'warning');
            }
        });
    }


    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        togglePassword.addEventListener('click', function () {
            var passwordField = document.getElementById('password');
            var type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    }

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    if (toggleConfirmPassword) {
        toggleConfirmPassword.addEventListener('click', function () {
            var confirmPasswordField = document.getElementById('password_confirmation');
            var type = confirmPasswordField.type === 'password' ? 'text' : 'password';
            confirmPasswordField.type = type;
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    }

    // Function to show a temporary alert
    function showTemporaryAlert(message, alertType) {
        var alert = document.createElement('div');
        alert.classList.add('alert', `alert-${alertType}`, 'alert-dismissible', 'fade', 'show');
        alert.role = 'alert';
        alert.innerHTML = `${message}`;

        // Style the alert to appear at the top-right corner without shifting the page
        alert.style.position = 'fixed';
        alert.style.top = '10px';
        alert.style.right = '10px';
        alert.style.zIndex = '9999';  // Ensure the alert is on top of other content

        // Append the alert to the body
        document.body.appendChild(alert);

        setTimeout(function () {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, 3000);
    }

    const modal = new bootstrap.Modal(document.getElementById('businessAccountModal'), {
        backdrop: 'static',
        keyboard: false
    });
    modal.show();

});
