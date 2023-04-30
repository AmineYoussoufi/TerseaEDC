import { createApp } from "vue"

import router from './router';
import App from './App.vue';
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import * as ElementPlusIconsVue from '@element-plus/icons-vue'
import store from "./store/index"


import Employee from "./layouts/Employee.vue"
import Admin from "./layouts/Admin.vue"

const app = createApp(App)
for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
    app.component(key, component)
}
app.component("employee",Employee)
app.component("administrateur",Admin)



app.use(router)
app.use(store)
app.use(ElementPlus)
app.mount("#app")
