<%@ Page Language="C#" AutoEventWireup="true" CodeFile="mapa.aspx.cs" Inherits="mapa" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>

<link href="Styles.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    
.mapdiv
{
	width:500px;
	height:300px;
	border: 1px solid rgb(0,0,0);
}    
</style>
<script src="Scripts/jquery-1.4.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAPQB7l_Iwpq7wX025S4I0BLCVv_3vn5Sc&sensor=false"></script>



</head>
<body>
    <form id="form1" runat="server">
    <div>
        <asp:ScriptManager ID="ScriptManager1" runat="server"></asp:ScriptManager>


        <asp:UpdatePanel ID="UpdatePanel1" runat="server">
        <ContentTemplate>
           <asp:Panel ID="pnMap" runat="server">
           </asp:Panel>        
        </ContentTemplate>
        </asp:UpdatePanel>


    </div>
    </form>
</body>
</html>
