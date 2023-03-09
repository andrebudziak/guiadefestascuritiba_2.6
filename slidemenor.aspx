<%@ Page Language="C#" AutoEventWireup="true" CodeFile="slidemenor.aspx.cs" Inherits="teste" %>
<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="cc1" %>

<!DOCTYPE html>

<html>
<head runat="server">
    <title></title>
    <script src="Scripts/jquery-1.7.2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/globalm.css">
    <script src="Scripts/slides.min.jquery.js" type="text/javascript"></script>
	<script type="text/javascript">
	    $(function () {
	        $('#slides').slides({
	            preload: true,
	            preloadImage: 'img/loading.gif',
	            play: 5000,
	            pause: 2500,
	            hoverPause: true,
	            animationStart: function (current) {
	                $('.caption').animate({
	                    bottom: -35
	                }, 100);
	                if (window.console && console.log) {
	                    // example return of current slide number
	                    console.log('animationStart on slide: ', current);
	                };
	            },
	            animationComplete: function (current) {
	                $('.caption').animate({
	                    bottom: 0
	                }, 200);
	                if (window.console && console.log) {
	                    // example return of current slide number
	                    console.log('animationComplete on slide: ', current);
	                };
	            },
	            slidesLoaded: function () {
	                $('.caption').animate({
	                    bottom: 0
	                }, 200);
	            }
	        });
	    });	
        </script>    

</head>
<body>
    <form id="form1" runat="server">
    <div>
      



<!-- INICIO slide -->


  <div id="container">
	<div id="example">
    <asp:Label ID="lblSlidem" runat="server" Text=""></asp:Label>

    </div>
</div>

     
<!-- FIM slide -->



    </div>
</body>

</form>
</html>
