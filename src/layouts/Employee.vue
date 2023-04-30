<template>
    <div class="common-layout">
        <el-container>
            <el-header class="bg-info">
                <div class="navbar p-0 bg-info text-white">

                    <div class="flex-1">
                        <a class="btn btn-sm btn-ghost normal-case text-xl">Mini CRM </a>
                    </div>
                    <div class="flex-none">
                        <a class="btn btn-sm btn-ghost normal-case text-xl">
                            {{ user.name }}
                        </a>
                    </div>
                    <div class="flex-none">
                        <button class="btn btn-sm btn-square btn-ghost" @click="logout()">
                            <el-icon size="large" >
                                <SwitchButton />
                            </el-icon>
                        </Button>
                    </div>
                </div>
            </el-header>
            <el-container>
                <el-aside width="200px">
                    <el-menu
                        class="el-vertical-height"
                        :default-active="this.$router.currentRoute._value.fullPath"
                    >
                        <el-menu-item index="/" @click="goTo('/')">
                            <el-icon><User /></el-icon> <span>Mon profil</span>
                        </el-menu-item>
                        <el-menu-item index="/ma-societe" @click="goTo('/ma-societe')" v-if="user.status=='Profil Créé'">
                            <el-icon><House /></el-icon> <span>Ma société</span>
                        </el-menu-item>
                    </el-menu>
                </el-aside>
                <el-main class="el-vertical-height overflow-y-height">
                    <slot/>
                </el-main>
            </el-container>
        </el-container>
    </div>
</template>
<style>
    .el-vertical-height{
        height:calc(100vh - 65px)
    }
    .bg-info{
        height:65px
    }
</style>
<script>
export default {
    mounted(){
        if(JSON.parse(localStorage.getItem("auth"))==null)
        {
            this.goTo("/login")
        }
    },
    computed:{
        user(){
            if(JSON.parse(localStorage.getItem("auth"))!=null)
            {
                return JSON.parse(localStorage.getItem("auth"))
            }
            else {
                this.$router.push("/login")
            }
        },
    },
    methods:{
        goTo(x)
        {
            this.$router.push(x)
        },
        logout()
        {
            localStorage.removeItem("auth")
            this.goTo("/login")
        }
    }
}
</script>
