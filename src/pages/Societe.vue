<template>
    <div>
        <employee v-if="user.type != 'admin'">
            <span class="font-bold text-2xl"> Ma société </span>
            <hr class="my-3">
            <el-form label-position="top">
                <el-form-item label="ICE">
                    <el-input v-model="societe.ice" />
                </el-form-item>
                <el-form-item label="Raison Social">
                    <el-input v-model="societe.raison_social" />
                </el-form-item>
                <el-form-item label="Siege Social">
                    <el-input v-model="societe.siege_social" />
                </el-form-item>
                <el-form-item label="Capital Social">
                    <el-input v-model="societe.captal_social" />
                </el-form-item>
                <el-form-item label="CNSS">
                    <el-input v-model="societe.cnss" />
                </el-form-item>
                <el-form-item label="Telephone">
                    <el-input v-model="societe.telephone" />
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="societe.email" />
                </el-form-item>
                <div class="text-right">
                    <el-button type="primary" @click="saveSociete()"> Enregistrer </el-button>
                </div>
            </el-form>
        </employee>
    </div>
</template>
<script>
import axios from "axios"
import { ElMessage } from 'element-plus'
export default {
    data() {
        return {
            societe: {}
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
        this.getSociete()
    },
    methods: {
        getSociete() {
            axios.get("/api/v1/societes/" + this.user.societe_id).then(res => {
                this.societe = res.data
            })
        },
        saveSociete() {
            axios.put("/api/v1/societes/" + this.societe.id, this.societe).then(() => {
                ElMessage.success("Informations enregistrées avec succès")
            }).catch(err => {
                ElMessage.error("Erreur lors de l'enregistrement")
            })
        }
    }
}
</script>
