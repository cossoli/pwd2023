import { createApp } from 'vue';
import './style.css';
import App from './App.vue'
import VueAxios from "vue-axios";
import axios from 'axios';
import Router from './routes/routes.ts'


const app = createApp(App)
app.use(VueAxios, axios) 
app.use(Router)

app.mount('#app')