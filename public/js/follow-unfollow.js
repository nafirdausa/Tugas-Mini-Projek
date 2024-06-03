// Following function
$(document).ready(function() {
    $('form.follow-unfollow').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.find('input[name="_method"]').val() || 'POST';

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(response) {
                form.closest('.row').remove();
            }
        });
    });
});


// Notifikasi Konfirmasi Password
// document.getElementById('edit-profile-link').addEventListener('click', function (event) {
//     event.preventDefault();
//     var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'), {});
//     passwordModal.show();
// });


// document.getElementById('edit-profile-link').addEventListener('click', function () {
//     // Show password modal
//     var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'), {});
//     passwordModal.show();
  
//     // Alternative: Use Bootstrap's validation (if applicable)
//     // var passwordForm = document.getElementById('passwordForm'); // Assuming a form exists
//     // passwordForm.addEventListener('submit', function(event) {
//     //   event.preventDefault(); // Prevent form submission if validation fails
//     //   // Add your password validation logic here
//     // });
//   });
  
//   document.getElementById('confirmPasswordButton').addEventListener('click', function () {
//     var password = document.getElementById('passwordInput').value;
  
//     // Perform password confirmation logic (e.g., AJAX request)
//     console.log("Confirmed password: ", password);
  
//     // Assuming successful confirmation, redirect to detail-profil page:
//     window.location.href = "/edit-profile"; // Replace with your actual URL
  
//     // Close the modal after confirmation
//     var passwordModal = bootstrap.Modal.getInstance(document.getElementById('passwordModal'));
//     passwordModal.hide();
//   });

document.getElementById('edit-profile-link').addEventListener('click', function (event) {
    event.preventDefault();
    var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'), {});
    passwordModal.show();
});

document.getElementById('confirmPasswordButton').addEventListener('click', function () {
    var password = document.getElementById('passwordInput').value;

    // Perform password confirmation logic (e.g., AJAX request)
    fetch('/check-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ password: password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Password is correct, redirect to edit profile page
            window.location.href = "/edit-profile/" + data.user_id; // Replace with your actual URL
        } else {
            // Password is incorrect, show error message
            var passwordInput = document.getElementById('passwordInput');
            passwordInput.classList.add('is-invalid');
        }
    })
    .catch(error => console.error('Error:', error));
});