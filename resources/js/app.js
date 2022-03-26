
import { createApp } from 'vue';
import App from './components/app.vue';

const app = createApp({});

//register the component
app.component('app', App);

//..HTML element to mount the Vue application
app.mount('#app');
