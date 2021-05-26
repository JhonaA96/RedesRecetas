<template>
    <input 
        type="submit" 
        class="btn btn-outline-danger w-100 d-block mb-2" 
        value="Eliminar"
        v-on:click = "eliminarReceta">
        
</template>

<script>
    export default{
        props: ['recetaId'],
        methods:{
            eliminarReceta(){
                this.$swal({
                    title: '¿Desea eliminar la receta?',
                    text: "Una vez eliminada, no se puede recuperar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No'
                }).then((result) => {
                if (result.isConfirmed) {
                    const params = {
                        id: this.recetaId,
                    }
                    /* Se envía la petición al servidor */
                    axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                        .then(respuesta =>{
                            this.$swal({
                                title: 'Receta Eliminada',
                                text: 'Se elimino la receta',
                                icon: 'seccess',
                            });
                            /* Se elimina receta del Doom */
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);

                        })
                        .catch(error =>{
                            console.log(error)
                        })
                        

                }
                })
            }
        }
    }
</script>
