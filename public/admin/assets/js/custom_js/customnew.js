
$(document).on('click', '#delete', function(e) {
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
        title: 'Are you sure?',
        text: "Delete This Data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create a form element dynamically
            var form = document.createElement('form');
            form.action = link;
            form.method = 'POST'; // Use POST method
            form.style.display = 'none';

            // Add CSRF token input
            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = window.csrfToken;
            form.appendChild(csrfToken);

            // Add method spoofing input
            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE'; // Spoof DELETE request
            form.appendChild(methodField);

            // Append the form to the document body and submit it
            document.body.appendChild(form);
            form.submit();

            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            );
        }
    });
});
