<!-- 
LOCUS-2017-Profile-Picture-Generator
Coded by Sushant Gautam :: susant.gautam@gmail.com  :: sushant.info.np
GITHUB: https://github.com/SushantGautam/LOCUS-2017-Profile-Picture-Generator/
January 17, 2015
MIT License, Copyright (c) 2017 Sushant Gautam
 -->

<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<head>
<title>LOCUS 2017 Profile Picture Generator</title>
<meta charset="UTF-8">
<h4>LOCUS 2017 Profile Picture Generator <h4> 
</head>
<body>
<script>

var imageurl;
var dataURL;
var canvas;

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
        document.getElementById('output').style.display = 'none';
    } else {
    
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
        document.getElementById('output').style.display = 'none';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '400971500103999',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
       document.getElementById('output').style.display = 'true';
      //$(".login").hide();
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + ' '+ response.id+'!';
        //https://graph.facebook.com/67563683055/picture?width=9999&height=9999
        imageurl= "https://graph.facebook.com/"+response.id+"/picture?width=500&height=500";
        load();
        
        //$myImageID = $_GET[imageurl];
        //imagejpeg($myImageID , NULL, 75);
function show_image(src, width, height, alt) {
    var img = document.createElement("img");
    img.src = imageurl;
    img.width = width;
    img.height = height;
    img.alt = alt;

    // This next line will just add it to the <body> tag
    //document.getElementById("photo").appendChild(img);
}

show_image('http://google.com/images/logo.gif', 
                 276, 
                 110, 
                 'Google Logo');

       //  echo "<img src="+imageurl +" border=0>"; 
        //echo file_get_contents($imageurl);
         

    });
  }
  

var ximg1= new Image();
var ximg2= new Image();

var img1= new Image();
var img2= new Image();



function load(){
xi1=new XMLHttpRequest();
xi1.open("GET","imgdata.php?type=1&url="+imageurl,true);
xi1.send();
xi1.onreadystatechange=function() {
  if(xi1.readyState==4 && xi1.status==200) {
  ximg1=new Image;
    ximg1.src=xi1.responseText;
        img1.src=xi1.responseText;
    console.log(img1.src);
  }
}

xi2=new XMLHttpRequest();
xi2.open("GET","imgdata.php?type=2&url="+"http://locus.pcampus.edu.np/img/top_logo.png",true);
xi2.send();
xi2.onreadystatechange=function() {
  if(xi2.readyState==4 && xi2.status==200) {
  ximg2=new Image;
    ximg2.src=xi2.responseText;
        img2.src=xi2.responseText;
    console.log(img2.src);
  }
}
return $.Deferred().resolve();

};


function blend () {
canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
var width = img1.width;
console.log(img1.width);
var height = img1.height;
canvas.width = width;
console.log("new width" +img1.width);
canvas.height = height;
var pixels = 4 * width * height;
context.drawImage(img1, 0,0 ,canvas.width, canvas.height);
var image1 = context.getImageData(0, 0, width, height);
var imageData1 = image1.data;
context.drawImage(img2, 0,0, canvas.width, canvas.width);
var image2 = context.getImageData(0, 0, width, height);
var imageData2 = image2.data;
while (pixels--) {
    imageData1[pixels] = imageData1[pixels] * 0.5 + imageData2[pixels] * 0.5;
}
image1.data = imageData1;
context.putImageData(image1, 0, 0);


      // save canvas image as data url (png format by default)
      dataURL = canvas.toDataURL();
//console.log(dataURL);

};
  
function merge(){
blend();
};

    
</script>

<div id="login" >
<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
<div id="status"> </div>
</div>

<div id="output" >
<div id="photo"> </div>
<br>
<button type="button" onclick="merge();"> Generate Profile Picture </button> <br> <br>
<canvas id="canvas"></canvas>
</div>
<p>Coded by Sushant Gautam :: <a href="mailto:susant.gautam@gmail.com">susant.gautam@gmail.com</a>  :: <a href="http://sushant.info.np"> sushant.info.np </a> <br>
GITHUB: <a href="https://github.com/SushantGautam/LOCUS-2017-Profile-Picture-Generator/">https://github.com/SushantGautam/LOCUS-2017-Profile-Picture-Generator/</a> <br>
January 17, 2015 <br>
MIT License, Copyright (c) 2017 Sushant Gautam <br></p>
</body>
</html>
