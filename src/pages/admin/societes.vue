<template>
    <administrateur>
        <el-row :gutter="10">
            <el-col :span="12">
                <span class="font-bold text-2xl"> Societes </span>
            </el-col>
            <el-col :span="12" class="text-right">
                <el-button type="primary" @click="nouveau = true"> Ajouter </el-button>
            </el-col>
        </el-row>
        <hr class="my-3">
        <el-form label-position="left">
            <el-row :gutter="10">
                <el-col :span="24">
                    <el-form-item label="Rechercher par raison social">
                        <el-input v-model="field" />
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
        <el-dialog title="Nouvelle société" v-model="nouveau">
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
                    <el-input v-model="societe.capital_social" />
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
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="nouveau = false">Annuler</el-button>
                    <el-button type="primary" @click="addSociete">
                        Confirmer
                    </el-button>
                </span>
            </template>
        </el-dialog>
        <hr class="my-3">
        <el-table :data="societes" height="600" size="small" style="width: 100%">
            <el-table-column prop="ice" label="ICE " />
            <el-table-column prop="raison_social" label="Raison Social" />
            <el-table-column label="" width="100px">
                <template #default="scope">
                    <el-button type="danger" link @click="deleteSociete(scope.row.id)"> Supprimer </el-button>
                </template>
            </el-table-column>
        </el-table>
    </administrateur>
</template>
<script>
import axios from "axios"
import { ElMessage } from 'element-plus'
export default {
    data() {
        return {
            nouveau: false,
            field: '',
            societes: [],
            societe: {

            }
        }
    },
    methods: {
        getSocietes() {
            axios.get("/api/v1/societes").then(res => {
                this.societes = res.data
            })
        },
        search() {
            axios.post("/api/v1/search-societe", { search: this.field }).then(res => {
                this.societes = res.data
            })
        },
        addSociete() {
            axios.post("/api/v1/societes", this.societe).then(() => {
                this.getSocietes();
                this.nouveau = false
                this.societe = {

                }
            })
        },
        deleteSociete(x) {
            if (confirm("êtes vous sur de vouloir supprimer cette societe") == true) {
                axios.delete("/api/v1/societes/" + x).then(() => {
                    this.getSocietes()
                }).catch(err => {
                    ElMessage.error(err.response.data.message)
                })
            }
        }
    },
    watch: {
        'field': {
            handler: function (newValue) {
                this.search()
            },
            deep: true
        },
    },
    mounted() {
        this.getSocietes()
    }
}
</script>
