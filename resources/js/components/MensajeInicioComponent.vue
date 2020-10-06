<template>
    <div>
        <div class="card">
            <div class="card-header">
                Mensaje
            </div>
            <div class="card-body">
                <div class="scrollable-sm"> 
                    <table class="table text-center table-hover ">
                        <thead>
                            <tr style="background-color: #f5eefe !important">
                                <th scope="col">#</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Stock Minimo</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(item, index) in escasoStock"
                                :key="index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ item.id }}</td>
                                <td>{{ item.nombre }}</td>
                                <td>S/. {{ item.precio }}</td>
                                <td class="text-danger">
                                    <b>{{ item.stock }}</b>
                                </td>
                                <td>{{ item.stock_minimo }}</td>
                                <td>
                                    <a
                                        class="btn btn-warning btn-sm"
                                        @click="producto_aumentar(item.id)"
                                        >Aumentar</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            escasoStock: ""
        };
    },
    created() {
        axios.post("escaso-stock").then(res => {
            this.escasoStock = res.data;
        });
    }
};
</script>
