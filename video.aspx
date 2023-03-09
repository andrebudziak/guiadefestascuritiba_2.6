<%@ Page Language="C#" AutoEventWireup="true" CodeFile="video.aspx.cs" Inherits="video" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>

    <link rel="stylesheet" href="theme/style.css" type="text/css" media="screen" />

    
    <script type="text/javascript" src="Scripts/jquery-1.7.2.min.js"></script>

    <script src="Scripts/projekktor-1.0.29r105.min.js" type="text/javascript"></script>
    
    
</head>
<body>
    <form id="form1" runat="server">
    <div>
      
       <video id="demoplayer" runat="server" class="projekktor" title="" poster="intro.png" src="" type="video/youtube" width="640" height="385" controls>
       </video>    

        <script type="text/javascript">
            $(document).ready(function () {
                projekktor('#demoplayer', {
                    volume: 0.8,
                    plugin_display: {
                        logoImage: "imagens/logo.png",
                        logoURL: "http://www.guiadefestascuritiba.com.br/",
                        target: "_blank"
                    }
                });
            });
            
        </script>  
      
    </div>
    </form>
</body>
</html>
