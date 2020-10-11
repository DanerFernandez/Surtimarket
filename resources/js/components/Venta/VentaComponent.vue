<template>
    <div>
        <div class="card">
            <div class="card-header text-center">Venta</div>
            <div class="card-body">
                <!-- CONDICIONAL-SI: NO HAY CAJA ABIERTA TE PEDIRA ABIR UNA -->
                <div v-if="caja.length === 0" class="text-center">
                    <p>No hay caja abierta.</p>
                </div>
                <!-- CONDICIONAL-NO: ENCUENTRA 1 CAJA ABIERTA Y TE PERMITIRA HACER VENTAS -->
                <div v-else>
                    <div class="row">
                        <!-- CONDICIONAL-SI: VALOR INICIAL DE CONTINUAR ES 0 SI SE MANTIENE LO MUESTRA -->
                        <div class="col-md-3" v-if="continuar === 0">
                            <!-- SWITCH PARA BUSCAR PRODUCTO POR CODIGO O POR NOMBRE -->
                            <div class="custom-control custom-switch my-3">
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
                            <!-- FORMULARIO DE BUSQUEDA POR CODIGO -->
                            <form
                                @submit.prevent="
                                    busquedaProducto(codigoProducto_Global)
                                "
                                v-if="opcionBusqueda"
                            >
                                <input
                                    id="codigoProducto"
                                    type="text"
                                    class="form-control my-3"
                                    placeholder="Codigo del Producto"
                                    v-model="codigoProducto_Global"
                                    required
                                    autofocus
                                    maxlength="100"
                                    onclick="this.select();"
                                    v-on:keyup.right="funcionContinuar"
                                />
                                <button
                                    class="btn btn-purple btn-block"
                                    type="submit"
                                >
                                    Buscar por codigo
                                </button>
                            </form>
                            <div v-else>
                                <form
                                    @submit.prevent="buscarCodigoProductoNombre"
                                >
                                    <input
                                        id="nombreProducto"
                                        type="text"
                                        class="form-control my-3"
                                        placeholder="Nombre del Producto"
                                        v-model="nombreProducto"
                                        required
                                        autofocus
                                        maxlength="50"
                                        onclick="this.select();"
                                    />
                                    <button
                                        class="btn btn-dark btn-block"
                                        type="submit"
                                    >
                                        Buscar por nombre
                                    </button>
                                </form>
                                <div
                                    class="my-4 scrollable-sm"
                                    v-if="tablaBusquedaNombre"
                                    id="scroll-carrito"
                                >
                                    <table
                                        class="table text-center table-hover"
                                    >
                                        <thead>
                                            <tr
                                                style="background-color: #f5eefe !important;"
                                            >
                                                <th class="sticky-table-header">
                                                    #
                                                </th>
                                                <th class="sticky-table-header">
                                                    Nombre
                                                </th>
                                                <th class="sticky-table-header">
                                                    Acción
                                                </th>
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
                                                            busquedaProducto(
                                                                item.codigo
                                                            )
                                                        "
                                                        >Agregar</a
                                                    >
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- TABLA DE CARRITO DE COMPRAS -->
                        <div class="col-md-9">
                            <!--<p class="font-weight-bolder">CARRITO DE COMPRA:</p>-->
                            <div id="scroll-carrito" class="scrollable">
                                <table class="table text-center table-hover">
                                    <!-- CABECERA -->
                                    <thead>
                                        <tr
                                            style="background-color: #f5eefe !important;"
                                        >
                                            <th
                                                class="sticky-table-header"
                                                scope="col"
                                            >
                                                #
                                            </th>
                                            <th
                                                class="sticky-table-header"
                                                scope="col"
                                            >
                                                Nombre
                                            </th>
                                            <th
                                                class="sticky-table-header"
                                                scope="col"
                                                v-if="continuar === 0"
                                            >
                                                Descripción
                                            </th>
                                            <th
                                                class="sticky-table-header"
                                                scope="col"
                                            >
                                                Precio
                                            </th>
                                            <th
                                                class="sticky-table-header"
                                                scope="col"
                                            >
                                                Cantidad
                                            </th>
                                            <th
                                                class="sticky-table-header"
                                                scope="col"
                                            >
                                                Importe
                                            </th>
                                            <th
                                                class="sticky-table-header"
                                                scope="col"
                                                v-if="continuar === 0"
                                            >
                                                Accion
                                            </th>
                                        </tr>
                                    </thead>

                                    <!-- FIN CABECERA -->
                                    <!-- CUERPO DE TABLA -->
                                    <tbody>
                                        <!-- BUCLE QUE RECORRE EL ARRAY carrito -->
                                        <tr
                                            v-for="(item, index) in carrito"
                                            :key="index"
                                        >
                                            <!-- INDICE -->
                                            <th style="width: 5%;" scope="row">
                                                {{ index + 1 }}
                                            </th>
                                            <!-- NOMBRE -->
                                            <td style="width: 20%;">
                                                {{ item.nombre }}
                                            </td>
                                            <!-- SI CONTINUAR ES 0 SE NUESTRA LA DESCRIPCION -->
                                            <td
                                                style="width: 30%;"
                                                v-if="continuar === 0"
                                            >
                                                {{ item.descripcion }}
                                            </td>
                                            <!-- PRECIO -->
                                            <td style="width: 10%;">
                                                S/. {{ item.precio }}
                                            </td>
                                            <!-- CANTIDAD -->
                                            <td style="width: 15%;">
                                                <!-- DISMINUIR CANTIDAD -->
                                                <a
                                                    v-if="continuar === 0"
                                                    id="disminuirCantidad"
                                                    class="btn btn-danger d-inline btn-sm font-weight-bolder"
                                                    @click="item.cantidad--"
                                                    title="Disminuir"
                                                    >-</a
                                                >
                                                <!-- FIN DISMINUIR CANTIDAD -->
                                                <!-- CANTIDAD -->
                                                <!-- SI CONTINUAR ES 0 MUESTRA EL INPUT -->
                                                <input
                                                    v-if="continuar === 0"
                                                    type="number"
                                                    class="form-control d-inline form-control-sm"
                                                    min="1"
                                                    style="width: 55px;"
                                                    v-model.number="
                                                        item.cantidad
                                                    "
                                                    onclick="this.select();"
                                                />
                                                <!-- SI CONTINUAR ES NO ES 0 OSEA 1 MUESTRA EL PARRAFO CON CANTIDAD -->
                                                <p v-else class="d-inline">
                                                    {{ item.cantidad }}
                                                </p>
                                                <!-- FIN CANTIDAD -->
                                                <!-- AUMENTAR CANTIDAD -->
                                                <a
                                                    v-if="continuar === 0"
                                                    id="aumentarCantidad"
                                                    class="btn btn-primary d-inline btn-sm font-weight-bolder"
                                                    @click="item.cantidad++"
                                                    title="Aumentar"
                                                    >+</a
                                                >
                                                <!-- FIN AUMENTAR CANTIDAD -->
                                            </td>
                                            <!-- FIN CANTIDAD -->
                                            <!-- IMPORTE -->
                                            <td style="width: 10%;">
                                                S/.
                                                {{
                                                    (item.importe = (
                                                        item.precio *
                                                        item.cantidad
                                                    ).toFixed(2))
                                                }}
                                            </td>
                                            <!-- CONDICIONAL SI : CONTINUAR ES 0 MUESTRA EL BOTON BORRAR; 0 significa que no lo han pulsado-->
                                            <td
                                                style="width: 10%;"
                                                v-if="continuar === 0"
                                            >
                                                <a
                                                    class="btn btn-danger btn-sm"
                                                    @click="
                                                        borrarProductoCarrito(
                                                            index
                                                        )
                                                    "
                                                    title="Borrar"
                                                    >Borrar</a
                                                >
                                            </td>
                                            <!-- FIN CONDICIONAL -->
                                        </tr>
                                        <!-- FIN DEL BUCLE -->
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-3" />
                            <div v-if="totalVenta > 0">
                                <div
                                    class="row"
                                    v-if="totalVenta > 0 && continuar == 0"
                                    style="width: 100%; margin: 0px; padding-right: 6px"
                                >
                                    <table
                                        class="table table-light text-center"
                                        style="margin: 0px"
                                    >
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="width: 80%;"
                                                    class="text-right pr-3"
                                                >
                                                    <b>TOTAL</b>
                                                </td>
                                                <td style="width: 10%;">
                                                    S/.
                                                    {{ totalVenta.toFixed(2) }}
                                                </td>
                                                <td style="width: 10%;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="row"
                                    v-if="continuar !== 0"
                                    style="width: 100%; margin: 0px; padding-right: 6px"
                                >
                                    <table
                                        class="table table-light text-center"
                                        style="margin: 0px"
                                    >
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="width: 50%;"
                                                    class="text-right pr-3"
                                                >
                                                    <b>TOTAL</b>
                                                </td>
                                                <td style="width: 10%;">
                                                    S/.
                                                    {{ totalVenta.toFixed(2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row" v-if="continuar == 0">
                                    <button
                                        class="btn btn-purple btn-block my-3"
                                        @click="funcionContinuar"
                                    >
                                        Continuar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div v-if="continuar != 0" class="col-md-3 pl-4">
                            <!-- METODO DE PAGO -->
                            <div>
                                <p class="font-weight-bolder">METODO DE PAGO</p>
                                <select
                                    id="inputState"
                                    class="form-control my-3"
                                    v-model="metodoPago"
                                >
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarj. Cred/Deb"
                                        >Tarjeta de Credito / Debito</option
                                    >
                                    <option value="Billetera Movil"
                                        >Billetera Movil</option
                                    >
                                </select>
                            </div>
                            <!-- DINERO RECIBIDO -->
                            <div v-if="metodoPago == 'Efectivo'">
                                <p class="font-weight-bolder">
                                    EFECTIVO
                                </p>
                                <input
                                    id="dineroEfectivo"
                                    type="number"
                                    min="0"
                                    class="form-control my-3"
                                    v-model="detalleMetodoPago_Efectivo"
                                    onclick="this.select();"
                                    v-on:keyup.enter="condicionalMetodoPago"
                                />
                                <!-- VUELTO -->
                                <div v-if="vuelto >= 0">
                                    <p class="font-weight-bolder">VUELTO</p>
                                    <p>S/. {{ vuelto }}</p>
                                </div>
                            </div>
                            <div v-if="metodoPago == 'Tarj. Cred/Deb'">
                                <p class="font-weight-bolder">
                                    TARJETA DE CREDITO / DEBITO
                                </p>
                                <select
                                    id="inputState"
                                    class="form-control my-3"
                                    v-model="detalleMetodoPago_Tarjeta"
                                >
                                    <option value="Visa">Visa</option>
                                    <option value="MasterCard"
                                        >MasterCard</option
                                    >
                                    <option value="American Express"
                                        >American Express</option
                                    >
                                </select>
                            </div>
                            <div v-if="metodoPago == 'Billetera Movil'">
                                <p class="font-weight-bolder">
                                    BILLETERA MOVIL
                                </p>
                                <select
                                    id="inputState"
                                    class="form-control my-3"
                                    v-model="detalleMetodoPago_BilleteraE"
                                >
                                    <option value="Yape">Yape</option>
                                    <option value="Plin">Plin</option>
                                </select>
                            </div>
                            <!-- BOTON REGISTRAR VENTA -->
                            <hr class="my-4" />
                            <div>
                                <button
                                    class="btn btn-success btn-block my-3"
                                    @click="condicionalMetodoPago"
                                >
                                    REGISTRAR VENTA
                                </button>
                                <button
                                    class="btn btn-danger btn-block my-3"
                                    @click="funcionRetroceder"
                                >
                                    Retroceder
                                </button>
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
                                            {{ mensaje }}
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
                    </div>
                </div>
            </div>
        </div>
        <!-- METODOS COMPUTADOS DE VUE -->
        {{ restriccionMinimaCantidadProducto }}
        {{ calcularTotalVenta }}
        {{ calcularVuelto }}
        {{ siExisteIdVentaGlobal }}
        <!-- FIN METODOS COMPUTADOS -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            carrito: [],
            codigoProducto_Global: "",
            caja: [],
            totalVenta: 0,
            metodoPago: "Efectivo",
            detalleMetodoPago_Tarjeta: "Visa",
            detalleMetodoPago_BilleteraE: "Yape",
            vuelto: 0,
            detalleMetodoPago_Efectivo: 0,
            continuar: 0,
            opcionBusqueda: true,
            nombreProducto: "",
            resultadosBusquedaNombre: [],
            tablaBusquedaNombre: false,
            mensaje: "",
            idVentaGlobal: ""
        };
    },
    created() {
        axios.get("caja/create").then(res => {
            this.caja = res.data;
        });
    },
    computed: {
        restriccionMinimaCantidadProducto() {
            for (let index = 0; index < this.carrito.length; index++) {
                if (this.carrito[index].cantidad < 1) {
                    this.carrito[index].cantidad = 1;
                } else if (
                    this.carrito[index].cantidad > this.carrito[index].stock
                ) {
                    this.carrito[index].cantidad = this.carrito[index].stock;
                }
            }
        },
        calcularTotalVenta() {
            this.totalVenta = 0;
            for (let index = 0; index < this.carrito.length; index++) {
                this.totalVenta =
                    +this.carrito[index].importe + this.totalVenta;
            }
            this.totalVenta = parseFloat(this.totalVenta.toFixed(2));
        },
        calcularVuelto() {
            this.vuelto = (
                this.detalleMetodoPago_Efectivo - this.totalVenta.toFixed(2)
            ).toFixed(2);
        },
        siExisteIdVentaGlobal() {
            if (this.idVentaGlobal !== "") {
                this.guardarDetallesVenta(this.idVentaGlobal);
            }
        }
    },
    methods: {
        busquedaProducto(id) {
            for (let index = 0; index < this.carrito.length; index++) {
                if (this.carrito[index].codigo == id) {
                    this.nombreProducto = "";
                    this.tablaBusquedaNombre = false;
                    this.codigoProducto_Global = "";
                    return this.carrito[index].cantidad++;
                }
            }
            axios
                .get(`producto/${id}`)
                .then(res => {
                    if (res.data.stock < 1) {
                        alert("No hay stock del producto");
                    } else {
                        this.carrito.push({
                            codigo: res.data.id,
                            nombre: res.data.nombre,
                            descripcion: res.data.descripcion,
                            stock: res.data.stock,
                            precio: res.data.precio,
                            cantidad: 1,
                            importe: 0
                        });
                        this.codigoProducto_Global = "";
                        this.resultadosBusquedaNombre = [];
                        this.tablaBusquedaNombre = false;

                        setTimeout(scroll_carrito_bottom, 10);
                        function scroll_carrito_bottom() {
                            var messageBody = document.querySelector(
                                "#scroll-carrito"
                            );
                            messageBody.scrollTop =
                                messageBody.scrollHeight -
                                messageBody.clientHeight;
                        }
                    }
                })
                .catch(error => {
                    this.mensaje =
                        "El codigo del producto no existe en la base de datos.";
                    $("#errorBusquedaModal").modal("show");
                });
        },
        asd() {
            var messageBody = document.querySelector("#scroll-carrito");
            messageBody.scrollTop =
                messageBody.scrollHeight - messageBody.clientHeight;
        },
        buscarCodigoProductoNombre() {
            const params = {
                nombre: this.nombreProducto
            };
            axios.post(`busquedaNombreProducto`, params).then(res => {
                if (res.data.length < 1) {
                    this.mensaje =
                        "El nombre ingresado no existe en la base de datos";
                    this.tablaBusquedaNombre = false;
                    $("#errorBusquedaModal").modal("show");
                    this.nombreProducto = "";
                } else {
                    this.tablaBusquedaNombre = true;
                    this.resultadosBusquedaNombre = [];
                    for (let index = 0; index < res.data.length; index++) {
                        this.resultadosBusquedaNombre.push({
                            codigo: res.data[index].id,
                            nombre: res.data[index].nombre
                        });
                    }
                    this.nombreProducto = "";
                }
            });
        },
        borrarProductoCarrito(index) {
            this.carrito.splice(index, 1);
        },
        condicionalMetodoPago() {
            if (this.metodoPago == "Efectivo") {
                if (this.detalleMetodoPago_Efectivo < this.totalVenta) {
                    alert(
                        "El dinero recibido no puede ser menor al total de la venta"
                    );
                } else {
                    this.realizarVenta();
                }
            } else {
                this.realizarVenta();
            }
        },
        realizarVenta() {
            let detmetodoPago = "";
            if (this.metodoPago == "Efectivo") {
                detmetodoPago = this.detalleMetodoPago_Efectivo;
            } else if (this.metodoPago == "Tarj. Cred/Deb") {
                detmetodoPago = this.detalleMetodoPago_Tarjeta;
            } else if (this.metodoPago == "Billetera Movil") {
                detmetodoPago = this.detalleMetodoPago_BilleteraE;
            }

            const nuevaVenta = {
                id_caja: this.caja[0].id,
                total: this.totalVenta,
                metodoPago: this.metodoPago,
                detalleMetodoPago: detmetodoPago,
                estado: "1"
            };
            this.reducirStock();
            setTimeout(focus_buscar, 1000);
            function focus_buscar() {
                $("#codigoProducto").focus();
            }
            axios.post("venta", nuevaVenta).then(res => {
                this.idVentaGlobal = res.data.id;
                this.generarTicket(res.data.id);
                this.opcionBusqueda = true;
            });
        },
        reducirStock() {
            const carrito = {
                carritoCompra: this.carrito
            };
            axios.put("editar-stock-producto", carrito).then(res => {
                console.log(res.data);
            });
        },
        guardarDetallesVenta(id) {
            const nuevoDetalleVenta = {
                id_venta: id,
                carrito: this.carrito
            };
            axios.post("detalle-venta", nuevoDetalleVenta).then(res => {
                console.log(res.data);
            });

            this.continuar = 0;
            this.carrito = [];
            this.metodoPago = "Efectivo";
        },
        generarTicket(id) {
            const idVenta = id;

            window.open(
                "./ticket-venta?id=" + idVenta,
                "_blank",
                "width=800,height=600"
            );
            this.detalleMetodoPago_Efectivo = 0;
            this.metodoPago = "Efectivo";
            this.detalleMetodoPago_Tarjeta = "Visa";
            this.detalleMetodoPago_BilleteraE = "Yape";
        },
        funcionContinuar() {
            if (this.carrito == "") {
                alert("El carrito esta vacio");
            } else {
                this.continuar = 1;
                setTimeout(focus_diner_efectivo, 10);
                function focus_diner_efectivo() {
                    $("#dineroEfectivo").focus();
                    $("#dineroEfectivo").select();
                }
            }
        },
        funcionRetroceder() {
            this.continuar = 0;
            this.opcionBusqueda = true;
            setTimeout(focus_buscar, 10);
            function focus_buscar() {
                $("#codigoProducto").focus();
            }
        },
        activarBuscarNombre() {
            if (this.opcionBusqueda) {
                this.opcionBusqueda = false;
                setTimeout(focus_buscar, 10);
                function focus_buscar() {
                    $("#nombreProducto").focus();
                }
            } else if (!this.opcionBusqueda) {
                this.opcionBusqueda = true;
                setTimeout(focus_buscar, 10);
                function focus_buscar() {
                    $("#codigoProducto").focus();
                }
            }
        }
    }
};
</script>
