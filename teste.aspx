<%@ Page Language="C#" AutoEventWireup="true" CodeFile="teste.aspx.cs" Inherits="teste" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    <link rel="stylesheet" href="css/blueberry.css" />
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="Scripts/jquery.blueberry.js"></script>

<script>
    $(window).load(function () {
        $('.blueberry').blueberry();
    });
</script>


<!-- jQuery -->
<script type="text/javascript" src="Scripts/jquery-loader.js"></script>

<!-- SmartMenus jQuery plugin -->
<script type="text/javascript" src="Scripts/jquery.smartmenus.js"></script>

<!-- SmartMenus jQuery init -->
<script type="text/javascript">
    $(function () {
        $('#main-menu').smartmenus({
            subMenusSubOffsetX: 6,
            subMenusSubOffsetY: -8
        });
    });
</script>

<!-- SmartMenus core CSS (required) -->
<link href="css/sm-core-css.css" rel="stylesheet" type="text/css" />

<!-- "sm-mint" menu theme (optional, you can use your own CSS, too) -->
<link href="css/sm-mint.css" rel="stylesheet" type="text/css" />

<!-- #main-menu config - instance specific stuff not covered in the theme -->
<style type="text/css">
	#main-menu {
		position:relative;
		z-index:9999;
		width:auto;
	}
	#main-menu ul {
		width:12em; /* fixed width only please - you can use the "subMenusMinWidth"/"subMenusMaxWidth" script options to override this if you like */
	}
</style>


</head>
<body>
    <form id="form1" runat="server">

<ul id="main-menu" class="sm sm-mint">
  <li><a href="http://www.guiadefestascuritiba.com.br/">Home</a></li>
  <li><a href="#">Locais para Festas</a>
    <ul>
        <asp:Label ID="lblLocal" runat="server" Text="Label"></asp:Label>
    </ul>
  </li>
  <li><a href="#">Decoração de Festas</a>
      <ul>
          <asp:Label ID="lblDecoracao" runat="server" Text="Label"></asp:Label>
      </ul>
  </li>
  <li><a href="#">Alimentação</a>
      <ul>
          <asp:Label ID="lblAlimentacao" runat="server" Text="Label"></asp:Label>
      </ul>
  </li>
  <li><a href="#">Diversão para Festas</a>
      <ul>
          <asp:Label ID="lblDiversao" runat="server" Text="Label"></asp:Label>
      </ul>
  </li>
  <li><a href="#">Serviços para Festas</a>
      <ul>
          <asp:Label ID="lblServicos" runat="server" Text="Label"></asp:Label>
      </ul>
  </li>
  <li><a href="#">Tipos de Festas</a>
      <ul>
          <asp:Label ID="lblTipo" runat="server" Text="Label"></asp:Label>
      </ul>
  </li>
  <li><a href="#">Mega menu</a>
    <ul class="mega-menu">
      <li>
        <!-- The mega drop down contents -->
        <div style="width:400px;max-width:100%;">
          <div style="padding:5px 24px;">
            <p>This is a mega drop down test. Just set the "mega-menu" class to the parent UL element to inform the SmartMenus script. It can contain <strong>any HTML</strong>.</p>
            <p>Just style the contents as you like (you may need to reset some SmartMenus inherited styles - e.g. for lists, links, etc.)</p>
	  </div>
	</div>
      </li>
    </ul>
  </li>
</ul>



<!-- blueberry -->
    <div class="blueberry">
      <ul class="slides">
          <asp:Label ID="lblSlide" runat="server" Text="Label"></asp:Label>
      </ul>
    </div>

<!-- blueberry -->





    </form>


</body>
</html>
