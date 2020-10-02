<template>
    <div class="col-md-12 text-center">
        <a href="./vista-venta">
            <button type="submit" class="btn btn-light btn-sq-lg mx-3">
                <img src="https://img.icons8.com/officel/80/000000/cash-register.png"/>
                <hr class="my-1">
                Venta
            </button>
        </a>
        <a href="./vista-caja">
            <button type="submit" class="btn btn-light btn-sq-lg mx-3">
                <img src="https://img.icons8.com/officel/80/000000/safe.png"/>
                <hr class="my-1">
                Caja
            </button>
        </a>
        <a href="./vista-venta">
            <button type="submit" class="btn btn-light btn-sq-lg mx-3">
                <img src="https://img.icons8.com/officel/80/000000/in-inventory.png"/>
                <hr class="my-1">
                Producto
            </button>
        </a>
    </div>
</template>
<script>
export default {
    data(){
        return{
            admin: '',
        }
    },
    created(){
        axios.post('/usuario-admin').then(res=>{
          this.admin = res.data;
          console.log(this.admin)
        })
    }
}
</script>