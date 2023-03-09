<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Oferta.master" CodeFile="oferta.aspx.cs" Inherits="oferta" %>

<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="cc1" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">  
</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  

    <asp:UpdatePanel ID="UpdatePanel1" UpdateMode="Conditional" runat="server">
    <ContentTemplate>

    <table border="0" width="800" cellspacing="0" cellpadding="0" height="78">
       <tr>
          <td width="800" valign="top"><font size="1">
	         <img border="0" src="imagens/barraOFERTA.jpg" width="783" height="66"></font>
          </td>
       </tr>
    </table>
        <table class="tblBarraCentralCategoria" style="width:570px;" background="imagens/barra_central_categoria.png">
            <tr>
                <td align="left">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b>
					<font face="Verdana" size="2" color="#666666">
					<asp:Label ID="lblTituloCat" runat="server" ></asp:Label>
                    </font>
                    </b>        
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                </td>
                <td>
                </td>
                <td align="right">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <asp:DropDownList ID="ddlFiltro" runat="server" Width="200px" 
                    AutoPostBack="True" Font-Names="Verdana" Font-Size="12px" ForeColor="#666666" 
                    onselectedindexchanged="ddlFiltro_SelectedIndexChanged" 
                    style="border-left-color: White; border-bottom-color: White; border-top-style: outset; border-top-color: White; border-right-style: outset; border-left-style: outset; border-right-color: White; border-bottom-style: outset">
                    <asp:ListItem Value="0">Ordenar por:</asp:ListItem>
                    <asp:ListItem Value="por DESC">Maior Preço</asp:ListItem>
                    <asp:ListItem Value="por ASC">Menor Preço</asp:ListItem>
                    </asp:DropDownList>      

                    
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            
                </td>
            </tr>
        </table>



    <asp:DataList ID="ddlOferta" runat="server" Width="800" 
        onitemdatabound="ddlOferta_ItemDataBound" RepeatDirection="Horizontal" 
        RepeatColumns="2" onitemcommand="ddlOferta_ItemCommand">
    <ItemTemplate>
        <table>
            <tr>
            <td width="375" valign="top" align="left">
				<p style="margin-top: 0; margin-bottom: 5px">
				<font face="Tahoma" size="5"><b><asp:Label ID="lblTitulo" runat="server" Text='<%# Eval("desconto") %>'></asp:Label> de Desconto</b></font></p>
				<p style="margin-top: 0; margin-bottom: 5px">
				<font face="Tahoma"> <asp:Label ID="lblDescricao" runat="server" Text='<%# Eval("descricao") %>'></asp:Label></font></p>
				<table border="0" width="375" cellspacing="0" cellpadding="0" height="190">
					<tr>
						<td width="265">
						<p style="margin-top: 0; margin-bottom: 5px">
                           <asp:ImageButton border="0" ID="btnImgMiniatura" CommandArgument='<%# Eval("codigo") %>' CommandName="Visualizar" runat="server" width="250" height="188"  />
                        </td>
						<td width="110">
						<table border="0" width="110" cellspacing="0" cellpadding="0" height="190">
							<tr>
								<td height="47">
								<p style="margin-top: 0; margin-bottom: 0">
								<b>
								<font face="Tahoma" color="#FF3300" style="text-decoration: line-through" size="2">
                                De
								<asp:Label ID="lblDe" runat="server" Text='<%# Eval("de") %>'></asp:Label></font></b>
                                </td>
							</tr>
							<tr>
								<td height="47">
								<p style="margin-top: 0; margin-bottom: 0">
								<b>
								<font face="Tahoma" color="#000080" style="font-size: 11pt">
								Por </font></b></p>
								<p style="margin-top: 0; margin-bottom: 0">
								<b>
								<font face="Tahoma" color="#000080" style="font-size: 17pt">
								<asp:Label ID="lblPor" runat="server" Text='<%# Eval("por") %>'></asp:Label></font></b>
                                </td>
							</tr>
							<tr>
								<td height="47">
								<p style="margin-top: 0; margin-bottom: 0">
								<b>
								<font face="Tahoma" color="#000080" style="font-size: 11pt">
								Desconto</font></b></p>
								<p style="margin-top: 0; margin-bottom: 0">
								<b>
								<font face="Tahoma" color="#000080" style="font-size: 11pt">
								<asp:Label ID="lblDesconto" runat="server" Text='<%# Eval("desconto") %>'></asp:Label></font></b>
                                </td>
							</tr>
							<tr>
								<td height="47">
								<p style="margin-top: 0; margin-bottom: 0">
								<b>
								<font face="Tahoma" color="#000080" style="font-size: 11pt">
								Economia</font></b></p>
								<p style="margin-top: 0; margin-bottom: 0">
								<b>
								<font face="Tahoma" color="#000080" style="font-size: 11pt">
								<asp:Label ID="lblEconomia" runat="server" Text='<%# Eval("economia") %>'></asp:Label></font></b></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td style="height:35px;">
						<p style="margin-top: 0; margin-bottom: 0" align="left">
						<b>
						<font size="2" face="Tahoma" color="#666666">Validade: <asp:Label ID="lblValidade" runat="server" Text='<%# Eval("validade") %>'></asp:Label></font></b>
                        </td>
						<td width="184">
						<p align="right">
						<asp:LinkButton ID="LinkButton1" runat="server" CommandName="Visualizar" CommandArgument='<%# Eval("codigo") %>' Target="_self">
                           <asp:Image ID="imgConferir" runat="server" width="178" height="35" border="0" />												
                        </asp:LinkButton>
                        </td>
					</tr>
				</table>
			</td>                                 
                                 
            </tr>
        </table>                                                              
                               
    </ItemTemplate>
    </asp:DataList>

    </ContentTemplate>
    </asp:UpdatePanel>

</asp:Content>