<template>
    <administrateur>
        <el-row :gutter="10">
            <el-col :span="12">
                <span class="font-bold text-2xl"> Historique </span>
            </el-col>
            <el-col :span="12" class="text-right">

            </el-col>
        </el-row>
        <hr class="my-3">
        <el-table :data="history" height="600" size="small" style="width: 100%">
            <el-table-column prop="created_at" label=" Date et heure " width="150">
                <template #default="scope">
                    <b>{{ moment(scope.row.created_at).format("DD/MM/YYYY à HH:mm:ss") }}</b>
                </template>
            </el-table-column>
            <el-table-column prop="content" label="Activité" />
        </el-table>
    </administrateur>
</template>
<script>
import axios from "axios"
import moment from "moment"
export default {
    data() {
        return {
            history: [],
            moment: moment
        }
    },
    methods: {
        getHistory() {
            axios.get("/api/v1/history").then(res => {
                this.history = res.data
            })
        }
    },
    mounted() {
        this.getHistory()
    }
}
</script>
