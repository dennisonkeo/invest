<!doctype html>
<html lang="en">

<head>
  <title>Attention Adverts | Surveys</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">   

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
  {{-- <script src="quiz/quiz.js"></script> --}}
   <link href="quiz/quiz.css" rel="stylesheet" type="text/css" />


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
            <h1 class="page-title">Surveys</h1>
          </div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Parent</a></li>
              <li class="breadcrumb-item active">Current</li>
            </ol>
          </nav>
        </div>

        <div class="container-fluid">

           <div id="quizWrap"></div>

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
  <script src="{{ asset('admin/assets/js/vendor.min.js') }}"></script>

  <!-- App -->
  <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>

 
 <script type="text/javascript">
   



var quiz = {

@if($survey)
data:[ 
@foreach($survey->quizzes as $quiz)

{ q : "{{ $quiz->quiz }}",
    o : [
    @foreach($quiz->options as $option)
     " {{ $option->opt }}",

      @endforeach

    ],
    a : {{ $quiz->answer }} // arrays start with 0, so answer is 70 meters
  },
  @endforeach
  ],
  @else
  data:[{q: "No survey available!"}],
  @endif

  hey : [],

   getData: function(){

var quiz;
var options;
var answer;
var i;
var j;
let opt=[];
let main =[];

        $.ajax({
        url : "/getQuizzes",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          
           for (i=0; i<data.quizzes.length; i++) {

            for (j=0; j<data.quizzes[i]['options'].length; j++) {

         opt.push(data.quizzes[i]['options'][j]['opt']);
           
         }

         var postData= { q : data.quizzes[i]['quiz'],
           o :opt,
           a : data.quizzes[i]['answer'] // arrays start with 0, so answer is 70 meters
          };
main.push(postData);
opt = [];
         }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(errorThrown);
        }
    });

        // console.log(main);
        return main;
        // quiz.data = main;
  },


  // (A) PROPERTIES 
  // (A1) QUESTIONS & ANSWERS
  // Q = QUESTION, O = OPTIONS, A = CORRECT ANSWER

  // (A2) HTML ELEMENTS
  hWrap: null, // HTML quiz container
  hQn: null, // HTML question wrapper
  hAns: null, // HTML answers wrapper

  // (A3) GAME FLAGS
  now: 0, // current question
  score: 0, // current score

  // (B) INIT QUIZ HTML
  init: function(){
    // (B1) WRAPPER
    quiz.hWrap = document.getElementById("quizWrap");

    // (B2) QUESTIONS SECTION
    quiz.hQn = document.createElement("div");
    quiz.hQn.id = "quizQn";
    quiz.hWrap.appendChild(quiz.hQn);

    // (B3) ANSWERS SECTION
    quiz.hAns = document.createElement("div");
    quiz.hAns.id = "quizAns";
    quiz.hWrap.appendChild(quiz.hAns);

    // (B4) GO!
    quiz.draw();

    // quiz.data = quiz.getData();

    console.log(quiz.data);

    
  },

 
  // (C) DRAW QUESTION
  draw: function(){

    console.log(quiz.data);
    // (C1) QUESTION
    quiz.hQn.innerHTML = quiz.data[quiz.now].q;

    // (C2) OPTIONS
    quiz.hAns.innerHTML = "";
    for (let i in quiz.data[quiz.now].o) {
      let radio = document.createElement("input");
      radio.type = "radio";
      radio.name = "quiz";
      radio.id = "quizo" + i;
      quiz.hAns.appendChild(radio);
      let label = document.createElement("label");
      label.innerHTML = quiz.data[quiz.now].o[i];
      label.setAttribute("for", "quizo" + i);
      label.dataset.idx = i;
      label.addEventListener("click", quiz.select);
      quiz.hAns.appendChild(label);
    }
  },


  
  // (D) OPTION SELECTED
  select: function(){
    // (D1) DETACH ALL ONCLICK
    let all = quiz.hAns.getElementsByTagName("label");
    for (let label of all) {
      label.removeEventListener("click", quiz.select);
    }

    // (D2) CHECK IF CORRECT
    let correct = this.dataset.idx == quiz.data[quiz.now].a;
    if (correct) { 
      quiz.score++; 
      this.classList.add("correct");
    } else {
      this.classList.add("correct");
    }
  
    // (D3) NEXT QUESTION OR END GAME
    quiz.now++;
    setTimeout(function(){
      // console.log(quiz.data[0]);
      if (quiz.now < quiz.data.length) { quiz.draw(); } 
      else {
        quiz.hQn.innerHTML = "Thank you.";
        // `You have answered ${quiz.score} of ${quiz.data.length} correctly.`;

        $.ajax({
        url : "/surveyEarning",
        type: "POST",
        data:  {_token: '{{ csrf_token() }}'},
        dataType: "JSON",
        success: function(data)
        {
           if(data['msg'] == "success")
           {
             Swal.fire({
                                  icon: 'success',
                                  title: 'Congratulations',
                        
                                  text: 'Survey completed successfully!',
                                });

             // location.reload();
           }
           else if(data['msg'] == "error")
           {
               Swal.fire({
                                  icon: 'error',
                                  title: '...Ops!',
                        
                                  text: 'You have already participated. Try again tomorrow!',
                                })

               // location.reload();
           }


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
           Swal.fire({
                                  icon: 'error',
                                  title: '...Ops!',
                        
                                  text: 'Something went wrong!',
                                })
        }
    });

        
        quiz.hAns.innerHTML = "";
      }
    }, 1000);
  }
};
window.addEventListener("load", quiz.init);

 </script>  

</body>

</html>