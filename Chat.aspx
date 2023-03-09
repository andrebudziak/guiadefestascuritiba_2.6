<%@ Page Language="C#" AutoEventWireup="true" CodeFile="Chat.aspx.cs" Inherits="Chat" %>
<%@ Import Namespace="eChat" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>eChat Guia de Festas Curitiba</title>
    <link href="Styles.css" rel="stylesheet" type="text/css" />
</head>
<body onunload="Leave()">   
    <form id="form1" runat="server">
       <input id="hdnRoomID" type="hidden" name="hdnRoomID" runat="server"/>
        <asp:ScriptManager ID="ScriptManager1" runat="server"  EnablePartialRendering="True" EnablePageMethods="True">
            <Scripts>
                <asp:ScriptReference Path="scripts.js" />
            </Scripts>
        </asp:ScriptManager>
        
        <center>

<asp:UpdatePanel ID="UpdatePanel1" runat="server">
<ContentTemplate>
               <table border="0" cellpadding="0" cellspacing="0" style="width:800px;">
                   <tr>
                       <td align="left">
                           <asp:Label ID="Label4" runat="server" CssClass="TextoCinzaMedio" 
                               Text="Bem Vindo(a):"></asp:Label>
                           <asp:Label ID="lblUserName" runat="server" CssClass="TextoCinzaMedio" 
                               Text=""></asp:Label>
                           <asp:Label ID="lblPara" runat="server" CssClass="TextoCinzaMedio" 
                               Text=""></asp:Label>
                       </td>
                       <td>
                           &nbsp;</td>
                       <td>
                           &nbsp;</td>
                   </tr>
                   <tr>
                       <td align="left">                            
                          <asp:textbox runat="server" TextMode="MultiLine" id="txt" style="WIDTH: 690px; HEIGHT: 500px" rows="16" Columns="79" ></asp:textbox>                       
                       </td>
                       <td>
                           &nbsp;</td>
                       <td>
                            
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                               <tr>
                                  <td align="center">
                                      <asp:Label ID="Label1" runat="server" CssClass="TextoCinzaMedio" 
                                          Text="Anunciantes"></asp:Label>
                                  </td>
                               </tr>
                                <tr>                                                                    
                                    <td align="center">
                                        <asp:Panel ID="pnClientes" runat="server" Width="200px" Height="200px" ScrollBars="Auto">
                                        <asp:DataList ID="ddlClientes" runat="server" Width="100%" 
                                                onitemdatabound="ddlClientes_ItemDataBound1"  >
                                        <ItemTemplate>
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                                <tr>
                                                    <td align="left">
                                                       <img runat="server" id="imgStatus" border="0" src="~/imagens/online.png" />
                                                    </td>
                                                    <td align="left">
                                                       <asp:HyperLink ID="aCliente" runat="server" Target="_blank" ControlStyle-Font-Overline="false" CssClass="label_chat">
                                                          <asp:Label ID="lblCliente" CssClass="label_chat" runat="server" Text=<%# Eval("nome_fantasia") %>  ></asp:Label>
                                                       </asp:HyperLink>
                                                    </td>
                                                </tr>
                                            </table>                                       
                                        </ItemTemplate>
                                        </asp:DataList>
                                        </asp:Panel>
                                    </td>                                   
                                </tr>
                               <tr>
                                  <td align="center">
                                      <asp:Label ID="Label2" runat="server" CssClass="TextoCinzaMedio" 
                                          Text="Usuários"></asp:Label>
                                  </td>
                               </tr>
                                <tr>                                    
                                    <td align="center">                            
                                       <asp:Panel ID="pnUsuarios" runat="server" Width="200px" Height="200px" ScrollBars="Auto">
                                          <asp:ListBox runat="server" Width="200px" ID="lstMembers" Enabled="false" Height="200px" CssClass="edit"></asp:ListBox>
                                       </asp:Panel>
                                    </td>
                                   
                                </tr>
                                <tr>
                                    
                                    <td align="center">
                            
                                        &nbsp;</td>
                                   
                                </tr>
                            </table>
                    
                       </td>
                   </tr>
                   <tr>
                       <td align="left" colspan="3">
                          <asp:Panel ID="Panel1" runat="server" >
                           <table border="0" cellpadding="0" cellspacing="0" style="width:800px;">
                               <tr>
                                   <td align="left">
                                      <asp:Label ID="Label3" runat="server" CssClass="TituloAzulEscuro" 
                                          Text="Falar com:"></asp:Label>
                                       <asp:DropDownList ID="dlFalar" CssClass="falar_com" runat="server" 
                                           Width="180px" DataTextField="nome_fantasia" DataValueField="codigo" 
                                           onselectedindexchanged="dlFalar_SelectedIndexChanged">
                                       </asp:DropDownList>
                                   </td>
                                   <td>
                                       <asp:TextBox id="txtMsg" Width="300px" Runat="server" CssClass="edit"></asp:TextBox> 
                                          <input id="btn" onclick="button_clicked()" type="button" value="Enviar" class="BotaoSubmit"/>
                                       </td> 
                                   <td>
                                     
                                       <asp:Label ID="lblStatus" runat="server" CssClass="TituloAzulEscuro" 
                                           Text="Status:"></asp:Label>
                                       <asp:DropDownList ID="dlStatus" runat="server" CssClass="falar_com" 
                                           Width="100px" AutoPostBack="True" 
                                           onselectedindexchanged="dlStatus_SelectedIndexChanged">
                                       <asp:ListItem Text="Online" Value="1"></asp:ListItem>
                                       <asp:ListItem Text="Ausente" Value="2"></asp:ListItem>
                                       <asp:ListItem Text="Ocupado" Value="3"></asp:ListItem>
                                       </asp:DropDownList>
                                     
                                   </td>
                               </tr>
                               </table>
                          </asp:Panel>                               
                       </td>
                       
                   </tr>
               </table>
       
</ContentTemplate>
</asp:UpdatePanel>

        </center>

        
    </form>
</body>
</html>
