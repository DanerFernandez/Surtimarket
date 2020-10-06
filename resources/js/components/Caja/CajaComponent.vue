<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <span v-if="verVentasRealizadas" style="float: left">
                        <a class="btn btn-sm btn-light" @click="verVentasRealizadas = false">◄   ATRAS</a>
                    </span>
                    <span v-if="verAnularVentas" style="float: left">
                        <a class="btn btn-sm btn-light" @click="verAnularVentas = false">◄   ATRAS</a>
                    </span>
                    Caja
                </div>
                <div class="card-body">
                    <div v-if="caja.length === 0">
                        <p class="text-center">
                            <img
                                :src="
                                    '../resources/views/imagenes/safe-in-80x80.png'
                                "
                            />
                        </p>
                        <hr class="my-3" />
                        <button
                            class="btn btn-purple btn-block"
                            type="submit"
                            @click="abrirCaja"
                        >
                            Abrir Caja
                        </button>

                        <hr class="my-3" />
                        <p class="text-center font-weight-bolder">
                            Ultimas 30 cajas cerradas
                        </p>
                        <div class="scrollable-sm" id="scroll-carrito">
                            <table class="table text-center table-hover">
                                <thead>
                                    <tr
                                        style="background-color: #f5eefe !important"
                                    >
                                        <th
                                            scope="col"
                                            class="sticky-table-header"
                                        >
                                            #
                                        </th>
                                        <th
                                            scope="col"
                                            class="sticky-table-header"
                                        >
                                            Id Caja
                                        </th>
                                        <th
                                            scope="col"
                                            class="sticky-table-header"
                                        >
                                            Fecha de inicio
                                        </th>
                                        <th
                                            scope="col"
                                            class="sticky-table-header"
                                        >
                                            Hora de inicio
                                        </th>
                                        <th
                                            scope="col"
                                            class="sticky-table-header"
                                        >
                                            Fecha de cierre
                                        </th>
                                        <th
                                            scope="col"
                                            class="sticky-table-header"
                                        >
                                            Hora de cierre
                                        </th>
                                        <th
                                            scope="col"
                                            class="sticky-table-header"
                                        >
                                            Estado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(item, index) in cajas_cerradas"
                                        :key="index"
                                    >
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>{{ item.id }}</td>
                                        <td>{{ item.fecha_inicio }}</td>
                                        <td>{{ item.hora_inicio }}</td>
                                        <td>{{ item.fecha_cierre }}</td>
                                        <td>{{ item.hora_cierre }}</td>
                                        <td v-if="item.estado === 1">
                                            <p
                                                class="font-weight-bolder text-success"
                                            >
                                                ABIERTO
                                            </p>
                                        </td>
                                        <td v-if="item.estado === 0">
                                            <p
                                                class="font-weight-bolder text-primary"
                                            >
                                                CERRADO
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-else>
                        <div v-if="!verVentasRealizadas && !verAnularVentas">
                            <a
                                class="btn btn-purple btn-block"
                                href="./vista-venta"
                            >
                                Ir a Venta
                            </a>
                            <div class="row my-5">
                                <div class="col-md-4 text-center">
                                    <button
                                        type="submit"
                                        class="btn btn-light btn-sq-lg mx-3"
                                        @click="verAnularVentas = true"
                                    >
                                        <img
                                            :src="
                                                '../resources/views/imagenes/cancel-2-80x80.png'
                                            "
                                        />
                                        <hr class="my-1" />
                                        Anular Venta
                                    </button>
                                </div>
                                <div class="col-md-4 text-center">
                                    <button
                                        type="submit"
                                        class="btn btn-light btn-sq-lg mx-3"
                                        @click="verVentasRealizadas = true"
                                    >
                                        <img
                                            :src="
                                                '../resources/views/imagenes/sell-80x80.png'
                                            "
                                        />
                                        <hr class="my-1" />
                                        Ventas Realizadas
                                    </button>
                                </div>
                                <div class="col-md-4 text-center">
                                    <button
                                        class="btn btn-light btn-sq-lg mx-3"
                                        type="button"
                                        data-toggle="modal"
                                        data-target="#cerrarCajaModal"
                                    >
                                        <img
                                            :src="
                                                '../resources/views/imagenes/safe-out-80x80.png'
                                            "
                                        />
                                        <hr class="my-1" />
                                        Cerrar Caja
                                    </button>
                                </div>
                            </div>
                            <table class="table text-center">
                                <thead>
                                    <tr
                                        style="background-color: #f5eefe !important"
                                    >
                                        <th scope="col">Id Caja</th>
                                        <th scope="col">Fecha de inicio</th>
                                        <th scope="col">Hora de inicio</th>
                                        <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ caja[0].id }}</td>
                                        <td>{{ caja[0].fecha_inicio }}</td>
                                        <td>{{ caja[0].hora_inicio }}</td>
                                        <td v-if="caja[0].estado === 1">
                                            <p
                                                class="font-weight-bolder text-success"
                                            >
                                                ABIERTO
                                            </p>
                                        </td>
                                        <td v-if="caja[0].estado === 0">
                                            <p
                                                class="font-weight-bolder text-danger"
                                            >
                                                CERRADO
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Modal -->
                        </div>
                        <div v-else>
                            <div v-if="verVentasRealizadas">
                                <ventas-realizadas-caja-component
                                    :id_caja="caja[0].id"
                                    @respuesta="verVentasRealizadas = $event"
                                />
                            </div>
                            <div v-if="verAnularVentas">
                                <anular-venta-caja-component
                                    @respuesta="verAnularVentas = $event"
                                />
                            </div>
                        </div>
                    </div>
                    <div
                        class="modal fade"
                        id="cerrarCajaModal"
                        tabindex="-1"
                        aria-labelledby="cerrarCajaModalLabel"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="card">
                                    <div class="card-header text-center">
                                        Cerrar Caja
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
                                    <div class="card-body text-center">
                                        <img
                                            :src="
                                                '../resources/views/imagenes/safe-out-80x80.png'
                                            "
                                        />
                                    </div>
                                    <div class="card-footer">
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-block my-3"
                                            data-dismiss="modal"
                                            @click="cerrarCaja"
                                        >
                                            Confirmar
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
            caja: [],
            cajas_cerradas: [],
            fecha_hora_separado: [],
            fecha_separada: [],
            fecha: "",
            verVentasRealizadas: false,
            verAnularVentas: false
        };
    },
    created() {
        //Busca la caja abierta, se supone que deberia ser 1
        axios.get("caja/create").then(res => {
            this.caja = res.data;
            //console.log(this.caja);
            axios.get("caja").then(res => {
                this.cajas_cerradas = res.data;
                //console.log(this.cajas_cerradas);
            });
        });
    },
    methods: {
        abrirCaja() {
            //Descompongo la fecha en partes para poder asignarlas a la nuevaCaja
            this.fecha_hora_separado = new Date().toLocaleString().split(" "); //Devuelve un array con la fecha y hora separadas por el ' '
            this.fecha_separada = this.fecha_hora_separado[0].split("/"); //Devuelve un array con la fecha separada por el '/'
            this.fecha =
                this.fecha_separada[2] +
                "-" +
                this.fecha_separada[1] +
                "-" +
                this.fecha_separada[0]; //Esta fecha es Año-Mes-Dia
            //Se llena los campos de nuevaCaja
            const nuevaCaja = {
                fecha_inicio: this.fecha,
                hora_inicio: this.fecha_hora_separado[1],
                fecha_cierre: "",
                hora_cierre: "",
                estado: 1
            };
            //Guarda la nueva caja en la base de datos
            axios.post("caja", nuevaCaja).then(res => {
                //Busca la caja abierta para mostrar que hay una
                axios.get("caja/create").then(res => {
                    this.caja = res.data;
                });
            });
        },
        cerrarCaja() {
            //Descompongo la fecha en partes para poder asignarlas a la nuevaCaja
            this.fecha_hora_separado = new Date().toLocaleString().split(" "); //Devuelve un array con la fecha y hora separadas por el ' '
            this.fecha_separada = this.fecha_hora_separado[0].split("/"); //Devuelve un array con la fecha separada por el '/'
            this.fecha =
                this.fecha_separada[2] +
                "-" +
                this.fecha_separada[1] +
                "-" +
                this.fecha_separada[0]; //Esta fecha es Año-Mes-Dia
            //Se llena los campos de nuevaCaja
            const idCaja = this.caja[0].id;
            const cerrarCaja = {
                fecha_inicio: this.caja[0].fecha_inicio,
                hora_inicio: this.caja[0].hora_inicio,
                fecha_cierre: this.fecha,
                hora_cierre: this.fecha_hora_separado[1],
                estado: 0
            };

            axios.put(`caja/${idCaja}`, cerrarCaja).then(res => {
                this.generarTicketCerrarCaja(this.caja[0].id);
                axios.get("caja/create").then(res => {
                    this.caja = res.data;
                    axios.get("caja").then(res => {
                        this.cajas_cerradas = res.data;
                        //console.log(this.cajas_cerradas);
                    });
                });
            });
        },
        generarTicketCerrarCaja(id_caja) {
            const idCaja = id_caja;
            window.open(
                "./ticket-cerrar-caja?id=" + idCaja,
                "_blank",
                "width=800,height=600"
            );
        }
    }
};
</script>
