import Swal from 'sweetalert2';

let isPressed = true;
document.getElementById("drop-down-btn").onclick = function () { myFunction() };

function myFunction() {
    if (isPressed) {
        document.getElementById("drop-down").classList.remove("hidden");
        isPressed = false;
    }
    else {
        document.getElementById("drop-down").classList.add("hidden");
        isPressed = true;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const buttonsWithConfirmation = document.querySelectorAll('.delete-button, .approve-button, .reject-button');

    buttonsWithConfirmation.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const form = this.closest('form');
            let confirmTitle = '';
            let confirmText = '';

            if (button.classList.contains('delete-button')) {
                confirmTitle = 'Delete Confirmation';
                confirmText = 'Are you sure you want to delete this item?';
            } else if (button.classList.contains('approve-button')) {
                confirmTitle = 'Approve Confirmation';
                confirmText = 'Are you sure you want to approve this account?';
            } else if (button.classList.contains('reject-button')) {
                confirmTitle = 'Reject Confirmation';
                confirmText = 'Are you sure you want to reject this account?';
            }

            Swal.fire({
                title: confirmTitle,
                text: confirmText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
