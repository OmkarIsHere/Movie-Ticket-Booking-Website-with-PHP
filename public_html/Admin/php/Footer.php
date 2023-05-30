
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieTime</title>
    <script src="../Javascript/navbar.js"></script>
    <link rel="stylesheet" href="../Css/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <style>

    </style>
</head>

<body>
    


    <footer id="FooterContainer">
        <div class="Footerpart1">
            <div class="col1-f1">
                <h3>GENERAL</h3>
                <ul>
                    <li class="list"><a href="#">ABOUT US</a><span>><a href="#">EVENTS</a></span></li>
                    <li class="list"><a href="#">FAQ'S</a><span>><a href="#">NVSP</a></span></li>
                    <li class="list"><a href="#">INVESTORS SECTION</a></li>
                    <li class="list"><a href="#">CAREER</a></li>
                    <li class="list"><a href="#">NEWS</a></li>
                    <li class="list"><a href="#">FEEDBACK</a></li>

                </ul>
            </div>
            <div class="col2-f1">
                <h3>OUR BRANDS</h3>
                <ul>
                    <li class="list"><a href="#">DIRECTOR'S CUT</a><span>><a href="#">LUXE</a></span></li>
                    <li class="list"><a href="#">PICTURES</a><span>><a href="#">P[XL]</a></span></li>
                    <li class="list"><a href="#">IMAX</a><span>><a href="#">ONYX</a></span></li>
                    <li class="list"><a href="#">4DX</a><span>><a href="#">NEST</a></span></li>
                    <li class="list"><a href="#">PLAYHOUSE</a><span>><a href="#">V PRISTINE</a></span></li>
                    <li class="list"><a href="#">GOLD</a></li>

                </ul>
            </div>
            <div class="col3-f1">
                <h3>CINEMAS</h3>
                <ul>
                    <li class="list"><a href="#">CINEMAS</a></li>
                    <li class="list"><a href="#">UPCOMING</a></li>
                    <li class="list"><a href="#">ADVERTISE</a></li>
                    <li class="list"><a href="#">BEYOND MOVIES</a></li>
                    <li class="list"><a href="#">BIRTHDAY REQUEST</a></li>
                    <li class="list"><a href="#">SUBSCRIBE TO NEWSLETTER</a></li>

                </ul>
            </div>
        </div>
        <div class="Footerpart2">
            <div class="row1-f2">
                <div class="supportImageContainer">
                    <img src="../image/Paytm-Logo.wine.png" alt="supports" class="supportimage" />
                    <img src="../image/notonsecure.png" alt="supports" class="supportimage" /></div>
                <div class="policyConditiionTerms">
                    <a href="#">PRIVACY<br />POLICY</a>
                    <a href="#">TERMS &<br />CONDITIONS</a>
                    <a href="#">TERMS OF<br />USE</a></div>
                <div class="socialmediaContainer">
                    <img src="../image/facebook.png" alt="socialmedia" class="socialmediastart" />
                    <img src="../image/google-plus.png" alt="socialmedia" class="socialmedia" />
                    <img src="../image/youtube.png" alt="socialmedia" class="socialmedia" />
                    <img src="../image/twitter.png" alt="socialmedia" class="socialmedia" />
                    <img src="../image/instagram.png" alt="socialmedia" class="socialmedia" />
                    <img src="../image/linkedin.png" alt="socialmedia" class="socialmedia" /></div>
            </div>
            <div class="row2-f2">
                <p>COPYRIGHT © 2022 MOVIETIME CINEMAS LTD. ALL RIGHTS RESERVED.</p>
            </div>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/2db247bd01.js" crossorigin="anonymous"></script>
</body>

</html>
<script>
    $(document).ready(function(){
     $('#searchbar').keyup(function(){
         var query=$(this).val();
        if(query!=''){
           
            $.ajax({
              url:"search.php",
              method:"POST",
              data:{query:query},
              success:function(data){
               
                $('#searchresult').fadeIn();
                $('#searchresult').html(data);
               
                console.log(data);
              } ,
              error: function(xhr, status, error) {
         console.log(status);
   }

            });
        }else{
            $('#searchresult').fadeOut();
                $('#searchresult').html("");
        }
      });
     $(document).on('click','li',function(){
      $('#searchbar').val($(this).text());
      $('searchresult').fadeOut();
       });
    });
</script>