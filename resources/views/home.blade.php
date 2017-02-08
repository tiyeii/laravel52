@extends ('layouts.admin')
@section ('contenido')


<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <!-- =========================================================== -->

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h2>$ {{ $compras->totales }}</h2>
              

              <p>Compras</p>
            </div>
            <div class="icon">
              <i class="fa fa-th"></i>
            </div>
            <a href="{{ url('compras/ingreso') }}" class="small-box-footer">
              Mas informacion  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h2>$ {{ $ventas->totales }}</h2>
              

              <p>Ventas</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="{{ url('ventas/venta') }}" class="small-box-footer">
              Mas informacion  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>4</h3>

              <p>Usuarios</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('seguridad/usuario') }}" class="small-box-footer">
              Mas informacion <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>100</h3>

              <p>Pedidos</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('ventas/pedido') }}" class="small-box-footer">
              Mas informacion  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- =========================================================== -->
    </div>
</div>
@endsection