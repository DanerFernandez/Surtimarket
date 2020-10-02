<template>
    <div>
        <a class="btn btn-block btn-dark" @click="$emit('respuesta', false)"
            >Regresar</a
        >
        <div class="scrollable-lg" id="scroll-carrito">
            <table class="table text-center table-hover">
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
                    <tr v-for="(item, index) in ventas_caja" :key="index">
                        <th scope="row">
                            {{ index + 1 }}
                        </th>
                        <td>{{ item.id_caja }}</td>
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td>
                            {{ item.total.toFixed(2) }}
                        </td>
                        <td>{{ item.metodoPago }}</td>
                        <td>
                            {{ item.detalleMetodoPago }}
                        </td>
                        <td v-if="item.estado == 1" class="text-success">
                            APROBADO
                        </td>
                        <td v-if="item.estado == 0" class="text-danger">
                            ANULADO
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm">
                                Imprimir Ticket
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: ["id_caja"],
    data() {
        return {
            ventas_caja: ""
        };
    },
    created() {
        this.ventas_caja = [];
        const params = {
            id: this.id_caja
        };
        axios.post("ver-caja-ventas-global", params).then(res => {
            this.ventas_caja = res.data;
        });
    }
};
</script>
