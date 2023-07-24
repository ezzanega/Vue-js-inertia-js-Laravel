import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Vue3ColorPicker from "vue3-colorpicker";
import 'vue3-colorpicker/style.css';
import 'floating-vue/dist/style.css'
import { InertiaProgress } from '@inertiajs/progress'
import VueGoogleMaps from "@fawmi/vue-google-maps";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Vue3ColorPicker)
            .use(ZiggyVue, Ziggy)
            .use(VueGoogleMaps, {
                load: {
                    key: "AIzaSyCg7iTXTTxi3m6M4RuP5MQ2vcN-F4Av-nk",
                    libraries: "places",
                    callback: "initMap",
                    v: "weekly"
                },
            })
            .mixin({ methods: { route } })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#29d',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: false,
})