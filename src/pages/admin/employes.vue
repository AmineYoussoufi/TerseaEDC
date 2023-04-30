<template>
    <administrateur>
        <el-row :gutter="10">
            <el-col :span="12">
                <span class="font-bold text-2xl"> Employés </span>
            </el-col>
            <el-col :span="12" class="text-right">
                <el-button type="primary" @click="nouveau = true"> Ajouter </el-button>
            </el-col>
        </el-row>
        <hr class="my-3">
        <el-form label-position="left">
            <el-row :gutter="10">
                <el-col :span="24">
                    <el-form-item label="Rechercher par nom">
                        <el-input v-model="field" />
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
        <el-dialog title="Nouvel employé" v-model="nouveau">
            <el-form label-position="top">
                <el-form-item label="Nom">
                    <el-input v-model="admin.name" />
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="admin.email" />
                </el-form-item>
                <el-form-item label="Societe">
                    <el-select v-model="admin.societe_id">
                        <el-option v-for="s in societes" :key="s.id" :label="s.raison_social" :value="s.id" />
                    </el-select>
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="nouveau = false">Annuler</el-button>
                    <el-button type="primary" @click="addEmployé">
                        Inviter
                    </el-button>
                </span>
            </template>
        </el-dialog>
        <hr class="my-3">
        <el-table :data="employes" height="600" size="small" style="width: 100%">
            <el-table-column prop="name" label="Nom " />
            <el-table-column prop="email" label="Email" />
            <el-table-column prop="raison_social" label="Société" />
            <el-table-column prop="status" label="Status" />
            <el-table-column label="" width="100px">
                <template #default="scope">
                    <el-button type="danger" link @click="deleteEmployé(scope.row.id)"> Supprimer </el-button>
                </template>
            </el-table-column>
        </el-table>
    </administrateur>
</template>
<script>
import axios from "axios"
export default {
    data() {
        return {
            employes: [],
            societes: [],
            nouveau: false,
            field: '',
            admin: {
                name: "",
                email: "",
                password: ""
            }
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
    methods: {
        getEmployés() {
            axios.get("/api/v1/employes").then(res => {
                this.employes = res.data
            })
        },
        search() {
            axios.post("/api/v1/search-employe", { search: this.field }).then(res => {
                this.employes = res.data
            })
        },
        getSocietes() {
            axios.get("/api/v1/societes").then(res => {
                this.societes = res.data
            })
        },
        addEmployé() {
            this.admin.administrateur = this.user.name
            axios.post("/api/v1/employes", this.admin).then(() => {
                this.getEmployés();
                this.nouveau = false
                this.admin = {
                    name: "",
                    email: "",
                    password: ""
                }
            })
        },
        deleteEmployé(x) {
            if (confirm("êtes vous sur de vouloir supprimer cet administrateur") == true) {
                axios.delete("/api/v1/employes/" + x).then(() => {
                    this.getEmployés()
                })
            }
        }
    },
    mounted() {
        this.getSocietes();
        this.getEmployés()
    },
    watch: {
        'field': {
            handler: function (newValue) {
                this.search()
            },
            deep: true
        },
    }
}
</script>
