@extends('pedia::layouts.master')

@section('heads')

@stop

@section('pedia-content')
<!-- Main content -->

        <section class="content">
            <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="box">
                      <div class="box-body table-responsive no-padding overflowx-hidden">
                          @if(count($growthProgress))
                              <table class="table table table-hover datatable" role="grid">
                                  <thead>
                                      <tr class="row">
                                          <th>Age (weeks)</th>
                                          <th>Weight(kg)</th>
                                          <th>Height(cm)</th>
                                          <th>Head(cm)</th>
                                          <th>Chest(cm)</th>
                                          <th>Notes</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($growthProgress as $items)
                                          <tr class="row">
                                              <td>{!! $items->age !!}</td>
                                              
                                              <td>{!! $items->child_weight !!}</td>
                                              <td>{!! $items->child_height !!}</td>
                                              <td>{!! $items->head !!}</td>
                                              <td>{!! $items->chest !!}</td>
                                              <td>{!! $items->notes !!}</td>
                                              <td>
                                                  <a href="read/{!! $items->id !!}" class="btn btn-info"> 
                                                      <i class="fa fa-fw fa-eye"></i>
                                                      Show
                                                  </a>
                                                  <a href="edit/{!! $items->id !!}" class="btn bg-olive"> 
                                                      <i class="fa fa-fw fa-edit"></i>
                                                      edit
                                                  </a>
                                                  <a href="delete/{!! $items->id !!}" class="btn btn-danger"> 
                                                      <i class="fa fa-fw fa-trash-o"></i>
                                                      Delete
                                                  </a>
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          @else
                              <h5>There was no Growth Progress found</h5>
                          @endif
                      </div>
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                <!-- interactive chart -->
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>

                            <h3 class="box-title">Head Circumference (cm)</h3>

                        </div>
                        <div class="box-body row">
                            <div id="headCircumferenceData" style="height: 300px; padding: 0px; position: relative;" class="col-xs-10 col-xs-offset-1"></div>
                        </div>
                        <!-- /.box-body-->
                    </div>
                    <!-- /.box -->

                </div>

                <div class="col-xs-6">
                <!-- interactive chart -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>

                            <h3 class="box-title">Child Weight (kg)</h3>

                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body row">
                            <div id="childWeightData" style="height: 300px; padding: 0px; position: relative;" class="col-xs-10 col-xs-offset-1"></div>
                        </div>
                        <!-- /.box-body-->
                    </div>
                    <!-- /.box -->

                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-6">
                <!-- interactive chart -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>

                            <h3 class="box-title">Child Length (cm)</h3>

                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body row">
                            <div id="childLengthData" style="height: 300px; padding: 0px; position: relative;" class="col-xs-10 col-xs-offset-1"></div>
                        </div>
                        <!-- /.box-body-->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-xs-6">
                <!-- interactive chart -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>

                            <h3 class="box-title">Chest Circumference (cm)</h3>

                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body row">
                            <div id="chestCircumferenceData" style="height: 300px; padding: 0px; position: relative;" class="col-xs-10 col-xs-offset-1"></div>
                        </div>
                        <!-- /.box-body-->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
@stop

@section('scripts')

{!! HTML::script('modules/Pedia/Assets/js/flot/jquery.flot.min.js') !!}
{!! HTML::script('modules/Pedia/Assets/js/flot/jquery.flot.resize.min.js') !!}

<script type="text/javascript">

    $.plot("#chestCircumferenceData", <?= json_encode($chestCircumference) ?>, {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3"
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: false,
        color: ["#3c8dbc", "#f56954"]
      },
      yaxis: {
        show: false,
      },
      xaxis: {
        show: false
      }
    });                  

    $.plot("#headCircumferenceData", <?= json_encode($headCircumference) ?>, {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3"
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: false,
        color: ["#3c8dbc", "#f56954"]
      },
      yaxis: {
        show: false,
      },
      xaxis: {
        show: false
      }
    });                  

    $.plot("#childWeightData", <?= json_encode($childWeight) ?>, {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3"
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: false,
        color: ["#3c8dbc", "#f56954"]
      },
      yaxis: {
        show: false,
      },
      xaxis: {
        show: false
      }
    });                  

    $.plot("#childLengthData", <?= json_encode($childLength) ?>, {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3"
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: false,
        color: ["#3c8dbc", "#f56954"]
      },
      yaxis: {
        show: false,
      },
      xaxis: {
        show: false
      }
    });


    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="weight-tooltip"></div>').css({
      position: "absolute",
      display: "none",
      opacity: 0.8
    }).appendTo("body");
    $("#weight").bind("plothover", function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2);

        $("#weight-tooltip").html(item.series.label + " of " + x + " = " + y)
            .css({top: item.pageY + 5, left: item.pageX + 5})
            .fadeIn(200);
      } else {
        $("#weight-tooltip").hide();
      }

    });
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="heightHeadChest-tooltip"></div>').css({
      position: "absolute",
      display: "none",
      opacity: 0.8
    }).appendTo("body");
    $("#heightHeadChest").bind("plothover", function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2);

        $("#heightHeadChest-tooltip").html(item.series.label + " of " + x + " = " + y)
            .css({top: item.pageY + 5, left: item.pageX + 5})
            .fadeIn(200);
      } else {
        $("#heightHeadChest-tooltip").hide();
      }

    });
    /* END LINE CHART */
</script>
@stop
