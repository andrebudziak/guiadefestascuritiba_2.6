<%@ Page Language="C#" AutoEventWireup="true" CodeFile="bonus.aspx.cs" Inherits="bonus" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="asp" %>

<%@ Register Assembly="System.Web.Extensions, Version=3.5.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35"
    Namespace="System.Web.UI" TagPrefix="asp" %>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Imprima Seu Bonus - Guia de Festas Curitiba</title>  
    <link href="Styles.css" rel="stylesheet" type="text/css" />    
</head>
<body topmargin="0" leftmargin="00" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"  oncontextmenu="return false;">
<form id="frmBonus" runat="server">
<div align="center">
	
    <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            &nbsp;
        </td>
        <td align="left">
    <img ID="imgBonus" runat="server" src="" />
	<table border="0" width="500" cellspacing="0" cellpadding="0" height="380" 
                class="bonus" >
		<tr>
			<td>
			<table border="0" width="500" cellspacing="0" cellpadding="0" height="380">
				<tr>
					<td>
                     </td>
				</tr>
				<tr>
					<td align="center">
					    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td>
                                </td>
                                <td align="center">
                                    &nbsp;</td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    &nbsp;</td>
                                <td align="center">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 250px;">
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td>
                                                &nbsp;</td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td>
                                                &nbsp;</td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td align="center">
                                                <asp:Label ID="Label4" runat="server" Font-Names="Verdana" Font-Size="10px" 
                                                    Text="Ao contratar os serviços do "></asp:Label>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td align="center">
                                                <asp:Label ID="lblAnunciante" runat="server" Font-Bold="True" 
                                                    Font-Names="Verdana" Font-Size="12px"></asp:Label>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td align="center">
                                                <asp:Label ID="lblEndereco" runat="server" Font-Names="Verdana" 
                                                    Font-Size="10px"></asp:Label>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td align="center">
                                                <asp:TextBox ID="txtCodigoAnunciante" runat="server"></asp:TextBox>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td align="center">
                                                <asp:Label ID="Label6" runat="server" Font-Names="Verdana" Font-Size="10px" 
                                                    Text="apresente este Bônus e conheça as vantagens de ser um cliente do Guia de Festas Curitiba."></asp:Label>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    &nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    &nbsp;</td>
                                <td align="center">
                                    &nbsp;</td>
                                <td>
                                    &nbsp;</td>
                            </tr>
                            <tr>
                                <td >
                                    &nbsp;</td>
                                <td align="center">
                             
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 250px;">
                                        <tr>
                                            <td align="right">
                                                <asp:Label ID="Label1" runat="server" Font-Bold="True" Font-Names="Verdana" 
                                                    Font-Size="11px" Text="Nome"></asp:Label>
                                            </td>
                                            <td>
                                                <asp:TextBox ID="txtNome" runat="server" Width="200px" CssClass="bord-baixa"></asp:TextBox>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="right">
                                                <asp:Label ID="Label2" runat="server" Font-Bold="True" Font-Names="Verdana" 
                                                    Font-Size="11px" Text="E-mail"></asp:Label>
                                            </td>
                                            <td>
                                                <asp:TextBox ID="txtEmail" runat="server" Width="200px" CssClass="bord-baixa"></asp:TextBox>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>                                        
                                            <td align="right">
                                                <asp:Label ID="Label3" runat="server" Font-Bold="True" Font-Names="Verdana" 
                                                    Font-Size="11px" Text="Telefone"></asp:Label>
                                            </td>
                                            <td>
                                                <asp:TextBox ID="txtFone" runat="server" Width="200px" CssClass="bord-baixa"></asp:TextBox>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                    </table>
                                
                                </td>
                                <td>
                                    &nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    &nbsp;</td>
                                <td align="center">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 250px;">
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td align="center">
                                                <asp:Label ID="lblData" runat="server" Font-Names="Verdana" Font-Size="10px"></asp:Label>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td align="center">
                                                <asp:Label ID="Label8" runat="server" Font-Names="Verdana" Font-Size="10px" 
                                                    Text="Bônus válido por 30 dias"></asp:Label>
                                            </td>
                                            <td>
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;</td>
                                            <td align="center">
                                                <asp:Label ID="Label9" runat="server" Font-Names="Verdana" Font-Size="10px" 
                                                    Text="Bônus não acumulativo"></asp:Label>
                                            </td>
                                            <td>
                                            <asp:Label ID="lblImagem" runat="server" Font-Names="Verdana" Font-Size="10px">
                                            </asp:Label>
                                           </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    &nbsp;</td>
                            </tr>
                        </table>
					</td>
				</tr>
				<tr>
					<td>
					    &nbsp;</td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
	
        </td>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
        <td align="center">
            &nbsp;
            <asp:ImageButton ID="btn_imprimir" runat="server" ImageUrl="imagens/imprimir.png" 
               onmouseover="this.src='imagens/imprimir2.png';" 
                onmouseout ="this.src='imagens/imprimir.png';" onclick="btn_imprimir_Click" /> 

        </td>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td >
            &nbsp;
        </td>
        <td >
            &nbsp;
        </td>
        <td >
            &nbsp;
        </td>
    </tr>
</table>	
    </div>

</form>
</body>
</html>
