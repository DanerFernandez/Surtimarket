<template>
    <div>
        <div class="card">
            <div class="card-header text-center">
                Registro de Ventas
            </div>
            <div class="card-body">
                <div class="scrollable-lg" id="scroll-carrito" v-if="lista_cajas">
                    <table
                        class="table text-center table-hover"
                        v-if="lista_cajas"
                    >
                        <thead>
                            <tr style="background-color: #f5eefe !important">
                                <th class="sticky-table-header" scope="col">
                                    #
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Id Caja
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Fecha de inicio
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Hora de inicio
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Fecha de cierre
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Hora de cierre
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Estado
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Acción
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
                                <td v-if="item.estado === 0">
                                    <p class="font-weight-bolder text-primary">
                                        CERRADO
                                    </p>
                                </td>
                                <td>
                                    <a
                                        class="btn btn-primary btn-sm"
                                        @click="verCaja(item.id)"
                                    >
                                        Ver
                                    </a>
                                    <a
                                        class="btn btn-success btn-sm"
                                        @click="imprimirCaja"
                                    >
                                        Imprimir
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <a
                    class="btn btn-block btn-dark"
                    v-if="lista_ventas"
                    @click="regresarVentaCaja"
                    >Regresar</a
                >
                <div class="scrollable-lg" id="scroll-carrito" v-if="lista_ventas">
                    <table
                        class="table text-center table-hover"
                        v-if="lista_ventas"
                    >
                        <thead>
                            <tr style="background-color: #f5eefe !important">
                                <th class="sticky-table-header" scope="col">
                                    #
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Id Caja
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Id Venta
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Nombre Usuario
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Total
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Metodo de Pago
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Detalle
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Estado
                                </th>
                                <th class="sticky-table-header" scope="col">
                                    Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(item, index) in ventas_caja"
                                :key="index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ item.id_caja }}</td>
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.total.toFixed(2) }}</td>
                                <td>{{ item.metodoPago }}</td>
                                <td>{{ item.detalleMetodoPago }}</td>
                                <td
                                    v-if="item.estado == 1"
                                    class="text-success"
                                >
                                    APROBADO
                                </td>
                                <td v-if="item.estado == 0" class="text-danger">
                                    ANULADO
                                </td>
                                <td>
                                    <a
                                        class="btn btn-success btn-sm"
                                        @click="generarCopiaTicketVenta(item.id)"
                                    >
                                        Imprimir Copia
                                    </a>
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
            cajas_cerradas: [],
            ventas_caja: [],
            usuariosAll: [],
            lista_cajas: true,
            lista_ventas: false
        };
    },
    created() {
        axios.get("caja").then(res => {
            this.cajas_cerradas = res.data;
        });
        axios.get("usuario").then(res => {
            this.usuariosAll = res.data;
        });
    },
    methods: {
        verCaja(id_caja) {
            this.ventas_caja = [];
            this.lista_cajas = false;
            this.lista_ventas = true;
            const params = {
                id: id_caja
            };
            axios.post("ver-caja-ventas-global", params).then(res => {
                this.ventas_caja = res.data;
                console.log(res.data);
            });
        },
        regresarVentaCaja() {
            this.lista_cajas = true;
            this.lista_ventas = false;
        },
        imprimirCaja() {
            console.log("Imprimir Caja");
        },
        generarCopiaTicketVenta(id_venta){
            const idCaja = id_venta;
            window.open(
                "./copia-ticket-venta?id=" + id_venta,
                "_blank",
                "width=800,height=600"
            );
        }
    }
};
</script>
