<%@ page language="C#" autoeventwireup="true" CodeFile="contato.aspx.cs" MasterPageFile="~/Default.master" Inherits="contato" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="asp" %>

<asp:Content ID="HeaderCont" runat="server" ContentPlaceHolderID="HeadContent">
</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  

<asp:UpdatePanel ID="UpdatePanel1" runat="server">
           <ContentTemplate>
           <table border="0" cellpadding="0" cellspacing="0" style="width:100%;" >
              <tr>
                 <td>
                 
                    <p align="justify" style="margin: 0 50px">
						&nbsp;<p align="justify" style="margin-top: 0; margin-bottom: 0">
						<b><font face="Verdana">ENVIAR UMA MENSAGEM</font></b></p>
						<p align="justify" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
							
										<p align="justify" style="margin-top: 0; margin-bottom: 0">
										<b><font face="Verdana">Dados de contato</font></b></p>   
                                        
                                        <br>              
                                        <br>              
                                        <br>              
                                        <br>              
                 </td>
              </tr>
               <tr>
                   <td>
                       <asp:Label ID="Label2" runat="server" Text="Nome" Font-Names="Verdana" 
                           Font-Size="11px"></asp:Label>
                   </td>
                   <td align="left">
                       <asp:TextBox ID="txtNome" runat="server" Width="300px"></asp:TextBox>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       <asp:Label ID="Label3" runat="server" Text="E-mail" Font-Names="Verdana" 
                           Font-Size="11px"></asp:Label>
                   </td>
                   <td align="left">
                       <asp:TextBox ID="txtEmail" runat="server" Width="300px"></asp:TextBox>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       <asp:Label ID="Label4" runat="server" Text="Telefone" Font-Names="Verdana" 
                           Font-Size="11px"></asp:Label>
                   </td>
                   <td align="left">
                       <asp:TextBox ID="txtFone" runat="server" Width="300px"></asp:TextBox>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       <asp:Label ID="Label5" runat="server" Text="Cidade" Font-Names="Verdana" 
                           Font-Size="11px"></asp:Label>
                   </td>
                   <td align="left">
                       <asp:TextBox ID="txtCidade" runat="server" Width="300px"></asp:TextBox>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       <asp:Label ID="Label6" runat="server" Text="Assunto" Font-Names="Verdana" 
                           Font-Size="11px"></asp:Label>
                   </td>
                   <td align="left">
                       <asp:TextBox ID="txtAssunto" runat="server" Width="300px"></asp:TextBox>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       <asp:Label ID="Label7" runat="server" Text="Informaçoes" Font-Names="Verdana" 
                           Font-Size="11px"></asp:Label>
                   </td>
                   <td align="left">
                       <asp:TextBox ID="txtInformacoes" runat="server" Height="100px" 
                           TextMode="MultiLine" Width="300px"></asp:TextBox>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td align="center" colspan="3">
                       &nbsp;</td>
               </tr>
               <tr>
                   <td align="center" colspan="3">
                       <asp:ImageButton ID="btnEnviar" runat="server" ImageUrl="~/imagens/ENVIAR.png" 
                           onclick="btnEnviar_Click" />
                       <asp:ImageButton ID="btnLimpar" runat="server" ImageUrl="~/imagens/LIMPAR.png" 
                           onclick="btnLimpar_Click" />
                   </td>
               </tr>
           </table>        
           </ContentTemplate>
          </asp:UpdatePanel>               

</asp:Content>