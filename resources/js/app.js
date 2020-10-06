/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('venta-component', require('./components/Venta/VentaComponent.vue').default);
Vue.component('ticket-venta-component', require('./components/Venta/TicketVenta.vue').default);

Vue.component('caja-component', require('./components/Caja/CajaComponent.vue').default);
Vue.component('anular-venta-caja-component', require('./components/Caja/AnularVentaCajaComponent.vue').default);
Vue.component('ticket-cerrar-caja-component', require('./components/Caja/TicketCerrarCajaComponent.vue').default);
Vue.component('ventas-realizadas-caja-component', require('./components/Caja/VentasRealizadasCajaComponent.vue').default);

Vue.component('producto-editar-component', require('./components/Producto/ProductoEditarComponent.vue').default);
Vue.component('producto-crear-component', require('./components/Producto/ProductoCrearComponent.vue').default);
Vue.component('producto-escaso-component', require('./components/Producto/ProductoEscasoComponent.vue').default);

Vue.component('personal-registrar-component', require('./components/Personal/PersonalRegistrarComponent.vue').default);
Vue.component('personal-editar-component', require('./components/Personal/PersonalEditarComponent.vue').default);

Vue.component('registro-ventas-component', require('./components/RegistroVentasComponent.vue').default);

Vue.component('copia-ticket-venta-component', require('./components/CopiaTicket/CopiaTicketVentaComponent.vue').default);
Vue.component('copia-ticket-caja-component', require('./components/CopiaTicket/CopiaTicketCajaComponent.vue').default);

Vue.component('mensaje-inicio-component', require('./components/MensajeInicioComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
