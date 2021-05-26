<template>
   <span v-text="formatearFecha"></span>
</template>

<script>
    export default {
        props: ['fecha'],
        computed:{
            formatearFecha(){
                return moment(this.fecha).locale('en').format('MMMM DD [,] YYYY')
            }
        }
    }
</script>
