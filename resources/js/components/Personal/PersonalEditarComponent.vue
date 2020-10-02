<template>
    <div>
        <div class="card">
            <div class="card-header text-center">
                Editar Personal
            </div>
            <div class="card-body">
                <table class="table text-center table-hover">
                    <thead>
                        <tr style="background-color: #f5eefe !important">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in usuariosAll" :key="index">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ item.name }}</td>
                            <td>{{ item.email }}</td>
                            <td>
                                <a
                                    class="btn btn-sm btn-primary mx-2"
                                    @click="datosUsuario_db(item.id)"
                                    onclick="$('#personalEditarModal').modal('show');"
                                    >Editar Datos</a
                                >
                                <a
                                    class="btn btn-sm btn-danger mx-2"
                                    @click="datosUsuario_db(item.id)"
                                    onclick="$('#reestablecerContraseñaModal').modal('show');"
                                    >Reestablecer Contraseña</a
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="modal fade"
                id="personalEditarModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="personalEditarModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="card-header text-center">
                                Editar Personal
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
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label
                                            >Nombre
                                            <b class="text-danger">*</b></label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Nombre"
                                            v-model="datosUsuario.nombre"
                                            required
                                        />
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label
                                            >Usuario
                                            <b class="text-danger">*</b></label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Usuario"
                                            v-model="datosUsuario.usuario"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button
                                    type="button"
                                    class="btn btn-purple btn-block"
                                    data-dismiss="modal"
                                    @click="editarDatosUsuario"
                                >
                                    Editar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="modal fade"
                id="reestablecerContraseñaModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="reestablecerContraseñaModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card">
                            <div class="card-header text-center">
                                Reestablecer Contraseña
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
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Nombre</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="datosUsuario.nombre"
                                            disabled
                                        />
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Usuario </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="datosUsuario.usuario"
                                            disabled
                                        />
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label
                                            >Nueva Contraseña
                                            <b class="text-danger">*</b></label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Nueva Contraseña"
                                            v-model="nuevaContraseña"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button
                                    type="button"
                                    class="btn btn-purple btn-block"
                                    data-dismiss="modal"
                                    @click="reestablecerPassword"
                                >
                                    Reestablecer Contraseña
                                </button>
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
            usuariosAll: "",
            datosUsuario: {
                id: "",
                nombre: "",
                usuario: ""
            },
            nuevaContraseña: ""
        };
    },
    created() {
        axios.get("usuario").then(res => {
            this.usuariosAll = res.data;
        });
    },
    methods: {
        datosUsuario_db(id) {
            axios.get(`usuario/` + id).then(res => {
                this.datosUsuario.id = res.data.id;
                this.datosUsuario.nombre = res.data.name;
                this.datosUsuario.usuario = res.data.email;
                console.log(res.data);
            });
        },
        editarDatosUsuario() {
            if (this.datosUsuario.usuario==='' || this.datosUsuario.nombre==='') {
                alert('Debe llenar todos los campos.')
            }else{
                const params = {
                    id: this.datosUsuario.id,
                    nuevoNombre: this.datosUsuario.nombre,
                    nuevoUsuario: this.datosUsuario.usuario
                };
                axios.post("editar-datos-usuario", params).then(res => {
                    console.log(res.data);
                    axios.get("usuario").then(res => {
                        this.usuariosAll = res.data;
                    });
                });
            }
        },
        reestablecerPassword() {
            if (this.nuevaContraseña==='') {
                alert('Debe llenar todos los campos.')
            }else{
                const newpass = {
                    contrasena: this.nuevaContraseña
                };
                axios.put(`usuario/${this.datosUsuario.id}`, newpass).then(res => {
                    this.nuevaContraseña = "";
                    console.log(res.data);
                });
            }
        }
    }
};
</script>
