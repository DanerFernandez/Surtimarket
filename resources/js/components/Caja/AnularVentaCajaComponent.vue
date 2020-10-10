<template>
    <div>
        <form @submit.prevent="informacionTicket">
            <div class="card-body">
                <div class="col-md-12 form-group">
                    <label>Numero de Ticket</label>
                    <input
                        type="number"
                        class="form-control"
                        placeholder="Numero de Ticket"
                        v-model.number="ticket"
                        required
                        autofocus
                    />
                </div>
                <button type="submit" class="btn btn-purple btn-block mt-4">
                    Anular Ticket
                </button>
            </div>
        </form>
        <div
            class="modal fade"
            id="informacionTicketModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="informacionTicketModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header text-center">
                            Informacion de Ticket
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
                                <div class="col-md-6 form-group">
                                    <b>N° de Caja:</b>
                                    <span>{{
                                        data_venta_users_Global.id_caja
                                    }}</span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <b>Cajero(a):</b>
                                    {{ data_venta_users_Global.name }}
                                </div>
                                <div class="col-md-6 form-group">
                                    <b>Fecha:</b>
                                    {{ fechaHoraPeru_Global[0] }}
                                </div>
                                <div class="col-md-6 form-group">
                                    <b>Hora:</b>
                                    {{ fechaHoraPeru_Global[1] }}
                                </div>
                                <div class="col-md-12 form-group">
                                    <div
                                        class="scrollable-sm"
                                        id="scroll-carrito"
                                    >
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-center sticky-table-header"
                                                        style="width: 5%"
                                                    >
                                                        N°
                                                    </th>
                                                    <th
                                                        class="text-center sticky-table-header"
                                                        style="width: 40%"
                                                    >
                                                        Producto
                                                    </th>
                                                    <th
                                                        class="px-1 text-center sticky-table-header"
                                                        style="width: 20%"
                                                    >
                                                        Precio
                                                    </th>
                                                    <th
                                                        class="px-1 text-center sticky-table-header"
                                                        style="width: 15%"
                                                    >
                                                        Cantidad
                                                    </th>
                                                    <th
                                                        class="px-1 text-center sticky-table-header"
                                                        style="width: 20%"
                                                    >
                                                        Importe
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="(item,
                                                    index) in data_detalleventa_productos_Global"
                                                    :key="index"
                                                >
                                                    <td class="align-top">
                                                        {{ index + 1 }}
                                                    </td>
                                                    <td>{{ item.nombre }}</td>
                                                    <td
                                                        class="text-center align-top"
                                                    >
                                                        S/.
                                                        {{
                                                            (
                                                                item.importe /
                                                                item.cantidad
                                                            ).toFixed(2)
                                                        }}
                                                    </td>
                                                    <td
                                                        class="text-center align-top"
                                                    >
                                                        {{ item.cantidad }}
                                                    </td>
                                                    <td
                                                        class="text-center align-top"
                                                    >
                                                        S/.
                                                        {{
                                                            item.importe.toFixed(
                                                                2
                                                            )
                                                        }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr class="my-3" />
                                    <table style="width:400px;">
                                        <tr>
                                            <td
                                                class="text-right"
                                                style="width: 70%;"
                                            >
                                                <b>Total: </b>
                                            </td>
                                            <td
                                                class="text-right"
                                                style="width: 30%;"
                                            >
                                                <span
                                                    >S/.
                                                    {{
                                                        parseFloat(
                                                            data_venta_users_Global.total,
                                                            10
                                                        ).toFixed(2)
                                                    }}</span
                                                >
                                            </td>
                                        </tr>
                                        <tr
                                            v-if="
                                                data_venta_users_Global.metodoPago ==
                                                    'Efectivo'
                                            "
                                        >
                                            <td
                                                class="text-right"
                                                style="width: 70%;"
                                            >
                                                <b
                                                    >{{
                                                        data_venta_users_Global.metodoPago
                                                    }}:
                                                </b>
                                            </td>
                                            <td
                                                class="text-right"
                                                style="width: 30%;"
                                            >
                                                <span
                                                    >S/.
                                                    {{
                                                        data_venta_users_Global.detalleMetodoPago
                                                    }}</span
                                                >
                                            </td>
                                        </tr>
                                        <tr
                                            v-if="
                                                data_venta_users_Global.metodoPago ==
                                                    'Efectivo'
                                            "
                                        >
                                            <td
                                                class="text-right"
                                                style="width: 70%;"
                                            >
                                                <b>Vuelto: </b>
                                            </td>
                                            <td
                                                class="text-right"
                                                style="width: 30%;"
                                            >
                                                <span
                                                    >S/.
                                                    {{
                                                        (
                                                            parseFloat(
                                                                data_venta_users_Global.detalleMetodoPago,
                                                                10
                                                            ) -
                                                            data_venta_users_Global.total
                                                        ).toFixed(2)
                                                    }}</span
                                                >
                                            </td>
                                        </tr>
                                        <tr
                                            v-if="
                                                data_venta_users_Global.metodoPago !=
                                                    'Efectivo'
                                            "
                                        >
                                            <td
                                                class="text-right"
                                                style="width: 70%;"
                                            >
                                                <b
                                                    >{{
                                                        data_venta_users_Global.metodoPago
                                                    }}:
                                                </b>
                                            </td>
                                            <td
                                                class="text-right"
                                                style="width: 30%;"
                                            >
                                                <span>{{
                                                    data_venta_users_Global.detalleMetodoPago
                                                }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button
                                type="button"
                                class="btn btn-danger btn-block"
                                data-dismiss="modal"
                                @click="anularTicket"
                            >
                                Anular
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            {{ mensaje }}
                        </div>

                        <div class="card-footer">
                            <button
                                type="button"
                                class="btn btn-success btn-block"
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
</template>
<script>
export default {
    data() {
        return {
            ticket: "",
            data_venta_users_Global: "",
            fechaHoraPeru_Global: "",
            data_detalleventa_productos_Global: "",
            caja: [],
            mensaje: ""
        };
    },
    created() {
        axios.get("caja/create").then(res => {
            this.caja = res.data;
        });
    },
    methods: {
        informacionTicket() {
            this.obtenerDatosVenta();
            this.fechaHoraConfiguradaPeru();
            this.obtenerDatosDetalleVenta();
        },
        obtenerDatosVenta() {
            const params = {
                id: this.ticket
            };
            axios
                .post("venta-users", params)
                .then(res => {
                    if (this.caja[0].id === res.data.id_caja) {
                        this.data_venta_users_Global = res.data;
                        $("#informacionTicketModal").modal("show");
                    } else {
                        alert("El ticket no puede anularse.");
                    }
                })
                .catch(error => {
                    alert("El ticket no existe en la base de datos.");
                });
        },
        fechaHoraConfiguradaPeru() {
            axios.get("hora-peru/" + this.ticket).then(res => {
                this.fechaHoraPeru_Global = res.data;
            });
        },
        obtenerDatosDetalleVenta() {
            const params = {
                id: this.ticket
            };
            axios.post("detalleventa-productos", params).then(res => {
                this.data_detalleventa_productos_Global = res.data;
            });
        },
        anularTicket() {
            const params = {
                id: this.ticket
            };
            axios.post("anular-ticket-venta", params).then(res => {
                console.log(res.data)
                
                this.mensaje = res.data;
                $("#mensajeModal").modal("show");
                this.ticket = "";
                
            });
        }
    }
};
</script>
