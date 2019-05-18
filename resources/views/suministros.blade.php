@extends('layouts.app')


@section('content')
    <div id="app2">
        <div class="col-md-6">
            <table class="table table-bordered dataTable">
                <tr>Lista de suministros</tr>
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio por unidad</th>
                    <th>Precio total</th>
                    <th>Eliminar de las compras</th>
                </tr>
                </thead>
                <tbody>
                <tr role="row" class="odd" v-for="(producto,index) in productos" v-if="producto.vendido>0" >
                    <td>@{{ producto.id }}</td>
                    <td>@{{ producto.nombre }}</td>
                    <td>@{{ producto.vendido }}</td>
                    <td>@{{ producto.precio }}</td>
                    <td>@{{ producto.precio*producto.vendido }}</td>
                    <td>

                        <button class='btn btn-md '  v-on:click="restatotal( producto.vendido   *producto.precio);producto.vendido = 0"  :disabled="producto.vendido<=0">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">Total a pagar: @{{ total }}
                        <button class='btn btn-md ' style='background-color:transparent;' v-on:click="comprar" :disabled="finalizada" >
                            Comprar
                        </button>
                        </button>
                        <button class='btn btn-md ' style='background-color:transparent;' :disabled="!finalizada">
                            <i class="glyphicon glyphicon-shopping-cart" > <a :href="'factura/'+ respuesta">Imprimir factura </a> </i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered dataTable">
                <tr>Lista de productos</tr>
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Cantidad disponible</th>
                    <th>Precio por unidad</th>
                    <th>Agregar a las compras</th>
                </tr>
                </thead>
                <tbody>
                <tr role="row" class="odd" v-for="(producto,index) in productos">
                    <td>@{{ producto.id }}</td>
                    <td>@{{ producto.nombre }}</td>
                    <td>@{{ producto.cantidad }}</td>
                    <td>@{{ producto.precio }}</td>

                    <td>
                        <input :id="index" type="text" v-model="contar[index]" :value="0" style="width: 25%;">
                        <button style="width: 50%;" class='btn btn-primary ' v-on:click="filteredPosts;producto.vendido += contar[index]*1;sumatotal( producto.vendido*producto.precio)"  :disabled="producto.cantidad-contar[index]*1<0||!contar[index]">
                            Agregar
                        </button>
                    </td>



                </tr>
                </tbody>

            </table>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.0/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.0/vue-resource.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vuejs-paginator/2.0.0/vuejs-paginator.js"></script>
    <Script>
        var app = new Vue({
            el: '#app2',
            data: {
                csrf:document.querySelector('meta[name="csrf-token"]').getAttribute('content'),


                productos:[],
                total:0,
                carrito:[],
                respuesta:'',
                contar:[],
                finalizada:false
            },
            computed: {
                filteredPosts () {
                    let posts = this.productos
                    posts = posts.filter((p) => {
                        return p.vendido >0
                        return foundCategory !== -1
                    })
                    this.carrito=posts
                },
            },
            methods:{
                filteredPosts () {
                    let posts = this.productos
                    posts = posts.filter((p) => {
                        return p.vendido >0
                        return foundCategory !== -1
                    })
                    this.carrito=posts
                },
                getproductos(){
                    this.$http.get('getproductos').then(function(response){
                        this.productos = response.body;

                    }, function(){
                        alert('Error!');
                    });
                },
                sumatotal(parcial){
                    this.total=this.total+parcial;
                },
                restatotal(parcial){
                    this.total=this.total-parcial;
                },
                comprar(){
                    this.filteredPosts();
                    this.$http.post('comprarSuministros',{
                        _token:this.csrf,data:this.carrito}
                    ).then(function(response){
                        this.respuesta=response.body;
                        this.finalizada=true;
                        //console.log(response.body);
                    }).catch((error)=>{
                        this.respuesta=error.body;
                        console.log(error);
                        swal({
                            type: 'error',
                            title: 'ERROR..!',
                            html: ''+error,
                            confirmButtonClass : 'btn-success'
                        })
                    });
                }




            },
            mounted() {
                this.getproductos(),
                    this.filteredPosts ()
            }
        })
    </Script>

@endsection