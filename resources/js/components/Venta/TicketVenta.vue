<template>
    <div style="width: 250px" class="mt-3">
        <div class="text-center">
            <b style="font-size: 20px">SURTIMAR'KET</b>
            <br />
            <b>Todo lo que buscas en un solo lugar</b>
            <br />
            <span>Cc.pp. Juan Velasco Alvarado B-4</span>
            <br />
            <span>Ica - Ica - Santiago</span>
            <br />
            <span>R.U.C : !!99999999999</span>
            <br />
            <span>N° de Ticket: {{ idVenta_Global }}</span>
            <br />
            <span>N° de Caja: {{ data_venta_users_Global.id_caja }}</span>
        </div>
        <div style="width: 250px" class="mt-3">
            <b>Cajero(a): </b><br/>
            <span>{{ data_venta_users_Global.name }}</span>
        </div>
        <table style="width:250px">
            <tr>
                <td class="w-50 text-left">
                    <b>Fecha: </b>
                </td>
                <td class="w-50 text-right">
                    <b>Hora: </b>
                </td>
            </tr>
            <tr>
                <td class="w-50 text-left">
                    {{ fechaHoraPeru_Global[0] }}
                </td>
                <td class="w-50 text-right">
                    {{ fechaHoraPeru_Global[1] }}
                </td>
            </tr>
        </table>

        <hr class="my-3" style="border-top: 3px dashed black;" />
        <table style="width: 250px">
            <thead>
                <tr>
                    <th class="text-left" style="width: 5%">N°</th>
                    <th class="text-left" style="width: 45%">Producto</th>
                    <th class="text-center" style="width: 20%">Precio</th>
                    <th class="text-center" style="width: 10%">Cant.</th>
                    <th class="text-center" style="width: 20%">Importe</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(item, index) in data_detalleventa_productos_Global"
                    :key="index"
                >
                    <td class="text-left align-top">{{ index + 1 }}</td>
                    <td>{{ item.nombre }}</td>
                    <td class="text-center align-top">
                        {{ (item.importe / item.cantidad).toFixed(2) }}
                    </td>
                    <td class="text-center align-top">
                        {{ item.cantidad }}
                    </td>
                    <td class="text-center align-top">
                        {{ item.importe.toFixed(2) }}
                    </td>
                </tr>
            </tbody>
        </table>

        <hr class="my-3" style="border-top: 3px dashed black;" />
        <table style="width: 250px">
            <tr>
                <td class="text-right" style="width: 60%;">
                    <b>Total: </b>
                </td>
                <td class="text-center" style="width: 40%;">
                    {{ parseFloat(data_venta_users_Global.total).toFixed(2) }}
                </td>
            </tr>
            <tr v-if="data_venta_users_Global.metodoPago == 'Efectivo'">
                <td class="text-right" style="width: 60%;">
                    <b>{{ data_venta_users_Global.metodoPago }}: </b>
                </td>
                <td class="text-center" style="width: 40%;">
                    <span>
                        {{
                            parseFloat(
                                data_venta_users_Global.detalleMetodoPago
                            ).toFixed(2)
                        }}</span
                    >
                </td>
            </tr>
            <tr v-if="data_venta_users_Global.metodoPago == 'Efectivo'">
                <td class="text-right" style="width: 60%;">
                    <b>Vuelto: </b>
                </td>
                <td class="text-center" style="width: 40%;">
                    <span>
                        {{
                            (
                                parseFloat(
                                    data_venta_users_Global.detalleMetodoPago,
                                    10
                                ) - data_venta_users_Global.total
                            ).toFixed(2)
                        }}</span
                    >
                </td>
            </tr>
            <tr v-if="data_venta_users_Global.metodoPago != 'Efectivo'">
                <td class="text-right" style="width: 60%;">
                    <b>{{ data_venta_users_Global.metodoPago }}: </b>
                </td>
                <td class="text-center" style="width: 40%;">
                    <span>{{ data_venta_users_Global.detalleMetodoPago }}</span>
                </td>
            </tr>
        </table>

        <hr class="my-3" style="border-top: 3px dashed black;" />
        <div>
            <div class="text-center mb-4">
                <b>¡¡GRACIAS POR SU COMPRA!!</b>
                <br />
                <b style="font-size: 12px"
                    >NO SE ACEPTAN CAMBIOS, NI DEVOLUCIONES.</b
                >
            </div>
        </div>
        <div class="text-center pt-3">
            -
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            idVenta_Global: "",
            data_venta_users_Global: "",
            data_detalleventa_productos_Global: "",
            fechaHoraPeru_Global: ""
        };
    },
    created() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id_venta = urlParams.get("id");
        this.idVenta_Global = urlParams.get("id");

        this.fechaHoraConfiguradaPeru(id_venta);
        this.obtenerDatosVenta(id_venta);
        this.obtenerDatosDetalleVenta(id_venta);
    },
    mounted() {
        setTimeout(imprimir, 1000);
        function imprimir() {
            window.print();
        }
    },
    methods: {
        obtenerDatosVenta(id_venta) {
            const params = {
                id: id_venta
            };
            axios.post("venta-users", params).then(res => {
                this.data_venta_users_Global = res.data;
            });
        },
        obtenerDatosDetalleVenta(id_venta) {
            const params = {
                id: id_venta
            };
            axios.post("detalleventa-productos", params).then(res => {
                this.data_detalleventa_productos_Global = res.data;
            });
        },
        fechaHoraConfiguradaPeru(id_venta) {
            axios.get("hora-peru/" + id_venta).then(res => {
                this.fechaHoraPeru_Global = res.data;
            });
        }
    }
};
</script>
