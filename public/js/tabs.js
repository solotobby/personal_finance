document.addEventListener('DOMContentLoaded', function() {
    // Handle Continue button click
    document.getElementById('continueBtn').addEventListener('click', function() {
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

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordField = document.getElementById('password');
        var type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        var confirmPasswordField = document.getElementById('password_confirmation');
        var type = confirmPasswordField.type === 'password' ? 'text' : 'password';
        confirmPasswordField.type = type;
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });

    // Function to show a temporary alert
    function showTemporaryAlert(message, alertType) {
        // Create the alert element
        var alert = document.createElement('div');
        alert.classList.add('alert', `alert-${alertType}`, 'alert-dismissible', 'fade', 'show');
        alert.role = 'alert';
        alert.innerHTML = `${message}`;

        // Append the alert to the body or a specific container
        document.querySelector('.container').prepend(alert);  // Prepend to show at the top

        // Remove the alert after 3 seconds
        setTimeout(function() {
            alert.classList.remove('show'); // Fade out the alert
            alert.classList.add('fade');
            setTimeout(function() {
                alert.remove(); // Remove the alert completely after fading out
            }, 500); // Wait for fade out animation
        }, 3000);
    }
});
