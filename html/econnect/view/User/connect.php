
<script>

  function fb(){
    
    var form = document.getElementById("form");
    var submit = document.getElementById("submit");
    var socialmedia = document.getElementById("socialmedia");

    document.getElementById("form_title").innerHTML = "Sign up with Facebook";
    document.getElementById("emailbtn").style.visibility = "visible";

    socialmedia.value = "fb";
    form.style.backgroundColor = "#3B5998";
    submit.style.color = "white";
    submit.style.backgroundColor = "#2E64FE";
  }

  function twi(){
    var form = document.getElementById("form");
    var submit = document.getElementById("submit");
    var socialmedia = document.getElementById("socialmedia");

    document.getElementById("form_title").innerHTML = "Sign up with Twitter";
    document.getElementById("emailbtn").style.visibility = "visible";

    socialmedia.value = "twitter";
    submit.style.color = "white";
    form.style.backgroundColor = "#55ACEE";
    submit.style.backgroundColor = "#2E64FE";
  }

   function google(){
    var form = document.getElementById("form");
    var submit = document.getElementById("submit");
    var socialmedia = document.getElementById("socialmedia");

    document.getElementById("form_title").innerHTML = "Sign up with Google";
    document.getElementById("emailbtn").style.visibility = "visible";

    socialmedia.value = "google";
    form.style.backgroundColor = "#dd4b39";
    submit.style.color = "black";
    submit.style.backgroundColor = "white";
  }

  function email(){
    var form = document.getElementById("form");
    var submit = document.getElementById("submit");
    var socialmedia = document.getElementById("socialmedia");

    document.getElementById("form_title").innerHTML = "Sign up with your email";
    document.getElementById("emailbtn").style.visibility = "hidden";

    socialmedia.value = "email";
    submit.style.color = "white";
    form.style.backgroundColor = "white";
    submit.style.backgroundColor = "#4CAF50";
  }


</script> 


<div id="container">
  <form method="post" action=<?php echo '"'.(File::build_path(array('index.php'))). '"'; ?>>
    <div class="row">
      <h2 style="text-align:center">Login with Social Media or eMail to access internet</h2>
      <div class="vl">
        <span class="vl-innertext">or</span>
      </div>

    
    <div id ="social_media">  
      <div class="col">
        
     
        <a class="fb btn" onclick="fb()">
          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
         </a>
     
        
       
        <a class="twitter btn" onclick="twi()">
          <i class="fa fa-twitter fa-fw"></i> Login with Twitter 
        </a>
    
        
        
        <a class="google btn" onclick="google()">
          <i class="fa fa-google fa-fw"> </i>
          Login with Google+ 
        </a>

        <a id="emailbtn" class="email btn" onclick="email()"> Login with your email </a>

      </div>
    
    </div>

    
      <div class="col">
        <div id="form">
        <div class="hide-md-lg">
          <p id = "form_title">sign in with mail :</p>
        </div>

        <input type="email" name="login" placeholder="Email" required>
        <input type="password" name="passwd" placeholder="Password" required>
        <input id="submit" type="submit" value="Login">

        <input id="socialmedia" type="hidden" name="socialmedia" value="none">
        <input type="hidden" name="controller" value="User">
        <input type="hidden" name="action" value="connected">


      </div>
    </div>
      
    </div>
  </form>
</div>



</body>