<link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
<style>
    body {font-family: 'Arvo', serif;}
    h1   {color: blue;}
    p    {color: red;}
    .tabla {
        color: #3e4243;
        border-spacing: 0px;

    }
    ul{
        list-style: none;

    }
    li {

        display: inline-block;

    }
    .li-title{

        border: 0.5px solid black;
        text-align: left;
    }
    .table-title{
        border:0.5px solid black;
        text-align: center;

    }
    .titulo-numero{
        color: black;
        font-weight: bold;
        text-align: center;
    }
    .campo-numero{
        color: red;
        font-weight: bold;
        text-align: center;
    }
    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}



</style>

<ul class="col-12">

    <li>

        <li class="col-3">
            <ul class="col-12 titulo-numero">
                NUMERO DE FACTURA:{{$id}}
            </ul>
        </li>
    </li>



</ul>


    <table class=" tabla  col-12">
        <tr class="col-12">
            <th class="col-1 table-title">
                CANTIDAD
            </th    >
            <th class="col-7 table-title">
                DESCRIPCIÓN
            </th>
            <th class="col-2 table-title">
                VALOR UNIDAD
            </th>
            <th class="col-2 table-title">
                VALOR
            </th>

        </tr>

        @foreach ($ventas as $venta)

            <tr class="col-12 ">
                <td class="col-1 li-title">
                    {{$venta->cantidad}}
                </td>
                <td class="col-7 li-title">
                    {{$venta->producto->nombre}}

                </td>
                <td class="col-2`` li-title">
                    {{$venta->producto->precio}}
                </td>
                <td class="col-2 li-title">
                    {{$venta->cantidad*$venta->producto->precio}}
                </td>
            </tr>
        @endforeach
        <tr class="col-12">
            <td class="col-3 "></td>
            <td class="col-3 "></td>
            <td class="col-3 "></td>
            <td class="col-3 li-title">Total: {{$total}}</td>
        </tr>
        <tr>
            <td>

            </td>
        </tr>
        </table>




