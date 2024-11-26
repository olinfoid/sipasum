
    document.getElementById('foto').addEventListener('change', function() {
        const maxFiles = 5;
        const fileInput = this;
        const fileCount = fileInput.files.length;
        const errorDiv = document.getElementById('file-limit-error');

        if (fileCount > maxFiles) {
            errorDiv.classList.remove('d-none');
            fileInput.value = ''; // Clear the input
        } else {
            errorDiv.classList.add('d-none');
        }
    });
