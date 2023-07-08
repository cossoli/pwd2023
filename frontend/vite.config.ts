import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
   server :{
    host :'192.168.20.25',
    port : 8080,
   },


  plugins: [vue()],
})
