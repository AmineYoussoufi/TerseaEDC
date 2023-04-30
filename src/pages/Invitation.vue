<template>
    <div class="hero min-h-screen ">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div v-if="error == false && recherche == false">
                <h1 class="text-5xl font-bold">Bonjour {{ user.name }}!</h1>
                <p class="py-6">
                    Vous avez reçu une invitation pour rejoindre l'espace de votre société , cliquez sur le bouton en bas
                    pour compléter votre profil
                </p>
                <el-button @click="accepter = true" size="large" type="primary"> Accepter </el-button>
            </div>
            <div v-if="error == true">
                <h1 class="text-5xl font-bold">Invitation Expirée ou Supprimée</h1>
                <p class="py-6">
                    Le lien que vous essayez de rejoindre est expiré ou supprimé , contactez votre administrateur
                </p>
            </div>
            <div v-if="error == false && recherche == true">
                <button class="btn btn-primary btn-ghost btn-lg loading"> Chargement </button>
            </div>
        </div>
        <el-dialog v-model="accepter" title="Configurer mot de passe">
            <el-form :model="form" label-position="top">
                <el-form-item label="Nouveau mot de passe">
                    <el-input v-model="form.first" type="password" autocomplete="off" />
                </el-form-item>
                <el-form-item label="Confirmation mot de passe">
                    <el-input v-model="form.second" type="password" autocomplete="off" />
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="accepter = false">Annuler</el-button>
                    <el-button type="primary" @click="accepterInvitation()">
                        Confirmer
                    </el-button>
                </span>
            </template>
        </el-dialog>
    </div>
</template>
<script>
import axios from "axios"
import { ElMessage } from 'element-plus'
export default {
    data() {
        return {
            form: {
                first: "",
                second: "",
            },
            error: false,
            recherche: false,
            accepter: false,
            user: {}
        }
    },
    mounted() {
        this.getInvitation();
    },
    methods: {
        getInvitation() {
            this.recherche = true
            axios.get("/api/v1/invitation/" + this.$route.query.id).then(res => {
                this.recherche = false
                this.user = res.data
            }).catch(() => {
                this.recherche = false
                this.error = true
            })
        },
        accepterInvitation() {
            this.form.user_id = this.user.id;
            this.form.invit_id = this.user.invit_id;
            axios.post("/api/v1/accepter-invitation", this.form).then(res => {
                localStorage.setItem('auth', JSON.stringify(res.data))
            }).then(() => {
                this.goTo("/")
            }).catch(err => {
                ElMessage.error(err.response.data.message)
            })
        },
        goTo(x) {
            this.$router.push(x)
        },
    }
}
</script>
