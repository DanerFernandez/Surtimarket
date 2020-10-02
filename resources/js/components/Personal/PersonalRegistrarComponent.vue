<template>
    <div>
        <div class="card">
            <div class="card-header text-center">
                Registrar Personal
            </div>
            <div class="card-body">
                <form @submit.prevent="registrarPersonal">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Nombre <b class="text-danger">*</b></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Nombre"
                                v-model="nuevoProducto.nombre"
                                maxlength="191"
                                autofocus
                                required
                            />
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Usuario <b class="text-danger">*</b></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Usuario"
                                v-model="nuevoProducto.usuario"
                                maxlength="191"
                                required
                            />
                        </div>
                        <div class="col-md-6 form-group">
                            <label
                                >Contraseña <b class="text-danger">*</b></label
                            >
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Contraseña"
                                v-model="nuevoProducto.contraseña"
                                maxlength="191"
                                required
                            />
                        </div>
                        <div class="col-md-6 form-group">
                            <label
                                >Confirmar Contraseña
                                <b class="text-danger">*</b></label
                            >
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Confirmar Contraseña"
                                v-model="nuevoProducto.confirmarContraseña"
                                maxlength="191"
                                required
                            />
                        </div>
                        <div class="col-md-12 mt-4">
                            <button
                                type="submit"
                                class="btn btn-block btn-purple"
                            >
                                Registrar
                            </button>
                        </div>
                    </div>
                </form>
                <!-- MODAL DE RESPUESTA DEL SERVER -->
                <div
                    class="modal fade"
                    id="mensajeModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="mensajeModalLabel"
                    aria-hidden="true"
                    onkeypress="$('#mensajeModal').modal('hide');"
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
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    {{mensaje}}
                                </div>
                                <div class="card-footer">
                                    <button
                                        type="button"
                                        class="btn btn-success btn-block"
                                        data-dismiss="modal"
                                        v-if="!mensajeError"
                                    >
                                        Cerrar
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-block"
                                        data-dismiss="modal"
                                        v-if="mensajeError"
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
            nuevoProducto: {
                nombre: "",
                usuario: "",
                contraseña: "",
                confirmarContraseña: ""
            },
            mensaje: "",
            mensajeError: false,
        };
    },
    methods: {
        registrarPersonal() {
            if (this.nuevoProducto.contraseña == this.nuevoProducto.confirmarContraseña) {
                const params = {
                    nombre: this.nuevoProducto.nombre,
                    usuario: this.nuevoProducto.usuario,
                    contrasena: this.nuevoProducto.contraseña,
                }
                axios.post(`usuario`, params).then( res => {
                    this.mensaje = 'Registro Exitoso'
                    $('#mensajeModal').modal('show');
                    this.nuevoProducto.nombre = ''
                    this.nuevoProducto.usuario = ''
                    this.nuevoProducto.contraseña = ''
                    this.nuevoProducto.confirmarContraseña = ''
                })
                
            } else {
                this.mensaje = 'ERROR. Las contraseñas no coinciden.'
                this.mensajeError = true
                $('#mensajeModal').modal('show');
            }
        }
    }
};
</script>
