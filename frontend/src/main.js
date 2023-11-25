// src/main.js
/* 
import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';



import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap'


const app = createApp(App);



app.config.globalProperties.$axios = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/', // Substitua pela URL da sua API
});



app.mount('#app'); */
import { createApp } from 'vue'

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap'

import App from './App.vue'
import axios from 'axios'

import router from './router';
const app = createApp(App);

app.config.globalProperties.$axios = axios;
app.use(router);
app.mount('#app');
