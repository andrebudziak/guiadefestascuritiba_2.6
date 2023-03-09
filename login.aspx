<%@ Page Language="C#" AutoEventWireup="true"  CodeFile="login.aspx.cs" Inherits="_login" %>

<%@ Register Assembly="System.Web.Extensions, Version=3.5.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35"
    Namespace="System.Web.UI" TagPrefix="asp" %>


<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="cc1" %>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="Styles.css" rel="stylesheet" type="text/css" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title>Guia de Festas Curitiba</title>
</head>
<body
   <div align="center">
      <center> 
         <form id="frmCategoria" runat="server" >
      
         <table border="0" cellpadding="0" cellspacing="0" width="100%">
       <tr>
          <td align="center" height="200px">
          </td>
       </tr>
       <tr>
          <td>
         
        
          
          </td>
       </tr>
       <tr>
          <td align="center">
         <asp:UpdatePanel ID="UpdatePanel1" runat="server">
         <ContentTemplate>         
         <asp:Panel ID="pnLogin" runat="server" Width="520px" BackColor="Maroon" 
                 Height="100px">
             <table style="width:100%;">
                 <tr>
                     <td>
                         &nbsp;</td>
                     <td align="left">
                         &nbsp;</td>
                     <td>
                         &nbsp;</td>
                     <td align="left">
                         &nbsp;</td>
                 </tr>
                 <tr>
                     <td>
                         <asp:Label ID="Label1" runat="server" Font-Names="Verdana" Font-Size="12px" 
                             ForeColor="White" Text="Usuario:"></asp:Label>
                     </td>
                     <td align="left">
                         <asp:TextBox ID="tedUsuario" runat="server" 
                             style="font-size: 12px; color: #0099ff; font-family: Verdana;" Width="150px"></asp:TextBox>
                     </td>
                     <td>
                         <asp:Label ID="Label2" runat="server" Font-Names="Verdana" Font-Size="12px" 
                             ForeColor="White" Text="Senha:"></asp:Label>
                     </td>
                     <td align="left">
                         <asp:TextBox ID="tedSenha" runat="server" 
                             style="font-size: 12px; color: #ff0000; font-family: Verdana;" 
                             TextMode="Password" Width="150px"></asp:TextBox>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         &nbsp;</td>
                     <td align="left">
                         &nbsp;</td>
                     <td>
                         &nbsp;</td>
                     <td align="left">
                         &nbsp;</td>
                 </tr>
                 <tr>
                     <td align="center" colspan="4">
                         <asp:ImageButton ID="btnLogin_Click" runat="server" ImageUrl="~/imagens/Ok.gif" 
                             onclick="btnLogin_Click_Click" />
                     </td>
               
                 </tr>
             </table>
         
         </asp:Panel>
             <cc1:RoundedCornersExtender ID="pnLogin_RoundedCornersExtender" runat="server" 
                 Enabled="True" TargetControlID="pnLogin">
             </cc1:RoundedCornersExtender>
         </ContentTemplate>
         </asp:UpdatePanel>
           </td>
       </tr>
       <tr>
          <td align="center">
              <asp:UpdateProgress ID="UpdateProgress1" runat="server" 
                  AssociatedUpdatePanelID="UpdatePanel1">
                  <ProgressTemplate>
                      <img alt="" src="imagens/wait.gif" />Aguarde...
                  </ProgressTemplate>
              </asp:UpdateProgress>
          </td>
       </tr>
    </table>    
    <table>
       <asp:Panel ID="pnPublicidadeTopo" runat="server">
          <tr>
          </tr>
       </asp:Panel>
    </table>
   
         <table>
            <tr>
                <td align="center" class="TextoCinzaEscuro2" height="25">
                    &nbsp;</td>
            </tr>
        </table>
       
   </form>
      </center>
   </div>
</body>
</html>
