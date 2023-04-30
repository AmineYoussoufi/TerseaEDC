<template>
    <div>
        <employee v-if="user.type != 'administrateur'">
            <span class="font-bold text-2xl"> Mon Profil </span>
            <hr class="my-3">
            <el-form label-position="top">
                <el-row :gutter="10">
                    <el-col :span="12">
                        <el-form-item label="Nom et Prénom">
                            <el-input v-model="profile.name" />
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="email">
                            <el-input v-model="profile.email" disabled />
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="Téléphone">
                            <el-input v-model="profile.telephone" />
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="Date de naissance">
                            <el-date-picker v-model="profile.date_de_naissance" class="w-full" />
                        </el-form-item>
                    </el-col>
                    <el-col :span="24">
                        <el-form-item label="Adresse">
                            <el-input v-model="profile.adresse" :rows="3" type="textarea" placeholder="Saisir" />
                        </el-form-item>
                    </el-col>
                    <el-col :span="24" class="text-right">
                        <el-button type="primary" @click="saveProfile()"> Enregistrer </el-button>
                    </el-col>
                </el-row>
            </el-form>

        </employee>
        <administrateur v-else>

        </administrateur>
    </div>
</template>
<script>
import axios from "axios"
import { ElMessage } from 'element-plus'
export default {
    data() {
        return {
            profile: {}
        }
    },
    computed: {
        user() {
            if (JSON.parse(localStorage.getItem("auth")) != null) {
                return JSON.parse(localStorage.getItem("auth"))
            }
            else {
                this.$router.push("/login")
            }
        },
    },
    mounted() {
        this.getProfile()
    },
    methods: {
        getProfile() {
            axios.get("/api/v1/employes/" + this.user.id + "/edit").then(res => {
                this.profile = res.data
            })
        },
        saveProfile() {
            axios.put("/api/v1/employes/" + this.profile.id, this.profile).then(res => {
                localStorage.setItem('auth', JSON.stringify(res.data))
            }).then(() => {
                ElMessage.success("Profil enregistré avec succès")
            }).catch(err => {
                ElMessage.error(err.response.data.message)
            })
        }
    }
}
</script>
