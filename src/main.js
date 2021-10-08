import { createApp } from 'vue';
import App from './App.vue';
import PrimeVue from 'primevue/config';
import router from './router';
import axios from 'axios'
import VueAxios from 'vue-axios'

import Button from 'primevue/button';
import InputText from 'primevue/InputText';
import InputNumber from 'primevue/InputNumber';
import RadioButton from 'primevue/radiobutton';

import 'primevue/resources/themes/saga-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css'; 
import 'primeflex/primeflex.css';

const app = createApp(App);

app.use(PrimeVue);
app.use(router);
app.use(VueAxios, axios);

app.component('Button', Button);
app.component('InputText', InputText);
app.component('InputNumber', InputNumber);
app.component('RadioButton', RadioButton);


app.mount('#app');
