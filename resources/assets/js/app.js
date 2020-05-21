
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('add-box', require('./components/AddBox.vue').default);
Vue.component('form-box', require('./components/FormBox.vue').default);
Vue.component('progress-bar', require('./components/ProgressBar.vue').default);
import BootstrapVue from 'bootstrap-vue' //Importing

Vue.use(BootstrapVue) // Telling Vue to use this in whole application

$(document).ready(function(){
	const app = new Vue({
	    el: '#app',
	    data: {
				new_: [],
			},
		methods: {
			add_(){
				this.new_.push(1);
			}
		}
	});

	//display the session messagges
	if(document.getElementById('session_message')){
		swal({html:true, title: "Hecho!", text: $('#session_message').data("message"), type:"success"});
	}
	if(document.getElementById('session_errorMessage')){
		swal("Error!", $('#session_errorMessage').data("message"), "error");
	}
	//display message for each form action
	$('form').submit(function(){
		swal({title: "Cargando", text: "Se esta realizando la acción", type: "info", showConfirmButton: false});
	});
});
