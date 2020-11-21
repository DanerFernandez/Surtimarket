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
                        <div class="col-md-12 mt-4">
                            <button
                                type="submit"
                                class="btn btn-block btn-purple"
                            >
                                Crear Producto
                            </button>
                        </div>
                    </div>
                </form>
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
                                <div class="card-body" v-if="respuestaBien">
                                    El producto creado
                                    <b>correctamente</b>.
                                </div>
                                <div class="card-body" v-if="respuestaMal">
                                    Ocurrio un error al intentar editar el
                                    producto.
                                </div>
                                <div class="card-footer">
                                    <button
                                        v-if="respuestaBien"
                                        type="button"
                                        class="btn btn-success btn-block"
                                        data-dismiss="modal"
                                    >
                                        Cerrar
                                    </button>
                                    <button
                                        v-if="respuestaMal"
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
            codigoProducto: "",
            nombreProducto: "",
            descripcionProducto: "",
            precioProducto: "",
            stockProducto: "",
            stockMinimoProducto: "",
            respuestaBien: false,
            respuestaMal: false
        };
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
                    this.respuestaBien = true;
                    this.respuestaMal = false;
                    $("#respuestaModal").modal("show");
                    this.codigoProducto = "";
                    this.nombreProducto = "";
                    this.descripcionProducto = "";
                    this.precioProducto = "";
                    this.stockProducto = "";
                    this.stockMinimoProducto = "";
                    console.log(res.data);
                },
                error => {
                    if (!error.response) {
                        alert("Error en el servidor.");
                    } else {
                        const code = error.response.status;
                        const response = error.response.data;
                        const originalRequest = error.config;
                        if (code === 404) {
                            this.respuestaBien = false;
                            this.respuestaMal = true;
                            $("#respuestaModal").modal("show");
                        }
                        return alert('Ha ocurrido un problema.');
                    }
                }
            );
        }
    }
};
</script>
