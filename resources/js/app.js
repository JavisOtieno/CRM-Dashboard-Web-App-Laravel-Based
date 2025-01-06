import './bootstrap';
import '../css/app.css';
import '../css/index.css'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import store from './store'; // Import Vuex store
import VueApexCharts from "vue3-apexcharts";
import { createPinia } from 'pinia';
import piniaPluginPersistedState from 'pinia-plugin-persistedstate';

import axios from 'axios'

// axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content


const appName = import.meta.env.VITE_APP_NAME || 'SCG CRM';

const pinia = createPinia();
pinia.use(piniaPluginPersistedState);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueApexCharts)
            .component("apexchart", VueApexCharts)
            .use(store) // Use Vuex store
            .use(pinia) // Add Pinia to your app
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});







