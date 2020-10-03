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
            <br /><br />
            <span><b>CIERRE DE CAJA</b></span>
            <br />
            <span>N° de Caja: {{ idCaja_Global }}</span>
        </div>
        <table style="width:250px" class="mt-3">
            <tr>
                <td class="w-50 text-left">
                    <b>Fecha Inicio: </b>
                </td>
                <td class="w-50 text-right">
                    <b>Hora Inicio: </b>
                </td>
            </tr>
            <tr>
                <td class="w-50 text-left">
                    {{ fechasCaja_Global.fecha_inicio }}
                </td>
                <td class="w-50 text-right">
                    {{ fechasCaja_Global.hora_inicio }}
                </td>
            </tr>
            <tr>
                <td class="w-50 text-left">
                    <b>Fecha Cierre: </b>
                </td>
                <td class="w-50 text-right">
                    <b>Hora Cierre: </b>
                </td>
            </tr>
            <tr>
                <td class="w-50 text-left">
                    {{ fechasCaja_Global.fecha_cierre }}
                </td>
                <td class="w-50 text-right">
                    {{ fechasCaja_Global.hora_cierre }}
                </td>
            </tr>
        </table>

        <hr class="my-3" style="border-top: 3px dashed black;" />
        <table style="width:250px">
            <thead>
                <tr>
                    <th class="text-center" style="width: 10%">N°</th>
                    <th class="text-center" style="width: 15%">Ticket</th>
                    <th class="px-1 text-center" style="width: 15%">Total</th>
                    <th class="px-1 text-center" style="width: 30%">
                        Metodo Pago
                    </th>
                    <th class="px-1 text-center" style="width: 30%">Detalle</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(item, index) in ventasCerrarCaja_Global"
                    :key="index"
                >
                    <td class="text-center align-top">
                        {{ index + 1 }}
                    </td>
                    <td class="text-center align-top">
                        {{ item.id }}
                    </td>
                    <td class="text-center align-top">
                        {{ item.total.toFixed(2) }}
                    </td>
                    <td class="text-center align-top">
                        {{ item.metodoPago }}
                    </td>
                    <td class="text-center align-top">
                        {{ item.detalleMetodoPago }}
                    </td>
                </tr>
            </tbody>
        </table>
        <hr class="my-3" style="border-top: 3px dashed black;" />
        <table style="width:250px">
            <tfoot>
                <tr>
                    <td style="width: 25%">
                        <b>Efectivo ({{ datosDetalleCaja_Global.CantidadVentaEfectivo }}): </b
                        >{{ datosDetalleCaja_Global.SumaVentaEfectivo.toFixed(2) }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        <b
                            >Tarj. Cred/Deb ({{
                                datosDetalleCaja_Global.CantidadVentaTarjeta
                            }}): </b
                        >{{ datosDetalleCaja_Global.SumaVentaTarjeta.toFixed(2) }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        <b
                            >Billetera Movil ({{
                                datosDetalleCaja_Global.CantidadVentaBilleteraMovil
                            }}): </b
                        >{{ datosDetalleCaja_Global.SumaVentaBilleteraMovil.toFixed(2) }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        <b>TOTAL:</b> {{ datosDetalleCaja_Global.TotalVentaCaja.toFixed(2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="text-center mt-4 pt-3">
            -
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            idCaja_Global: "",
            ventasCerrarCaja_Global: "",
            fechasCaja_Global: "",
            datosDetalleCaja_Global: '',
        };
    },
    mounted() {
        setTimeout(imprimir, 2000);
        function imprimir() {
            window.print();
        }
    },
    created() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id_caja = urlParams.get("id");
        this.idCaja_Global = urlParams.get("id");

        this.obtenerDatosDetalleCaja(id_caja);

        this.obtenerDatosCaja(id_caja);

        this.obtenerVentasCerrarCaja(id_caja);
    },
    methods: {
        obtenerVentasCerrarCaja(id_caja) {
            const params = {
                id: id_caja
            };
            axios.post("ver-caja", params).then(res => {
                this.ventasCerrarCaja_Global = res.data;
            });
        },
        obtenerDatosCaja(id_caja) {
            axios.get("caja/" + id_caja).then(res => {
                this.fechasCaja_Global = {
                    fecha_inicio: res.data.fecha_inicio,
                    hora_inicio: res.data.hora_inicio,
                    fecha_cierre: res.data.fecha_cierre,
                    hora_cierre: res.data.hora_cierre
                };
            });
        },
        obtenerDatosDetalleCaja(id_caja){
            const params = {
                id: id_caja
            };
            axios.post("obtener-datos-detalle-caja", params).then(res => {
                this.datosDetalleCaja_Global = res.data;
            });
        }
    }
};
</script>
