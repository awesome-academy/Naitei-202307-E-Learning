function changeLocale(selectedLanguage) {
    fetch(`/language/${selectedLanguage}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(() => {
            location.reload();
        })
        .catch(error => {
            console.error('An error occurred:', error);
        });
}

document.addEventListener('DOMContentLoaded', function () {
    const langSelect = document.getElementById('lang');
    langSelect.addEventListener('change', function () {
        changeLocale(this.value);
    });
});
