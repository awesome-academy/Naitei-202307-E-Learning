const videoElement = document.getElementById('lessonVideo');
let csrfToken = document.getElementById('app').getAttribute('data-csrf-token');
let ls_id = document.getElementById('app').getAttribute('start-lesson');
videoElement.addEventListener('ended', () => {
    const lessonId = ls_id;
    axios.post(`/save-progress/${lessonId}`, {}, {
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    })
        .then(response => {
            if (response.data.success && response.data.id) {
                const lesson = response.data.id;
                window.location.href = `/learning/${lesson}`;
            }
        })
        .catch(error => {
            console.log(error);
        });
});

const videoElement2 = document.getElementById('lessonVideo');
let currentTime = 0;

videoElement2.addEventListener('play', () => {
    const updateInterval = setInterval(() => {
        if (!videoElement2.paused && !videoElement2.ended) {
            currentTime = videoElement2.currentTime;

            sendProgress(currentTime);
        }
    }, 5000);

    videoElement2.addEventListener('pause', () => {
        clearInterval(updateInterval);
    });

    videoElement2.addEventListener('ended', () => {
        clearInterval(updateInterval);
    });
});

function sendProgress(currentTime) {
    const lessonId = ls_id;
    axios.post(`/update-progress/${lessonId}`, {
        currentTime
    }, {
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    })
        .then(response => {
        })
        .catch(error => {
            console.log(error);
        });
}
