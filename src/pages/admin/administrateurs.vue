<template>
    <administrateur>
        <el-row :gutter="10">
            <el-col :span="12">
                <span class="font-bold text-2xl"> Administrateurs </span>
            </el-col>
            <el-col :span="12" class="text-right">
                <el-button type="primary" @click="nouveau=true"> Ajouter </el-button>
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
        <el-dialog title="Nouvel administrateur" v-model="nouveau">
            <el-form label-position="top">
                <el-form-item label="Nom">
                    <el-input v-model="admin.name" />
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="admin.email" />
                </el-form-item>
                <el-form-item label="Mot de passe">
                    <el-input type="password" v-model="admin.password" />
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="nouveau = false">Annuler</el-button>
                    <el-button type="primary" @click="addAdministrateur">
                        Confirmer
                    </el-button>
                </span>
            </template>
        </el-dialog>
        <hr class="my-3">
        <el-table :data="administrateurs" height="600" size="small" style="width: 100%">
            <el-table-column prop="name" label="Nom "  />
            <el-table-column prop="email" label="Email"  />
            <el-table-column label="" width="100px">
                <template #default="scope">
                    <el-button type="danger" link @click="deleteAdministrateur(scope.row.id)"> Supprimer </el-button>
                </template>
            </el-table-column>
        </el-table>
    </administrateur>
</template>
<script>
    import axios from "axios"
    export default {
        data(){
            return {
                administrateurs:[],
                nouveau:false,
                field:'',
                admin:{
                    name:"",
                    email:"",
                    password:""
                }
            }
        },
        methods:{
            getAdministrateurs(){
                axios.get("/api/v1/administrateurs").then(res=>{
                    this.administrateurs = res.data
                })
            },
            search(){
                axios.post("/api/v1/search-admin",{search:this.field}).then(res=>{
                    this.administrateurs = res.data
                })
            },
            addAdministrateur(){
                axios.post("/api/v1/administrateurs",this.admin).then(()=>{
                    this.getAdministrateurs();
                    this.nouveau=false
                    this.admin={
                        name:"",
                        email:"",
                        password:""
                    }
                })
            },
            deleteAdministrateur(x){
                if(confirm("êtes vous sur de vouloir supprimer cet administrateur")==true)
                {
                    axios.delete("/api/v1/administrateurs/"+x).then(()=>{
                        this.getAdministrateurs()
                    })
                }
            }
        },
        mounted()
        {
            this.getAdministrateurs()
        },
        watch:{
            'field': {
                handler: function(newValue) {
                    this.search()
                },
                deep: true
            },
        }
    }
</script>
