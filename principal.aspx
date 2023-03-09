<%@ Page Language="C#" AutoEventWireup="true" CodeFile="principal.aspx.cs" Inherits="principal" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="asp" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Cadastros</title>
    <link href="Styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form id="frmPrincipal" runat="server">
    <div>
       <center>       
           <table style="width:800px;" border="0" cellpadding="0" cellspacing="0">
               <tr>
                   <td align="center">
                      <div id="menu" style="width:800px; height:150px;">                          
                         <ul>                             
                            <li><asp:LinkButton ID="lbtnCliente" runat="server" onclick="lbtnCliente_Click" Font-Names="Arial" Font-Size="12px" ForeColor="#990000">Cliente</asp:LinkButton></li>
                            <li><asp:LinkButton ID="lbtnAnuncio" runat="server" Font-Names="Arial" 
                                    Font-Size="12px" ForeColor="#990000" onclick="lbtnAnuncio_Click">Anuncio</asp:LinkButton></li>
                            <li><asp:LinkButton ID="lbtnFinanceiro" runat="server" Font-Names="Arial" 
                                    Font-Size="12px" ForeColor="#990000" onclick="lbtnFinanceiro_Click">Financeiro</asp:LinkButton></li>
                            <li><asp:LinkButton ID="lbtnBanner" runat="server" Font-Names="Arial" 
                                    Font-Size="12px" ForeColor="#990000" onclick="lbtnBanner_Click">Banner</asp:LinkButton></li>
                            <li><asp:LinkButton ID="lbtnBonus" runat="server" Font-Names="Arial" 
                                    Font-Size="12px" ForeColor="#990000" onclick="lbtnBonus_Click">Bonus</asp:LinkButton></li>
                            <li><asp:LinkButton ID="lbtnCategoria" runat="server" Font-Names="Arial" 
                                    Font-Size="12px" ForeColor="#990000" onclick="lbtnCategoria_Click">Categoria</asp:LinkButton></li>
                            <li><asp:LinkButton ID="lbtnLinkAnuncio" runat="server" Font-Names="Arial" 
                                    Font-Size="12px" ForeColor="#990000" onclick="lbtnLinkAnuncio_Click" >Link Anuncio</asp:LinkButton></li>
                            <li><asp:LinkButton ID="lbtnLogo" runat="server" Font-Names="Arial" 
                                    Font-Size="12px" ForeColor="#990000" onclick="lbtnLogo_Click" >Logo</asp:LinkButton></li>
                            <li><asp:LinkButton ID="lbtnUsuario" runat="server" Font-Names="Arial" 
                                    Font-Size="12px" ForeColor="#990000" onclick="lbtnUsuario_Click" >Usuário</asp:LinkButton></li>

                                    
                         </ul>
                      </div>
                   
                   </td>
               </tr>
               <tr>
                   <td align="center">
                       <asp:UpdatePanel ID="UpdatePanel1" runat="server">
                       <ContentTemplate>
                      <iframe runat="server" id="ifPrincial" align="middle" frameborder="0" 
                                       height="500px" marginheight="0" marginwidth="0" width="100%" 
                           scrolling="auto">
                      </iframe>         
                      </ContentTemplate>          
                      </asp:UpdatePanel>
                   </td>
               </tr>
               <tr>
                   <td align="center">
                       <asp:UpdateProgress ID="UpdateProgress1" runat="server" 
                           AssociatedUpdatePanelID="UpdatePanel1">
                           <ProgressTemplate>
                               <img alt="" src="imagens/wait.gif" 
    style="width: 50px; height: 50px" />Aguarde...
                           </ProgressTemplate>
                       </asp:UpdateProgress>
                   </td>
               </tr>
               <tr>
                   <td align="center">
                       <asp:Label ID="lblHash" runat="server"></asp:Label>
                   </td>
               </tr>
               </table>
       
       </center>    
    </div>
    </form>
</body>
</html>
