<template>

<div>
    <Header/>
    <div>
        <router-view></router-view>
    </div>
</div>

</template>

<script>

import Header from "./header.vue"

export default{

    name: "App",

    components: {

        Header
    }
}

</script>