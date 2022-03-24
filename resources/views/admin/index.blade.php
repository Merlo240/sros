@extends('adminlte::page')

@section('title', 'Inicio')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<style>
#mapid { min-height: 500px; }
</style>
@stop

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">

            <!--Accordion wrapper-->
<div class="accordion md-accordion accordion-blocks" id="accordionEx78" role="tablist"
aria-multiselectable="true">

<!-- Accordion card -->
<div class="card">

  <!-- Card header -->
  <div class="card-header" role="tab" id="headingUnfiled">
    <!-- Heading -->
    <a data-toggle="collapse" data-parent="#accordionEx78" href="#collapseUnfiled" aria-expanded="true"
      aria-controls="collapseUnfiled">
      <h5 class="mt-1 mb-0">
        <span>Bacheo</span>
        <i class="fas fa-angle-down rotate-icon"></i>
      </h5>
    </a>

  </div>

  <!-- Card body -->
  <div id="collapseUnfiled" class="collapse" role="tabpanel" aria-labelledby="headingUnfiled"
    data-parent="#accordionEx78">
    <div class="card-body">
<div class="row">
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-green"><i class="fas fa-clipboard-check"></i></span>
        <div class="info-box-content">
          <span class=" h3 info-box-text">Obras Habilitadas</span>
          <span class="info-box-number">{{$obras}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-purple"><i class="fas fa-chart-line"></i></span>
        <div class="info-box-content">
          <span class="h3 info-box-text">Obras Activas</span>
          <span class="info-box-number">{{$obras_activas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-yellow"><i class="fas fa-ban"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Paralizadas</span>
          <span class="info-box-number">{{$obras_Interrumpidas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-orange"><i class="fas fa-hard-hat"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras En total</span>
          <span class="info-box-number">{{$obras_total}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-blue"><i class="fas fa-house-user"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Relevadas</span>
          <span class="info-box-number">{{$Barrios}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
</div>
  </div>
</div>
</div>


<!-- Accordion card -->
<div class="card">

  <!-- Card header -->
  <div class="card-header" role="tab" id="heading79">
    <!-- Heading -->
    <a data-toggle="collapse" data-parent="#accordionEx78" href="#collapse79" aria-expanded="true"
      aria-controls="collapse79">
      <h5 class="mt-1 mb-0">
        <span>Cloaca Social</span>
        <i class="fas fa-angle-down rotate-icon"></i>
      </h5>
    </a>

  </div>

  <!-- Card body -->
  <div id="collapse79" class="collapse show" role="tabpanel" aria-labelledby="heading79"
    data-parent="#accordionEx78">
    <div class="card-body">
<div class="row">
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-green"><i class="fas fa-clipboard-check"></i></span>
        <div class="info-box-content">
          <span class=" h3 info-box-text">Obras Habilitadas</span>
          <span class="info-box-number">{{$obras}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-purple"><i class="fas fa-chart-line"></i></span>
        <div class="info-box-content">
          <span class="h3 info-box-text">Obras Activas</span>
          <span class="info-box-number">{{$obras_activas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-yellow"><i class="fas fa-ban"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Paralizadas</span>
          <span class="info-box-number">{{$obras_Interrumpidas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-orange"><i class="fas fa-hard-hat"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras En total</span>
          <span class="info-box-number">{{$obras_total}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-blue"><i class="fas fa-house-user"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Relevadas</span>
          <span class="info-box-number">{{$Barrios}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
</div>
      
    </div>
  </div>
</div>
<!-- Accordion card -->

<!-- Accordion card -->
<div class="card">

  <!-- Card header -->
  <div class="card-header" role="tab" id="heading80">

    <!-- Heading -->
    <a data-toggle="collapse" data-parent="#accordionEx78" href="#collapse80" aria-expanded="true"
      aria-controls="collapse80">
      <h5 class="mt-1 mb-0">
        <span>Cordon Cuneta</span>
        <i class="fas fa-angle-down rotate-icon"></i>
      </h5>
    </a>
  </div>

  <!-- Card body -->
  <div id="collapse80" class="collapse" role="tabpanel" aria-labelledby="heading80"
    data-parent="#accordionEx78">
    <div class="card-body">
<div class="row">
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-green"><i class="fas fa-clipboard-check"></i></span>
        <div class="info-box-content">
          <span class=" h3 info-box-text">Obras Habilitadas</span>
          <span class="info-box-number">{{$obras}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-purple"><i class="fas fa-chart-line"></i></span>
        <div class="info-box-content">
          <span class="h3 info-box-text">Obras Activas</span>
          <span class="info-box-number">{{$obras_activas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-yellow"><i class="fas fa-ban"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Paralizadas</span>
          <span class="info-box-number">{{$obras_Interrumpidas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-orange"><i class="fas fa-hard-hat"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras En total</span>
          <span class="info-box-number">{{$obras_total}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-blue"><i class="fas fa-house-user"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Relevadas</span>
          <span class="info-box-number">{{$Barrios}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
</div>

    </div>
  </div>
</div>


</div>
<div class="card">
  <div class="card-body">
    <div class="container">
      @include('admin.bacheos.map')
    </div>
  </div>
</div>

@stop


@section('js')

@stop

{{-- <div class="row">
              
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-black"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class=" h3 info-box-text">Usuarios</span>
          <span class="info-box-number">{{$users}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-green"><i class="fas fa-clipboard-check"></i></span>
        <div class="info-box-content">
          <span class=" h3 info-box-text">Obras Habilitadas</span>
          <span class="info-box-number">{{$obras}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-purple"><i class="fas fa-chart-line"></i></span>
        <div class="info-box-content">
          <span class="h3 info-box-text">Obras Activas</span>
          <span class="info-box-number">{{$obras_activas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-yellow"><i class="fas fa-ban"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Paralizadas</span>
          <span class="info-box-number">{{$obras_Interrumpidas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-orange"><i class="fas fa-hard-hat"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras En total</span>
          <span class="info-box-number">{{$obras_total}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-blue"><i class="fas fa-house-user"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Relevadas</span>
          <span class="info-box-number">{{$Barrios}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
</div> --}}




{{-- <div class="card">

  <!-- Card header -->
  <div class="card-header" role="tab" id="heading">
    <!--Options-->
    <div class="dropdown float-left">
      <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><i class="fas fa-pencil-alt"></i>
      </button>
      <div class="dropdown-menu dropdown-info">
        <a class="dropdown-item" href="#">Add new condition</a>
        <a class="dropdown-item" href="#">Rename folder</a>
        <a class="dropdown-item" href="#">Delete folder</a>
      </div>
    </div>

    <!-- Heading -->
    <a data-toggle="collapse" data-parent="#accordionEx78" href="#collapse81" aria-expanded="true"
      aria-controls="collapse81">
      <h5 class="mt-1 mb-0">
        <span>Folder 3</span>
        <i class="fas fa-angle-down rotate-icon"></i>
      </h5>
    </a>
  </div>

  <!-- Card body -->
  <div id="collapse81" class="collapse" role="tabpanel" aria-labelledby="heading"
    data-parent="#accordionEx78">
    <div class="card-body">
<div class="row">
              
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-black"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class=" h3 info-box-text">Usuarios</span>
          <span class="info-box-number">{{$users}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-green"><i class="fas fa-clipboard-check"></i></span>
        <div class="info-box-content">
          <span class=" h3 info-box-text">Obras Habilitadas</span>
          <span class="info-box-number">{{$obras}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-purple"><i class="fas fa-chart-line"></i></span>
        <div class="info-box-content">
          <span class="h3 info-box-text">Obras Activas</span>
          <span class="info-box-number">{{$obras_activas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-yellow"><i class="fas fa-ban"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Paralizadas</span>
          <span class="info-box-number">{{$obras_Interrumpidas}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-orange"><i class="fas fa-hard-hat"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras En total</span>
          <span class="info-box-number">{{$obras_total}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
  <div class="col-sm">
    <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-blue"><i class="fas fa-house-user"></i></span>
        <div class="info-box-content">
          <span class=" h3  info-box-text">Obras Relevadas</span>
          <span class="info-box-number">{{$Barrios}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
  </div>
</div>
    </div>
  </div>
</div> --}}