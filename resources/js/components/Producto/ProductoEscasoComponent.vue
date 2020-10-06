<template>
    <div>
        <div class="card">
            <div class="card-header text-center">
                Escaso Stock
            </div>
            <div class="card-body">
                <table class="table text-center table-hover">
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
                        <tr v-for="(item, index) in escasoStock" :key="index">
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
        <div
            class="modal fade"
            id="aumentarStockModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="aumentarStockModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header text-center">
                            Aumentar Stock
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="aumentar">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Nombre</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Nombre"
                                            v-model="productoAumentar.nombre"
                                            disabled
                                        />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Stock</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            placeholder="Stock"
                                            v-model="productoAumentar.stock"
                                            disabled
                                        />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Stock Minimo</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            placeholder="Stock Minimo"
                                            v-model="
                                                productoAumentar.stock_minimo
                                            "
                                            disabled
                                        />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Aumentar</label>
                                        <input
                                            id="form_aumentar"
                                            type="number"
                                            class="form-control"
                                            placeholder="Aumentar"
                                            v-model.number="
                                                productoAumentar.aumentar
                                            "
                                        />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><b>Nuevo Stock</b></label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            placeholder="Nuevo Stock"
                                            v-model="nuevoStock"
                                            disabled
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button
                                    type="submit"
                                    class="btn btn-warning btn-block"
                                >
                                    Aumentar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{ calcularNuevoStock }}
    </div>
</template>
<script>
export default {
    data() {
        return {
            escasoStock: "",
            productoAumentar: "",
            nuevoStock: 0
        };
    },
    created() {
        axios.post("escaso-stock").then(res => {
            this.escasoStock = res.data;
        });
    },
    computed: {
        calcularNuevoStock() {
            this.nuevoStock =
                this.productoAumentar.stock + this.productoAumentar.aumentar;
        }
    },
    methods: {
        producto_aumentar(id) {
            axios.get("producto/" + id).then(res => {
                this.productoAumentar = {
                    codigo: res.data.id,
                    nombre: res.data.nombre,
                    stock: res.data.stock,
                    stock_minimo: res.data.stock_minimo,
                    aumentar: 0
                };
            });
            $("#aumentarStockModal").modal("show");
            setTimeout(focus, 500);
            function focus() {
                $("#form_aumentar").focus();
                $("#form_aumentar").select();
            }
        },
        aumentar() {
            axios
                .post("aumentar-stock-producto", this.productoAumentar)
                .then(res => {
                    axios.post("escaso-stock").then(res => {
                        this.escasoStock = res.data;
                        $("#aumentarStockModal").modal("hide");
                    });
                });
        }
    }
};
</script>
