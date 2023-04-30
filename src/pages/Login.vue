<template>
    <el-row class="h-screen"
        style="background-image: url(/cdn/images/servers.jpg); background-position:center; background-size:cover">
        <el-col :sm="0" :md="0" :xs="0" :lg="8">
            <div class="hero h-screen">
            </div>
        </el-col>
        <el-col :sm="24" :md="24" :xs="24" :lg="16" class="bg-white">
            <div class="hero h-screen ">
                <div class="hero-content w-96 border-2 ">
                    <el-form class="w-full" :label-position="'top'" label-width="200px" :model="credentials">
                        <div class="text-2xl font-bold p-4 text-center"> Mini CRM </div>
                        <el-form-item>
                            <el-input placeholder="Adresse Email" size="large" v-model="credentials.email" />
                        </el-form-item>
                        <el-form-item>
                            <el-input placeholder="Mot de passe" size="large" type="password"
                                v-model="credentials.password" />
                        </el-form-item>
                        <el-form-item>
                            <el-button @click="login" class="mt-4 w-full mx-auto " type="primary" size="large">
                                <el-icon>
                                    <Right />
                                </el-icon> &nbsp; Se connecter
                            </el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
        </el-col>
    </el-row>
</template>
<script>
import { ElMessage } from 'element-plus'
import axios from "axios"
export default {
    data() {
        return {
            credentials: {
                email: "",
                password: "",
            }
        }
    },
    methods: {
        login() {
            axios.post("/api/v1/login-user", this.credentials).then(res => {
                localStorage.setItem('auth', JSON.stringify(res.data.user))
            }).then(res => {
                this.$router.push("/")
            }).catch(err => {
                ElMessage.error("Login ou/et mot de passe incorrect.")
            })
        }
    }
}

</script>