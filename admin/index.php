<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SFXC || LOG IN
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/css/pages/auth.css">
    <link rel="shortcut icon" href="../assets/images/sfxc.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
</head>

<style>
      body {
        background-image: url("https://asscat.edu.ph/wp-content/uploads/2022/10/asscat-1.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        
      }
      .logo{
      
        margin-top: 40%;
       
      }
      .card{
        width: 650px;
        height: 400px;
        margin-left: 15%;
      }
      .fw-normal{
        font-family: 'Fredoka One', cursive;
        font-weight: bolder;
      }
      .form-label{
        font-family: 'Fredoka One', cursive;
      }
    </style>

<body>
  
    <section class="vh-100 ">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card bg-light p-2 text-dark bg-opacity-75 img-fluid mx-auto d-block" style="border-radius: 1rem; " >
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img class="logo img-fluid mx-auto d-block" src="../assets/images/asscat.png" alt=""  width="200">
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                    <form id="form1">
      
                    <div class="d-flex align-items-center mb-3 pb-1">
                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                             
                           </div>

                           <h2 class="fw-normal mb-1 pb-3" style="letter-spacing: 1px;">ADMIN LOGIN</h2>

                            <div class="form-outline mb-1">
                                 <input type="text" id="username" class="form-control form-control-lg" />
                              <label class="form-label" for="username">Username</label>
                               </div>

                                <div class="form-outline mb-1">
                                  <input type="password" id="password" class="form-control form-control-lg" />
                                  <label class="form-label" for="password">Password</label>
                                      </div>

                                      <div class="pt-1 mb-1">
                                <button class="btn btn-success btn-lg btn-block" type="submit">Login</button>
                                  </div>
                        </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../assets/js/pages/dashboard.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

<script>


    $(document).ready(function(){

   //-------------------------- LOG IN -----------------------------------//
   
    $('#form1').submit(function(e){
      e.preventDefault();

    let username = $('#username').val();
    let password = $('#password').val();

    if(username == ""){
      alert('Please Enter Username');
    }else if (username == "" && password == ""){
      alert('Please Enter Username & Password');
    }else if(password == ""){
      alert('Please Enter Password');
    }else {

      $.ajax({
        url            : 'backend/signin.php',
        type           : 'POST',
        data           : {
                        username: username,
                        password: password
                        },
        dataType       : 'JSON',
        beforeSend     : function(){

        }
      }).done(function(res){

        if(res.res_success == 1){

          window.location = 'modules/dashboard.php';
        }else{
          alert(res.res_message);
        }

      }).fail(function(){
          console.log('FAIL!');
      })


    }


   })

  
   //document ready
 })



</script>