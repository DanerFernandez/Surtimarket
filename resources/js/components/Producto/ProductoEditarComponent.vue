<template>
    <div>
        <div class="card mb-5">
            <div class="card-header text-center">Editar Producto</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="custom-control custom-switch my-3">
                            <!-- SWTICH -->
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="customSwitch1"
                                @click="activarBuscarNombre"
                            />
                            <label
                                class="custom-control-label"
                                for="customSwitch1"
                                >Buscar por nombre</label
                            >
                        </div>
                        <!-- END SWITCH -->
                        <form
                            v-if="opcionBusqueda"
                            @submit.prevent="buscarProducto_Codigo"
                        >
                            <!-- IF -->
                            <input
                                type="text"
                                class="form-control my-3"
                                placeholder="Codigo del Producto"
                                v-model="codigoProducto"
                                required
                                autofocus
                                onclick="this.select();"
                            />
                            <button
                                class="btn btn-purple btn-block mt-4"
                                type="submit"
                            >
                                Buscar por codigo
                            </button>
                        </form>
                        <div v-else>
                            <!-- ELSE -->
                            <form @submit.prevent="buscarProducto_Nombre">
                                <input
                                    type="text"
                                    class="form-control my-3"
                                    placeholder="Nombre del Producto"
                                    v-model="nombreProducto"
                                    required
                                    autofocus
                                    onclick="this.select();"
                                />
                                <button
                                    class="btn btn-dark btn-block mt-4"
                                    type="submit"
                                >
                                    Buscar por nombre
                                </button>
                            </form>
                            <div class="my-4" v-if="tablaBusquedaNombre">
                                <table class="table text-center table-hover">
                                    <thead>
                                        <tr style="background-color: #f5eefe !important;">
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(item,
                                            index) in resultadosBusquedaNombre"
                                            :key="index"
                                        >
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ item.nombre }}</td>
                                            <td>
                                                <a
                                                    class="btn btn-dark btn-sm"
                                                    @click="
                                                        buscarProducto_Nombre_ID(
                                                            item.codigo
                                                        )
                                                    "
                                                    >Editar</a
                                                >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END IF -->
                    </div>

                    <!-- Modal -->
                    <div
                        class="modal fade"
                        id="editarProductoModal"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="editarProductoModalLabel"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="card">
                                    <div class="card-header text-center">
                                        Editar Producto
                                        <button
                                            type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close"
                                        >
                                            <span aria-hidden="true"
                                                >&times;</span
                                            >
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div
                                            class="col-md-12"
                                            v-if="formularioEditarProducto"
                                        >
                                            <div class="row">
                                                <div
                                                    class="col-md-12 form-group"
                                                >
                                                    <label>Codigo <b class="text-danger">*</b></label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Codigo Producto"
                                                        v-model="
                                                            resultadoCodigo.id
                                                        "
                                                        disabled
                                                    />
                                                </div>
                                                <div
                                                    class="col-md-6 form-group"
                                                >
                                                    <label>Nombre <b class="text-danger">*</b></label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Nombre Producto"
                                                        v-model="
                                                            resultadoCodigo.nombre
                                                        "
                                                        maxlength="50"
                                                    />
                                                </div>
                                                <div
                                                    class="col-md-6 form-group"
                                                >
                                                    <label>Precio <b class="text-danger">*</b></label>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        placeholder="Precio Producto"
                                                        v-model.number="
                                                            resultadoCodigo.precio
                                                        "
                                                        step="any"
                                                    />
                                                </div>
                                                <div
                                                    class="col-md-12 form-group"
                                                >
                                                    <label>Descripción</label>
                                                    <textarea
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Descripción Producto"
                                                        v-model="
                                                            resultadoCodigo.descripcion
                                                        "
                                                        rows="3"
                                                        maxlength="200"
                                                    />
                                                </div>
                                                <div
                                                    class="col-md-6 form-group"
                                                >
                                                    <label>Stock <b class="text-danger">*</b></label>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        placeholder="Stock Producto"
                                                        v-model.number="
                                                            resultadoCodigo.stock
                                                        "
                                                    />
                                                </div>
                                                <div
                                                    class="col-md-6 form-group"
                                                >
                                                    <label>Stock Minimo</label>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        placeholder="Stock Producto"
                                                        v-model.number="
                                                            resultadoCodigo.stock_minimo
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button
                                            type="button"
                                            class="btn btn-purple btn-block"
                                            @click="editarProducto"
                                        >
                                            Editar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-block"
                                            data-dismiss="modal"
                                        >
                                            Cerrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL DE ERROR DE BUSQUEDA POR CODIGO Y NOMBRE -->
                    <div
                        class="modal fade"
                        id="errorBusquedaModal"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="errorBusquedaModalLabel"
                        aria-hidden="true"
                        onkeypress="$('#errorBusquedaModal').modal('hide');"
                    >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="card">
                                    <div class="card-header text-center">
                                        Mensaje
                                        <button
                                            type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close"
                                        >
                                            <span aria-hidden="true"
                                                >&times;</span
                                            >
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        El producto <b>no existe</b> en la base
                                        de datos.
                                    </div>
                                    <div class="card-footer">
                                        <button
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
                                            <span aria-hidden="true"
                                                >&times;</span
                                            >
                                        </button>
                                    </div>
                                    <div class="card-body" v-if="respuestaBien">
                                        El producto se edito
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            codigoProducto: "",
            nombreProducto: "",
            opcionBusqueda: true,
            tablaBusquedaNombre: false,
            formularioEditarProducto: false,
            resultadosBusquedaNombre: [],
            resultadoCodigo: "",
            respuestaBien: false,
            respuestaMal: false
        };
    },
    methods: {
        activarBuscarNombre() {
            if (this.opcionBusqueda) {
                this.opcionBusqueda = false;
            } else if (!this.opcionBusqueda) {
                this.opcionBusqueda = true;
            }
        },
        buscarProducto_Codigo() {
            axios.get(`producto/` + this.codigoProducto).then(
                res => {
                    this.formularioEditarProducto = true;
                    this.resultadoCodigo = res.data;
                    $("#editarProductoModal").modal("show");
                },
                error => {
                    if (error.response) {
                        const code = error.response.status;
                        if (code === 404) {
                            $("#errorBusquedaModal").modal("show");
                            return console.log(document.activeElement);
                        }
                    }
                }
            );
            this.codigoProducto = "";
        },
        buscarProducto_Nombre_ID(id) {
            axios.get(`producto/` + id).then(res => {
                this.formularioEditarProducto = true;
                this.resultadoCodigo = res.data;
                $("#editarProductoModal").modal("show");
            });
            this.codigoProducto = "";
        },
        buscarProducto_Nombre() {
            this.resultadosBusquedaNombre = []; // Array que se llena con resultados de la busqueda
            const params = {
                //codigo: 0, // Lo pongo en 0 porque no lo usare y no halla errores con el llenado
                nombre: this.nombreProducto // El nombre si se usara para la busqueda
            };
            axios.post(`busquedaNombreProducto`, params).then(res => {
                if (res.data.length < 1) {
                    this.tablaBusquedaNombre = false;
                    $("#errorBusquedaModal").modal("show");
                    this.nombreProducto = "";
                } else {
                    this.tablaBusquedaNombre = true;
                    for (let index = 0; index < res.data.length; index++) {
                        // Bucle que recorre el array con resultados res.data
                        this.resultadosBusquedaNombre.push({
                            // Aqui se inserta lo que quiero en el array de resultados de la busqueda
                            codigo: res.data[index].id,
                            nombre: res.data[index].nombre
                        });
                    }
                    this.nombreProducto = ""; // El input de nombre producto se pone vacio
                }
            });
        },
        editarProducto() {
            const productoEditado = {
                nombre: this.resultadoCodigo.nombre,
                descripcion: this.resultadoCodigo.descripcion,
                precio: this.resultadoCodigo.precio,
                stock: this.resultadoCodigo.stock,
                stock_minimo: this.resultadoCodigo.stock_minimo
            };
            axios
                .put(`producto/${this.resultadoCodigo.id}`, productoEditado)
                .then(res => {
                    if (res.data) {
                        $("#editarProductoModal").modal("hide");
                        $("#respuestaModal").modal("show");
                        this.respuestaBien = true;
                        this.respuestaMal = false;
                    } else {
                        $("#editarProductoModal").modal("hide");
                        $("#respuestaModal").modal("show");
                        this.respuestaBien = false;
                        this.respuestaMal = true;
                    }

                    return console.log(res.data);
                },error => {
                    if (error.response) {
                        const code = error.response.status;
                        if (code === 500) {
                            alert('Error.')
                            return console.log(document.activeElement);
                        }
                    }
                });
        }
    }
};
</script>
