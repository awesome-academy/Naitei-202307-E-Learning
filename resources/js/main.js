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
    const deleteButton = document.getElementById('course-delete-button');

    if (deleteButton) {
        deleteButton.addEventListener('click', function (event) {
            event.preventDefault();

            const form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form after confirmation
                }
            });
        });
    }
});
