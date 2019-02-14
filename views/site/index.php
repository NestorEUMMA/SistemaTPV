
<script>
    $(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            <?php if ($_SESSION['IdIdioma'] == 1){ ?>
                    toastr.success('Centro Medico Familiar Shalom', 'Bienvenido');
              <?php }else
                { ?>
                     toastr.success('Centro Medico Familiar Shalom', 'Welcome');
                <?php } ?>
 });
         
</script>
<?php
/* @var $this yii\web\View */

include '../include/dbconnect.php';
if(!isset($_SESSION))
    {
        session_start();

    }

if (!empty($_SESSION['user']))
  {

          
          $queryfichaconsulta = "SELECT  count(c.FechaConsulta) as 'Listado', (SELECT count(p.Genero) FROM persona p INNER JOIN consulta c on c.IdPersona = p.IdPersona WHERE p.Genero = 'MASCULINO' and c.FechaConsulta = curdate()) as 'Hombre',
            (SELECT count(p.Genero) FROM persona p INNER JOIN consulta c on c.IdPersona = p.IdPersona WHERE p.Genero = 'FEMENINO' and c.FechaConsulta = curdate() ) as 'Mujer'
            FROM
            consulta c
            INNER JOIN persona p on c.IdPersona = p.IdPersona
            WHERE c.FechaConsulta = CURDATE() ";

            $resultadofichaconsulta = $mysqli->query($queryfichaconsulta);
            while ($test = $resultadofichaconsulta->fetch_assoc())
            {
                $listado = $test['Listado'];
                $hombres = $test['Hombre'];
                $mujeres = $test['Mujer'];
            }

            $Hresultado = $hombres * 100;

            $hombresPor = 0;

            if($listado != 0)
              $hombresPor = $Hresultado / $listado;


            $Mresultado = 0;
            $Mresultado = $mujeres * 100;

            $mujeresPor = 0;
            if($listado != 0)
              $mujeresPor = $Mresultado / $listado;


            // QUERY PARA CALCULAR EDAD
           $queryfichaconsulta2 = "SELECT
                  count(CASE
                    WHEN TIMESTAMPDIFF(YEAR,p.FechaNacimiento,CURDATE()) = 0 THEN 'nino'
                    WHEN TIMESTAMPDIFF(YEAR,p.FechaNacimiento,CURDATE()) <= 18 THEN 'nino'
                  END) As 'Nino',
                  count(CASE
                    WHEN TIMESTAMPDIFF(YEAR,p.FechaNacimiento,CURDATE()) > 18 THEN 'adulto'
                  END) As 'Adulto'
                FROM consulta c
                INNER JOIN persona p on c.IdPersona = p.IdPersona
                WHERE c.FechaConsulta = CURDATE()";

            $resultadofichaconsulta2 = $mysqli->query($queryfichaconsulta2);
            while ($test = $resultadofichaconsulta2->fetch_assoc())
            {
                $nino = $test['Nino'];
                $adulto = $test['Adulto'];
            }



           $queryfichaconsulta3 = "SELECT count(c.Activo) as Activo
              FROM
              consulta c
              WHERE c.FechaConsulta = CURDATE() and Activo = 1";

            $resultadofichaconsulta3 = $mysqli->query($queryfichaconsulta3);
            while ($test = $resultadofichaconsulta3->fetch_assoc())
            {
                $activo = $test['Activo'];
            }


$this->title = 'Sistema TPV';
?>

<div class="wrapper wrapper-content">
  <h1>
    Centro Medico Familiar Shalom |
    <small id="encabezado1">  </small>
  </h1>
    <div class="row animated fadeInDown">
        <div class="col-lg-6">
        <div class="row animated fadeInDown">
        <div class="col-lg-6">
          <div class="widget style1 blue-bg">
                  <div class="row">
                      <div class="col-xs-4 text-center">
                          <i class="fa fa-hospital-o fa-5x"></i>
                      </div>
                      <div class="col-xs-8 text-right">
                          <span id='widget1'></span>
                          <h2 class="font-bold"><?php echo $listado; ?></h2>
                      </div>
                  </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="widget style1 blue-bg">
                  <div class="row">
                      <div class="col-xs-4 text-center">
                          <i class="fa fa-user fa-5x"></i>
                      </div>
                      <div class="col-xs-8 text-right">
                          <span id='widget2'></span>
                          <h2 class="font-bold"><?php echo $adulto; ?></h2>
                      </div>
                  </div>
          </div>
        </div>
        </div>
        <div class="row animated fadeInDown">
        <div class="col-lg-6">
          <div class="widget style1 red-bg">
                  <div class="row">
                      <div class="col-xs-4 text-center">
                          <i class="fa fa-smile-o fa-5x"></i>
                      </div>
                      <div class="col-xs-8 text-right">
                          <span id='widget3'></span>
                          <h2 class="font-bold"><?php echo $nino; ?></h2>
                      </div>
                  </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="widget style1 red-bg">
                  <div class="row">
                      <div class="col-xs-4 text-center">
                          <i class="fa fa-stethoscope fa-5x"></i>
                      </div>
                      <div class="col-xs-8 text-right">
                          <span id='widget4'></span>
                          <h2 class="font-bold"><?php echo $activo; ?></h2>
                      </div>
                  </div>
          </div>
        </div>
        </div>
        <div class="row animated fadeInDown">
        <div class="col-lg-6">
          <div class="widget style1 yellow-bg">
                  <div class="row">
                      <div class="col-xs-4 text-center">
                          <i class="fa fa-female fa-5x"></i>
                      </div>
                      <div class="col-xs-8 text-right">
                          <span id='widget5'></span>
                          <h2 class="font-bold"> <?php echo $mujeres; ?></h2>
                      </div>
                  </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="widget style1 yellow-bg">
                  <div class="row">
                      <div class="col-xs-4 text-center">
                          <i class="fa fa-male fa-5x"></i>
                      </div>
                      <div class="col-xs-8 text-right">
                          <span id='widget6'></span>
                          <h2 class="font-bold"><?php echo $hombres ?></h2>
                      </div>
                  </div>
          </div>
        </div>
        </div>
        <div class="row animated fadeInDown">
        <div class="col-lg-6">
          <div class="widget style1 navy-bg">
                  <div class="row">
                      <div class="col-xs-4 text-center">
                          <i class="fa fa-area-chart fa-5x"></i>
                      </div>
                      <div class="col-xs-8 text-right">
                          <span id='widget7'></span>
                          <h2 class="font-bold"><?php echo $mujeresPor;?>%</h2>
                      </div>
                  </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="widget style1 navy-bg">
                  <div class="row">
                      <div class="col-xs-4 text-center">
                          <i class="fa fa-line-chart fa-5x"></i>
                      </div>
                      <div class="col-xs-8 text-right">
                          <span id='widget8'></span>
                          <h2 class="font-bold"><?php echo $hombresPor;?>%</h2>
                      </div>
                  </div>
          </div>
        </div>
        </div>
        </div>
      <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 id='calendarname'></h5>
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div> 

<div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Area Chart Example <small>With custom colors.</small></h5>
                    </div>
                    <div class="ibox-content" style="position: relative">
                        <div id="morris-area-chart"></div>
                    </div>
                </div>
            </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {

      Morris.Bar({
        element: 'morris-area-chart',
        data: [{ period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647 },
            { period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441 },
            { period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501 },
            { period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689 },
            { period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293 },
            { period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881 },
            { period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588 },
            { period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175 },
            { period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028 },
            { period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791 } ],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true,
        lineColors: ['#87d6c6', '#54cdb4','#1ab394'],
        lineWidth:2,
        pointSize:1,
    });

   <?php if ($_SESSION['IdIdioma'] == 1){ ?>
       $("#encabezado1").text('Adminstración de Pacientes y Laboratorio');
       $("#widget1").text('Paciente Atendido');
       $("#widget2").text('Adultos');
       $("#widget3").text('Niños');
       $("#widget4").text('En Proceso');
       $("#widget5").text('Mujer Atendida');
       $("#widget6").text('Hombre Atendido');
       $("#widget7").text('Mujer Atendida');
       $("#widget8").text('Hombre Atendido');
       $("#calendarname").text('Calendario');
       $("#").text('Adminstración de Pacientes y Laboratorio');
       $("#").text('Adminstración de Pacientes y Laboratorio');
       $("#").text('Adminstración de Pacientes y Laboratorio');
       $("#").text('Adminstración de Pacientes y Laboratorio');
       $("#").text('Adminstración de Pacientes y Laboratorio');
<?php }else
  { ?>
       $("#encabezado1").text('Patient and Laboratory Management');
       $("#widget1").text('Patients Served');
       $("#widget2").text('Adults');
       $("#widget3").text('Children');
       $("#widget4").text('In Process');
       $("#widget5").text('Women Served');
       $("#widget6").text('Men Served');
       $("#widget7").text('Women Served');
       $("#widget8").text('Men Served');
       $("#calendarname").text('Calendar');
       $("#").text('Adminstración de Pacientes y Laboratorio');
       $("#").text('Adminstración de Pacientes y Laboratorio');
       $("#").text('Adminstración de Pacientes y Laboratorio');
       $("#").text('Adminstración de Pacientes y Laboratorio');
       $("#").text('Adminstración de Pacientes y Laboratorio');
  <?php } ?>
 });

  var calendar = $('#calendar').fullCalendar({
   editable:true,
   header:{
    left:'prev,next today',
    center:'title',
    right:'month,agendaWeek,agendaDay'
   },
   events: 'load.php',
   selectable:true,
   selectHelper:true,
   select: function(start, end, allDay)
   {
    var title = prompt("Ingrese Titulo de Evento");
    if(title)
    {
     var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
     $.ajax({
      url:"insert.php",
      type:"POST",
      data:{title:title, start:start, end:end},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       bootbox.alert({
            message: "Agregado Exitosamente!",
            size: 'small',
            callback: function () {
                console.log('This was logged in the callback!');
            }
        })
      }
     })
    }

   },
   editable:true,
   eventResize:function(event)
   {
    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    var title = event.title;
    var id = event.id;
    $.ajax({
     url:"update.php",
     type:"POST",
     data:{title:title, start:start, end:end, id:id},
     success:function(){
      calendar.fullCalendar('refetchEvents');
      alert('Evento Actualizado');
     }
    })
   },

   eventClick:function(event)
   {

    bootbox.confirm({
    title: "Eliminar Evento",
    message: "Deseas eliminar este evento?",
    buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancelar'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirmar'
        }
    },
            callback: function (result) {
               var id = event.id;
               $.ajax({
                url:"delete.php",
                type:"POST",
                data:{id:id},
                success:function()
                {
                 calendar.fullCalendar('refetchEvents');
                 // bootbox.alert("Evento Eliminado");
                 bootbox.alert({
                      message: "Eliminado Exitosamente!",
                      size: 'small',
                      callback: function () {
                          console.log('This was logged in the callback!');
                      }
                  })
                }
               })
                console.log('This was logged in the callback: ' + result);
            }
        });
   },

  });

 
 </script>

 <?php
 }
 else{
   echo "
   <script>
     alert('No ha iniciado sesion');
     document.location='../index.php';
   </script>
   ";
 }
 ?>
