<template>
    <div>
        <div class="card">
            <div class="card-header text-center">
                Crear Nuevo Producto
            </div>
            <div class="card-body">
                <form @submit.prevent="crearProducto">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Codigo <b class="text-danger">*</b></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Codigo del producto"
                                v-model="codigoProducto"
                                maxlength="100"
                                autofocus
                                required
                            />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Nombre <b class="text-danger">*</b></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Nombre del producto"
                                v-model="nombreProducto"
                                maxlength="50"
                                required
                            />
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Descripción</label>
                            <textarea
                                type="text"
                                class="form-control"
                                placeholder="Descripción Producto"
                                rows="3"
                                v-model="descripcionProducto"
                                maxlength="200"
                            />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Precio <b class="text-danger">*</b></label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="Precio del producto"
                                v-model.number="precioProducto"
                                step="any"
                                required
                            />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Stock <b class="text-danger">*</b></label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="Stock del producto"
                                v-model.number="stockProducto"
                                min="0"
                                required
                            />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Stock Minimo</label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="Stock Minimo del producto"
                                v-model.number="stockMinimoProducto"
                            />
                        </div>
                        <div class="col-md-12 my-4">
                            <button
                                type="submit"
                                class="btn btn-block btn-purple"
                            >
                                Crear Producto
                            </button>
                        </div>
                    </div>
                </form>
                <hr class="my-3" />
                <p class="text-center font-weight-bolder">
                    Ultimos 50 productos creados
                </p>
                <div class="scrollable-sm" id="scroll-carrito">
                    <table class="table text-center table-hover">
                        <thead>
                            <tr style="background-color: #f5eefe !important">
                                <th scope="col" class="sticky-table-header">
                                    #
                                </th>
                                <th scope="col" class="sticky-table-header">
                                    Id
                                </th>
                                <th scope="col" class="sticky-table-header">
                                    Nombre
                                </th>
                                <th scope="col" class="sticky-table-header">
                                    Descripcion
                                </th>
                                <th scope="col" class="sticky-table-header">
                                    Precio
                                </th>
                                <th scope="col" class="sticky-table-header">
                                    Stock
                                </th>
                                <th scope="col" class="sticky-table-header">
                                    Stock Minimo
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(item, index) in ultimosProductosCreados"
                                :key="index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ item.id }}</td>
                                <td>{{ item.nombre }}</td>
                                <td>{{ item.descripcion }}</td>
                                <td>{{ item.precio }}</td>
                                <td>{{ item.stock }}</td>
                                <td>{{ item.stock_minimo }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- MODAL DE RESPUESTA DEL SERVER -->
                <div
                    class="modal fade"
                    id="respuestaModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="respuestaModalLabel"
                    aria-hidden="true"
                    onkeypress="$('#respuestaModal').modal('hide');"
                >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header text-center">
                                    Respuesta
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close"
                                    >
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="card-body" v-if="mensaje == true">
                                    El producto creado
                                    <b>correctamente</b>.
                                </div>
                                <div class="card-body" v-if="mensaje == false">
                                    <b>Ocurrio un error al intentar editar el
                                    producto.</b><br>
                                    Posiblemente el id de producto ingresado ya existe en la base de datos.<br>
                                    <i style="font-size: 12px">Si el problema persiste por favor contacte con el desarrollador.</i>
                                </div>
                                <div class="card-footer">
                                    <button
                                        v-if="mensaje == true"
                                        type="button"
                                        class="btn btn-success btn-block"
                                        data-dismiss="modal"
                                    >
                                        Cerrar
                                    </button>
                                    <button
                                        v-if="mensaje == false"
                                        type="button"
                                        class="btn btn-danger btn-block"
                                        data-dismiss="modal"
                                    >
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            ultimosProductosCreados: [],
            codigoProducto: "",
            nombreProducto: "",
            descripcionProducto: "",
            precioProducto: "",
            stockProducto: "",
            stockMinimoProducto: "",
            respuestaBien: false,
            respuestaMal: false,
            mensaje: true
        };
    },
    created() {
        axios.get("producto").then(res => {
            this.ultimosProductosCreados = res.data;
        });
    },
    methods: {
        crearProducto() {
            const nuevoProducto = {
                codigoProducto: this.codigoProducto,
                nombreProducto: this.nombreProducto,
                descripcionProducto: this.descripcionProducto,
                precioProducto: this.precioProducto,
                stockProducto: this.stockProducto,
                stockMinimoProducto: this.stockMinimoProducto
            };

            axios.post(`producto`, nuevoProducto).then(
                res => {
                    //Envio un mensaje de producto creado correctamente
                    this.mensaje = true;//Mensaje Bueno
                    $("#respuestaModal").modal("show");

                    //Pongo en blanco los campos
                    this.codigoProducto = "";
                    this.nombreProducto = "";
                    this.descripcionProducto = "";
                    this.precioProducto = "";
                    this.stockProducto = "";
                    this.stockMinimoProducto = "";

                    //Desde el controlador envio la lista de ultimos 50 productos creados.
                    this.ultimosProductosCreados = res.data;
                },
                error => {
                    console.log(error)
                    this.mensaje = false;//Mensaje de que ocurrio un error
                    $("#respuestaModal").modal("show");
                }
            );
        }
    }
};
</script>
