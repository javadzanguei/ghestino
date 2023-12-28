const CACHE_NAME = 'v_4.7';
const OFFLINE_URL = './offline.html';

self.addEventListener('install', function (event) {
    event.waitUntil((async () => {
        caches.keys().then(oldCacheNames => {
            // noinspection JSVoidFunctionReturnValueUsed
            if(caches.length) {
                return Promise.all(
                    oldCacheNames.forEach(cache => {
                        if (cache !== CACHE_NAME) return caches.delete(cache)
                    })
                )
            } else return [];
        })
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll([
                './offline.html',
                './manifest.webmanifest',
                './browserconfig.xml',
                './assets/images/android-icon-36x36.png',
                './assets/images/android-icon-48x48.png',
                './assets/images/android-icon-72x72.png',
                './assets/images/android-icon-96x96.png',
                './assets/images/android-icon-144x144.png',
                './assets/images/android-icon-192x192.png',
                './assets/images/apple-icon.png',
                './assets/images/apple-icon-57x57.png',
                './assets/images/apple-icon-60x60.png',
                './assets/images/apple-icon-72x72.png',
                './assets/images/apple-icon-76x76.png',
                './assets/images/apple-icon-114x114.png',
                './assets/images/apple-icon-120x120.png',
                './assets/images/apple-icon-144x144.png',
                './assets/images/apple-icon-152x152.png',
                './assets/images/apple-icon-180x180.png',
                './assets/images/apple-icon-precomposed.png',
                './assets/images/favicon-16x16.png',
                './assets/images/favicon-32x32.png',
                './assets/images/favicon-64x64.png',
                './assets/images/favicon-96x96.png',
                './assets/images/logo.png',
                './assets/images/ms-icon-70x70.png',
                './assets/images/ms-icon-144x144.png',
                './assets/images/ms-icon-150x150.png',
                './assets/images/ms-icon-310x310.png',
                './assets/images/no-image.jpg',
                './assets/images/print-bg.jpg',
                './assets/images/print-logo.png',
                './assets/fonts/Vazir.woff',
                './assets/fonts/Vazir-Black.woff',
                './assets/fonts/Vazir-Bold.woff',
                './assets/fonts/Vazir-FD.woff',
                './assets/fonts/Vazir-Light.woff',
                './assets/fonts/Vazir-Medium.woff',
                './assets/fonts/Vazir-Thin.woff',
                './assets/js/app.js',
                // './assets/js/pusher-enable.js',
                './assets/js/mds.bs.datetimepicker.js',
                './assets/js/jquery.min.js',
                './assets/js/num2persian.min.js',
                './assets/js/webcam-easy.min.js',
                './assets/css/app.css',
                './assets/css/home.css',
                './assets/css/panel.css',
                './assets/css/fonts.css',
                './assets/css/bootstrap-custom.css',
                './assets/css/mds.bs.datetimepicker.style.css',
                './assets/css/installment.css',
                './assets/css/survey.css',
                './assets/audio/snap.wav',
                'https://cdn.jsdelivr.net/npm/@flasher/flasher@1.3.1/dist/flasher.min.js',
            ]);
        })
    })());

    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    event.waitUntil((async () => {
        if ('navigationPreload' in self.registration) {
            await self.registration.navigationPreload.enable();
        }
    })());

    // Tell the active service worker to take control of the page immediately.
    self.clients.claim();
});

self.addEventListener('fetch', function (event) {
    if (event.request.mode === 'navigate') {
        event.respondWith((async () => {
            try {

                const cachedResponse = await caches.match(event.request);
                if (cachedResponse) return cachedResponse;

                const preloadResponse = await event.preloadResponse;
                if (preloadResponse) return preloadResponse;

                return await fetch(event.request)

            } catch (error) {
                console.log('[Service Worker] Fetch failed; returning offline page instead.', error);

                const cache = await caches.open(CACHE_NAME);
                return await cache.match(OFFLINE_URL);

            }
        })());
    }
    // event.respondWith(
    //     caches.match(event.request).then(response => {
    //       if(response) return response;
    //
    //       return fetch(event.request).then(networkResponse => {
    //         caches.open(CACHE_NAME)
    //             .then(cache => {
    //               cache.put(event.request , networkResponse.clone());
    //               return networkResponse;
    //             })
    //       })
    //     })
    // )
});
self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        //notifications aren't supported or permission not granted!
        return;
    }

    if (e.data) {
        let msg = e.data.json();
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            icon: msg.icon,
            actions: msg.actions
        }));
    }
});
self.addEventListener(
    "notificationclick",
    (event) => {
        event.notification.close();
        clients.openWindow("/case/" + event.action + "/show");
    },
    false,
);
