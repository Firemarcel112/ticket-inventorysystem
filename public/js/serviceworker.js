self.addEventListener('install', () => {
    caches.open('sbscache')
        .then( (cache) => {
            cache.addAll([
                "/",
                "/faq",
                "index.php"
            ])
                .then(() => {
                    console.log('successful cached')
                })
                .catch((err) => {
                    console.error('Serviceworker failed at install: ', err);
                })
        })
});

self.addEventListener('active', () => {
    console.info('Serviceworker is running!');
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request)
            .then((response) => {
                if(response) {
                    return response;
                } else {
                    return fetch(event.request);
                }
            })
    )
})