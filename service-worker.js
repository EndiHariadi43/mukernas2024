self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open('static-cache-v1').then((cache) => {
            return cache.addAll([
                '/',
                '/index.php',
                '/assets/css/tailwind.css',
                '/assets/js/main.js',
                '/assets/images/favicon.png'
            ]);
        })
    );
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        })
    );
});
