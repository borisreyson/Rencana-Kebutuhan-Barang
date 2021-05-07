
<?php $__env->startSection('title'); ?>
ABP-system | Home
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <style>
 .rkb_success{ 
    background: #40FC22 !important;
    border: 1px solid #40FC22 !important;
    color: #fff
 }
 .tile_stats_count{
    padding-top: 20px!important;
    margin: 5px!important;
    border: 0px!important;     
    }
  
 </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
$arrRULE = [];
  if(isset($getUser)){
    $arrRULE = explode(',',$getUser->rule);    
  }else{
    ?>
<script>
  window.location="<?php echo e(url('/logout')); ?>";
</script>
    <?php } ?>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<?php echo $__env->make('layout.nav',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layout.top',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->

<?php if(in_array('rkb',$arrRULE)): ?> 
          <div class="row tile_count ">
<?php $__currentLoopData = json_decode($DaTa); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($v->kode == "user"): ?>
<?php if($_SESSION['level']=="administrator"): ?>
<a href="<?php echo e($v->url); ?>">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 " title="<?php echo e($v->name); ?> : <?php echo e($v->value); ?>" data-toggle="tooltip">
                <div class="tile-stats <?php echo e($v->color); ?>" style="color: #fff!important;">
                  <div class="icon" style="color: #fff!important;"><i class="fa fa-file-o"></i></div>
                  <div class="count" style="color: #fff!important;"><?php echo e($v->value); ?></div>
                  <h3 style="color: #fff!important;"><?php echo e($v->name); ?></h3>
                </div>
              </div>
</a>
              <?php endif; ?>
<?php else: ?>
<a href="<?php echo e($v->url); ?>">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 " title="<?php echo e($v->name); ?> : <?php echo e($v->value); ?>" data-toggle="tooltip">
                <div class="tile-stats <?php echo e($v->color); ?>" style="color: #fff!important;">
                  <div class="icon" style="color: #fff!important;"><i class="fa fa-file-o"></i></div>
                  <div class="count" style="color: #fff!important;"><?php echo e($v->value); ?></div>
                  <h3 style="color: #fff!important;"><?php echo e($v->name); ?></h3>
                </div>
              </div>
</a>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <!-- /top tiles -->
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Network Activities</h3>
                  </div> 
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="echart_line" class="demo-placeholder"></div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
<?php 
$rkb_section_total=0;
$rkb_section = Illuminate\Support\Facades\DB::table("e_rkb_header")
                ->where("section",$_SESSION['section'])
                ->count();
if($total_rkb>0){
$rkb_section_total = (($rkb_section/$total_rkb)*100);
}else{
$rkb_section_tota=0;
}
 ?>
                      <p>RKB <?php echo e($_SESSION['section']); ?> (<?php echo e(($rkb_section?$rkb_section:'')); ?>)</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 100%;">
                          <div class="progress-bar bg-blue" role="progressbar" data-transitiongoal="<?php echo e(($rkb_section_total?$rkb_section_total:0)); ?>"></div>
                        </div>
                      </div>
                    </div>
                    <div>
<?php 
$rkb_section_approve = Illuminate\Support\Facades\DB::table("e_rkb_header")
                ->where([
                ["e_rkb_header.section",$_SESSION['section']],
                ["e_rkb_approve.diketahui","!=",0],
                ["e_rkb_approve.cancel_user","=",null]
                ])
                ->join("e_rkb_approve","e_rkb_approve.no_rkb","e_rkb_header.no_rkb")
                ->select("e_rkb_approve.*","e_rkb_header.*")
                ->count();

if($rkb_section>0){
$rkb_section_total_approve = (($rkb_section_approve/$rkb_section)*100);
}else{
$rkb_section_total_approve=0;
}
 ?>
                      <p>RKB <?php echo e($_SESSION['section']); ?> Approve (<?php echo e($rkb_section_approve); ?>)</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 100%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo e($rkb_section_total_approve); ?>"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
<?php 
$rkb_section_pending = Illuminate\Support\Facades\DB::table("e_rkb_header")
                ->where([
                ["e_rkb_header.section",$_SESSION['section']],
                ["e_rkb_approve.diketahui",0],
                ["e_rkb_approve.cancel_user",null]
                ])
                ->join("e_rkb_approve","e_rkb_approve.no_rkb","e_rkb_header.no_rkb")
                ->select("e_rkb_approve.*","e_rkb_header.*")
                ->count();

if($rkb_section>0){
$rkb_section_total_pending = (($rkb_section_pending/$rkb_section)*100);
}else{
$rkb_section_total_pending=0;
}
 ?>
                      <p>RKB <?php echo e($_SESSION['section']); ?> Waiting (<?php echo e($rkb_section_pending); ?>)</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 100%;">
                          <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo e($rkb_section_total_pending); ?>"></div>
                        </div>
                      </div>
                    </div>
                    <div>
<?php 
$rkb_section_cancel = Illuminate\Support\Facades\DB::table("e_rkb_header")
                ->where([
                ["e_rkb_header.section",$_SESSION['section']],
                ["e_rkb_approve.diketahui",0],
                ["e_rkb_approve.cancel_user","!=",null]
                ])
                ->join("e_rkb_approve","e_rkb_approve.no_rkb","e_rkb_header.no_rkb")
                ->select("e_rkb_approve.*","e_rkb_header.*")
                ->count();

if($rkb_section>0){
$rkb_section_total_cancel = (($rkb_section_cancel/$rkb_section)*100);
}else{
$rkb_section_total_cancel=0;
}
 ?>
                      <p>RKB <?php echo e($_SESSION['section']); ?> Cancel (<?php echo e($rkb_section_cancel); ?>)</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 100%;">
                          <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo e($rkb_section_total_cancel); ?>"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!--
<?php if($_SESSION['section']=="IT"): ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div id="app">
                    <bar-chart></bar-chart>
                  </div>  
                </div>
                <?php endif; ?>
              -->


                <div class="clearfix"></div>
              </div>
            </div>

          </div>
<?php endif; ?>
<br>
<?php if($_SESSION['section']=="IT"): ?>
            <div class="row">

              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Top Profiles <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="height: 300px!important; overflow-y: auto;">
                    <div id="show-fade">
                    </div>
                  </div>
                </div>
              </div>
            </div>
  <?php endif; ?>

          <br />

            </div>
          </div>
        </div>
        <!-- /page content -->


<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
/*
      window.Echo.channel("online-user-channel").listen('onlineUserEvent ', function(e) {
        console.log(e.message);
      }); 
     */
</script>
<?php 
$getCount = $getDay = $vWeek = $approvE = $waiting = $cancel = [];

$tglOrder = $tglSetuju = $tglKetahui = $tglCancel = [];

  
  $lastweek = Illuminate\Support\Facades\DB::select(DB::Raw("select * from e_rkb_header where section = '".$_SESSION['section']."' and tgl_order between date_sub(now(),INTERVAL 1 WEEK) and now() group by Date(tgl_order)"));


  $lastweekAction = Illuminate\Support\Facades\DB::select(DB::Raw("select * from e_rkb_header ,e_rkb_approve
  where  section = '".$_SESSION['section']."' and ((e_rkb_approve.tgl_disetujui between date_sub(now(),INTERVAL 1 WEEK) and now()) and (e_rkb_approve.tgl_disetujui between date_sub(now(),INTERVAL 1 WEEK) and now()) or (e_rkb_approve.tgl_diketahui between date_sub(now(),INTERVAL 1 WEEK) and now()) or (e_rkb_approve.tgl_cancel_user between date_sub(now(),INTERVAL 1 WEEK) and now()))  group by Date(e_rkb_approve.tgl_disetujui) , Date(e_rkb_approve.tgl_cancel_user),Date(e_rkb_approve.tgl_diketahui),Date(e_rkb_header.tgl_order)"));

  foreach($lastweek as $kLast => $vLast){
    $tglOrder[]   = date("Y-m-d",strtotime($vLast->tgl_order));
  }

  foreach($lastweekAction as $kApprove => $vApprove){
    if($vApprove->tgl_disetujui!=null){
        $tglSetuju[]  = date("Y-m-d",strtotime($vApprove->tgl_disetujui));
    }
    if($vApprove->tgl_diketahui!=null){
    $tglKetahui[] = date("Y-m-d",strtotime($vApprove->tgl_diketahui));
    }
    if($vApprove->tgl_cancel_user!=null){
    $tglCancel[]  = date("Y-m-d",strtotime($vApprove->tgl_cancel_user));
    }
  }

  $merge = array_unique(array_merge($tglOrder,$tglSetuju,$tglKetahui,$tglCancel));

  foreach($merge as $kMerge => $vMerge){
  $findDate = date('Y-m-d',strtotime($vMerge));
  $countDay = Illuminate\Support\Facades\DB::table("e_rkb_header")
            ->where("e_rkb_header.section",$_SESSION['section'])
            ->whereDate("tgl_order",$findDate)
            ->count();  
  $countApprove = Illuminate\Support\Facades\DB::table("e_rkb_approve")
            ->join("e_rkb_header","e_rkb_header.no_rkb","e_rkb_approve.no_rkb")
            ->where([
            ["e_rkb_approve.diketahui",1],
            ["e_rkb_approve.cancel_user",null],
            ["e_rkb_header.section",$_SESSION['section']]
            ])
            ->whereDate("e_rkb_approve.tgl_diketahui",$findDate)
            ->count();
  
  $countWaiting = Illuminate\Support\Facades\DB::table("e_rkb_approve")
            ->join("e_rkb_header","e_rkb_header.no_rkb","e_rkb_approve.no_rkb")
            ->whereRaw("(e_rkb_header.section = '".$_SESSION['section']."' and e_rkb_approve.diketahui=0 and e_rkb_approve.cancel_user IS NULL)")
            ->whereDate("e_rkb_header.tgl_order",$findDate)
            ->count();
            
  $countCancel = Illuminate\Support\Facades\DB::table("e_rkb_approve")
            ->join("e_rkb_header","e_rkb_header.no_rkb","e_rkb_approve.no_rkb")
            ->where([
            ["e_rkb_approve.cancel_user","!=",null],
            ["e_rkb_header.section",$_SESSION['section']]
            ])
            ->whereDate("e_rkb_approve.tgl_cancel_user",$findDate)
            ->count();
    $getCount[] = $countDay;
    $approvE[] = $countApprove;
    $waiting[] = $countWaiting;
    $cancel[] = $countCancel;
    $getDay[] = date("l",strtotime($vMerge));
  }
 ?>
<script>
    
    /* ECHRTS */    
    function init_echarts() {

        if( typeof (echarts) === 'undefined'){ return; }    
          var theme = {
          color: [
            '#004C97', '#41FF22', '#F7C803', '#F21003',
            '#9B59B6', '#466C95', '#F7C803', '#3E606F'
          ],

          title: {
            itemGap: 8,
            textStyle: {
              fontWeight: 'normal',
              color: '#408829'
            }
          },

          dataRange: {
            color: ['#1f610a', '#97b58d']
          },

          toolbox: {
            color: ['#408829', '#408829', '#408829', '#408829']
          },

          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.5)',
            axisPointer: {
              type: 'line',
              lineStyle: {
                color: '#408829',
                type: 'dashed'
              },
              crossStyle: {
                color: '#408829'
              },
              shadowStyle: {
                color: 'rgba(200,200,200,0.3)'
              }
            }
          },

          dataZoom: {
            dataBackgroundColor: '#eee',
            fillerColor: 'rgba(64,136,41,0.2)',
            handleColor: '#408829'
          },
          grid: {
            borderWidth: 0
          },

          categoryAxis: {
            axisLine: {
              lineStyle: {
                color: '#408829'
              }
            },
            splitLine: {
              lineStyle: {
                color: ['#eee']
              }
            }
          },

          valueAxis: {
            axisLine: {
              lineStyle: {
                color: '#408829'
              }
            },
            splitArea: {
              show: true,
              areaStyle: {
                color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
              }
            },
            splitLine: {
              lineStyle: {
                color: ['#eee']
              }
            }
          },
          timeline: {
            lineStyle: {
              color: '#408829'
            },
            controlStyle: {
              normal: {color: '#408829'},
              emphasis: {color: '#408829'}
            }
          },

          k: {
            itemStyle: {
              normal: {
                color: '#68a54a',
                color0: '#a9cba2',
                lineStyle: {
                  width: 1,
                  color: '#408829',
                  color0: '#86b379'
                }
              }
            }
          },
          map: {
            itemStyle: {
              normal: {
                areaStyle: {
                  color: '#ddd'
                },
                label: {
                  textStyle: {
                    color: '#c12e34'
                  }
                }
              },
              emphasis: {
                areaStyle: {
                  color: '#99d2dd'
                },
                label: {
                  textStyle: {
                    color: '#c12e34'
                  }
                }
              }
            }
          },
          force: {
            itemStyle: {
              normal: {
                linkStyle: {
                  strokeColor: '#408829'
                }
              }
            }
          },
          chord: {
            padding: 4,
            itemStyle: {
              normal: {
                lineStyle: {
                  width: 1,
                  color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                  lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                  }
                }
              },
              emphasis: {
                lineStyle: {
                  width: 1,
                  color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                  lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                  }
                }
              }
            }
          },
          gauge: {
            startAngle: 225,
            endAngle: -45,
            axisLine: {
              show: true,
              lineStyle: {
                color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                width: 8
              }
            },
            axisTick: {
              splitNumber: 10,
              length: 12,
              lineStyle: {
                color: 'auto'
              }
            },
            axisLabel: {
              textStyle: {
                color: 'auto'
              }
            },
            splitLine: {
              length: 18,
              lineStyle: {
                color: 'auto'
              }
            },
            pointer: {
              length: '90%',
              color: 'auto'
            },
            title: {
              textStyle: {
                color: '#333'
              }
            },
            detail: {
              textStyle: {
                color: 'auto'
              }
            }
          },
          textStyle: {
            fontFamily: 'Arial, Verdana, sans-serif'
          }
        };

<?php if($_SESSION['section']=="KTT"){  ?>
    title_teks = "Graph RKB";
    text_label = "";
  <?php
}elseif($_SESSION['section']=="KABAG"){  ?>
    title_teks = "Line Graph RKB <?php echo e($_SESSION['department']); ?>";
    text_label = "<?php echo e($_SESSION['department']); ?>";
  <?php
}else{  ?>
    title_teks = "Line Graph RKB <?php echo e($_SESSION['section']); ?>";
    text_label = "<?php echo e($_SESSION['section']); ?>";
  <?php } ?>

         //echart Line
        
      if ($('#echart_line').length ){ 
        
        var echartLine = echarts.init(document.getElementById('echart_line'), theme);

        echartLine.setOption({
        title: {
          text: title_teks,
          subtext: 'Subtitle'
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          x: 100,
          y: 30,
          data: ["Total Rkb "+text_label,"Rkb "+text_label+" Approve","Rkb "+text_label+" Waiting", "Rkb "+text_label+" Cancel"  ]
        },
        toolbox: {
          show: true,
          feature: {
          magicType: {
            show: true,
            title: {
            line: 'Line',
            bar: 'Bar',
            stack: 'Stack',
            tiled: 'Tiled'
            },
            type: ['line', 'bar', 'stack', 'tiled']
          },
          restore: {
            show: true,
            title: "Restore"
          },
          saveAsImage: {
            show: true,
            title: "Save Image"
          }
          }
        },
        calculable: true,
        xAxis: [{
          type: 'category',
          boundaryGap: false,
          data: <?php echo json_encode($getDay); ?>
        }],
        yAxis: [{
          type: 'value'
        }],
        series: [{
          name: "Total Rkb "+text_label,
          type: 'line',
          smooth: true,
          itemStyle: {
          normal: {
            areaStyle: {
            type: 'default'
            }
          }
          },
          data: <?php echo json_encode($getCount); ?>
        }, {
          name: "Rkb "+text_label+" Approve",
          type: 'line',
          smooth: true,
          itemStyle: {
          normal: {
            areaStyle: {
            type: 'default'
            }
          }
          },
          data: <?php echo json_encode($approvE); ?>
        }, {
          name: "Rkb "+text_label+" Waiting",
          type: 'line',
          smooth: true,
          itemStyle: {
          normal: {
            areaStyle: {
            type: 'default'
            }
          }
          },
          data: <?php echo json_encode($waiting); ?>
        }, {
          name: "Rkb "+text_label+" Cancel",
          type: 'line',
          smooth: true,
          itemStyle: {
          normal: {
            areaStyle: {
            type: 'default'
            }
          }
          },
          data: <?php echo json_encode($cancel); ?>
        }]
        });

      }
}
init_echarts();
</script>

<?php if(session('success')): ?>
  <script>
    setTimeout(function(){
new PNotify({
          title: 'Success',
          text: "<?php echo e(session('success')); ?>",
          type: 'success',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
<?php endif; ?>

<?php if(session('failed')): ?>
  <script>
    setTimeout(function(){
new PNotify({
          title: 'Failed',
          text: "<?php echo e(session('failed')); ?>",
          type: 'error',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>