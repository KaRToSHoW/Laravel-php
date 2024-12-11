import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';

// const app = createApp({
//     components: {
//         'App': App,
//     }
// });

const app = createApp(App);

app.mount('#app');
