<!doctype html>
<html lang="en">

<head>
  <title>ICMS Users | ICMS</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- Datatables core css -->
  <link href="admin/assets/plugins/datatables.net-bs4/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <!-- Datatables extensions css -->
  <link href="admin/assets/plugins/datatables.net-buttons-bs4/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="admin/assets/plugins/datatables.net-colreorder-bs4/colreorder.bootstrap4.min.html" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="admin/assets/css/bootstrap-custom.min.css" rel="stylesheet" type="text/css" />
  <link href="admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="admin/assets/images/favicon.png">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<style type="text/css">
    text{
        font-family:Helvetica, Arial, sans-serif;
        font-size:11px;
        pointer-events:none;
    }
    #chart{
      margin: -20px auto;
         /*position:absolute;*/
        /*width:300px;*/
        /*height:300;*/
        /*top:250px;*/
        /*left:1px;*/
    }
    #question{
        /*position: relative;
        width:400px;
        height:500px;
        top:200px;
        left:520px;*/
        margin: 0 auto;
    }
    #question h1{
        font-size: 50px;
        font-weight: bold;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        /*position: absolute;*/
        padding: 0;
        margin: 0;
        top:50%;
        -webkit-transform:translate(0,-50%);
                transform:translate(0,-50%);
    }
    </style>
</head>
<body>
  <!-- WRAPPER -->
  <div id="wrapper">

    <!-- NAVBAR -->
@include('admin.navBar')
    <!-- END NAVBAR -->

    <!-- LEFT SIDEBAR -->
    @include('admin.sideBar')
    <!-- END LEFT SIDEBAR -->

    <!-- MAIN -->
    <div class="main">

      <!-- MAIN CONTENT -->
      <div class="main-content">

        <div class="content-heading">
          <div class="heading-left">
            <h1 class="page-title">Lucky Spin</h1>
            {{-- <p class="page-subtitle">Each spin is worth Ksh 30. Enjoy!</p> --}}
          </div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><h5><i class="fa fa-money"></i> Balance Ksh <span id="wallet">{{ Auth::user()->wallet }}</span></h5></li>

            </ol>
          </nav>
        </div>

        <div class="container-fluid">

             <div id="chart" class="col-lg-6 col-sm-12 col-md-6"></div>
             <div id="question" style="display: none;"><h1 id="wonId"></h1><h3 id="amountValue" style="display: none;"></h3></div>
        </div>
      </div>
      <!-- END MAIN CONTENT -->



    </div>
    <!-- END MAIN -->

    <div class="clearfix"></div>
    
    <!-- footer -->
    @include('admin.footer')
    <!-- end footer -->

  </div>
  <!-- END WRAPPER -->

  <!-- Vendor -->
  <script src="admin/assets/js/vendor.min.js"></script>

  <!-- Datables Core -->
  <script src="admin/assets/plugins/datatables.net/jquery.dataTables.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-bs4/dataTables.bootstrap4.min.js"></script>

  <!-- Datables Extension -->
  <script src="admin/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="admin/assets/plugins/jszip/jszip.min.js"></script>
  <script src="admin/assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="admin/assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons-bs4/buttons.bootstrap4.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-colreorder/dataTables.colReorder.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-colreorder-bs4/colReorder.bootstrap4.min.js"></script>

  <!-- Datatables Init -->
  <script src="admin/assets/js/pages/tables-dynamic.init.min.js"></script>

  <!-- App -->
  <script src="admin/assets/js/app.min.js"></script> 
    
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
         var padding = {top:90, right:40, bottom:0, left:19},
            w = 500 - padding.left - padding.right,
            h = 500 - padding.top  - padding.bottom,
            r = Math.min(w, h)/2,
            rotation = 0,
            oldrotation = 0,
            picked = 100000,
            oldpick = [],
            color = d3.scale.category20();

        var data = [
                   
                    
                    {"label":50, "value":50, "question":"won ksh 50"}, 
                    {"label":15, "value":15, "question":"won ksh 15"}, 
                    {"label":5, "value":5, "question":"won ksh 5"}, 
                    {"label":10, "value":10, "question":"won ksh 10"}, 
                    {"label":15, "value":15, "question":"won ksh 15"}, 
                    {"label":50, "value":50, "question":"won ksh 50"}, 
                    {"label":20, "value":20, "question":"won ksh 20"}, 
                    {"label":50, "value":50, "question":"won ksh 50"}, 
                    {"label":25, "value":25, "question":"won ksh 25"}, 
                    {"label":50, "value":50, "question":"won ksh 50"}, 
                    {"label":20, "value":20, "question":"won ksh 20"},
                    {"label":5, "value":5, "question":"won 5"}, 
                    {"label":10, "value":10, "question":"won 10"} 
        ];

        var svg = d3.select('#chart')
            .append("svg")
            .data([data])
            .attr("width",  w + padding.left + padding.right)
            .attr("height", h + padding.top + padding.bottom);

        var container = svg.append("g")
            .attr("class", "chartholder")
            .attr("transform", "translate(" + (w/2 + padding.left) + "," + (h/2 + padding.top) + ")");

        var vis = container
            .append("g");
            
        var pie = d3.layout.pie().sort(null).value(function(d){return 1;});

        // declare an arc generator function
        var arc = d3.svg.arc().outerRadius(r);

        // select paths, use arc generator to draw
        var arcs = vis.selectAll("g.slice")
            .data(pie)
            .enter()
            .append("g")
            .attr("class", "slice");
            

        arcs.append("path")
            .attr("fill", function(d, i){ return color(i); })
            .attr("d", function (d) { return arc(d); });

        // add the text
        arcs.append("text").attr("transform", function(d){
                d.innerRadius = 0;
                d.outerRadius = r;
                d.angle = (d.startAngle + d.endAngle)/2;
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
            })
            .attr("text-anchor", "end")
            .text( function(d, i) {
                return data[i].label;
            });



        container.on("click", spin);


        function spin(d){
            console.log(navigator.onLine);
            
    if (navigator.onLine == true) {

            var balancew = "<?php ; ?>";

             var balance = $("#wallet").text();
             if (balance<30) {

// alert("Sorry, your balance is insufficient ");
// return;
             }

            
            container.on("click", null);

            //all slices have been seen, all done
            console.log("OldPick: " + oldpick.length, "Data length: " + data.length);

            console.log(oldpick);
            if(oldpick.length == data.length){
                console.log("done");
                container.on("click", null);
                return;
            }

            var  ps = 360/data.length,
                 pieslice = Math.round(1440/data.length),
                 rng      = Math.floor((Math.random() * 1440) + 360);
                
            rotation = (Math.round(rng / ps) * ps);
            
            picked = Math.round(data.length - (rotation % 360)/ps);
            picked = picked >= data.length ? (picked % data.length) : picked;


            /*if(oldpick.indexOf(picked) !== -1){
                d3.select(this).call(spin);
                return;

            } else {
                oldpick.push(picked);
            }

            rotation += 90 - Math.round(ps/2);*/

            vis.transition()
                .duration(3000)
                .attrTween("transform", rotTween)
                .each("end", function(){

                    //mark question as seen
                   /* d3.select(".slice:nth-child(" + (picked + 1) + ") path")
                        .attr("fill", "red");*/

                    //populate question
                    d3.select("#question h1")
                        .text(data[picked].question);

                        d3.select("#question h3")
                        .text(data[picked].value);



                        var finaAmt =$("#amountValue").text();
                  //

                     Swal.fire({
                                  icon: 'success',
                                  title: "",
                        
                                  text: 'You have won...',
                                }).then((result)=> {
                                    
                                  $.ajax({
                        data: {"amount": finaAmt, _token: '{{ csrf_token() }}'},
                        type: "post",
                        url: "{{ route('spinWin') }}",
                        success: function(response){

                          if(response['msg'] == "error")
                          {
                            Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: 'Your spin limit has been reached. Try again tomorrow!',
                                })
                            return false;
                          }
                          else{
                            Swal.fire({
                                  icon: 'success',
                                  title: $("#wonId").text(),
                        
                                  text: '',
                                })
                          }
                        

                        $( "#wallet" ).load(window.location.href + " #wallet" );
                        
                                },
                        error:function(XMLHttpRequest,textStatus,errorThrown){
                            
                            
                           Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: 'Something went wrong!',
                                })
                        }
                        
                    });
                      
                                    
                                    
                                })
                       
                       
                        







                    oldrotation = rotation;
                
                    container.on("click", spin);
                });
        } else{
            
            
            alert("No internet connection");
        } 
                
        }

        //make arrow
        /*svg.append("g")
            .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
            .append("path")
            .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
            .style({"fill":"black"});*/

        //draw spin circle
        container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 60)
            .style({"fill":"white","cursor":"pointer"});

        //spin text
        container.append("text")
            .attr("x", 0)
            .attr("y", 15)
            .attr("text-anchor", "middle")
            .text("SPIN")
            .style({"font-weight":"bold", "font-size":"30px"});
        
        
        function rotTween(to) {
          var i = d3.interpolate(oldrotation % 360, rotation);
          return function(t) {
            return "rotate(" + i(t) + ")";
          };
        }
        
        
        function getRandomNumbers(){
            var array = new Uint16Array(1000);
            var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);

            if(window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function"){
                window.crypto.getRandomValues(array);
                console.log("works");
            } else {
                //no support for crypto, get crappy random numbers
                for(var i=0; i < 1000; i++){
                    array[i] = Math.floor(Math.random() * 100000) + 1;
                }
            }

            return array;
        }


    </script>

</body>

</html>