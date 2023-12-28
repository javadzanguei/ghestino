/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'BSP_service_ghestino',
//     cluster: 'mt1',
//     wsHost: '',
//     wsPort: 80,
//     wssPort: 443,
//     forceTLS: 'https',
//     enabledTransports: ['ws', 'wss'],
//     auth: {
//         headers: {
//             'X-App-ID': 'ghestino_service'
//         }
//     },
// });

// window.Echo.private(`service-case-created`)
//     .listen('CreateServiceCaseEvent', (e) => {
//         Livewire.emit('refreshServiceCases', e.serviceCase, 'NewServiceCase');
//     });
// window.Echo.private(`service-case-message-created`)
//     .listen('CreateServiceCaseMessageEvent', (e) => {
//         Livewire.emit('refreshServiceCases', e.serviceCase, 'NewServiceCaseMessage');
//     });
