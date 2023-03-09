<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Oferta.master" CodeFile="detalhe_oferta.aspx.cs" Inherits="detalhe_oferta" %>

<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="cc1" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">  
</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  
    <asp:UpdatePanel ID="UpdatePanel1" UpdateMode="Conditional" runat="server">
    <ContentTemplate>


    <table border="0" width="800" cellspacing="0" cellpadding="0" height="78">
       <tr>
          <td width="800" valign="top"><font size="1">
             <asp:Image ID="imgTopoOfDet" runat="server" border="0" ImageUrl="imagens/barraOFERTA.jpg" width="783" height="66"></asp:Image>	         
             </font>
          </td>
       </tr>
    </table>

    <asp:DataList ID="ddlOferta" runat="server" Width="800px" onitemdatabound="ddlOferta_ItemDataBound" >
    <ItemTemplate>
            <table border="0" width="785" cellspacing="0" cellpadding="0" height="190">
			<tr>
				<td width="547">
				<p style="margin-top: 0; margin-bottom: 5px">
                   <asp:Image ID="imgOferta" runat="server" width="530" height="399" border="0" />				
                </td>
				<td width="238" align="left">
				<table border="0" width="238" cellspacing="0" cellpadding="0" height="293">
					<tr>
						<td>
						<p style="margin-top: 0; margin-bottom: 0">
						<b>
						<font face="Tahoma" color="#FF3300" style="text-decoration: line-through" size="5">
						<asp:Label ID="lblDe" runat="server" Text='<%# Eval("de") %>'></asp:Label></font></b>
                        </td>
					</tr>
					<tr>
						<td>
						<p style="margin-top: 0; margin-bottom: 0">
						<b>
						<font face="Tahoma" color="#000080" size="5">
						Por </font></b></p>
						<p style="margin-top: 0; margin-bottom: 0">
						<b>
						<font face="Tahoma" color="#000080" size="7">
						<asp:Label ID="lblPor" runat="server" Text='<%# Eval("por") %>'></asp:Label> </font></b>
                        </td>
					</tr>
					<tr>
						<td>
						<p style="margin-top: 0; margin-bottom: 0">
						<b>
						<font face="Tahoma" color="#000080" size="5">
						Desconto</font></b></p>
						<p style="margin-top: 0; margin-bottom: 0">
						<b>
						<font face="Tahoma" color="#000080" size="5">
						<asp:Label ID="lblDesconto" runat="server" Text='<%# Eval("desconto") %>'></asp:Label></font></b>
                        </td>
					</tr>
					<tr>
						<td>
						<p style="margin-top: 0; margin-bottom: 0">
						<b>
						<font face="Tahoma" color="#000080" size="5">
						Economia</font></b></p>
						<p style="margin-top: 0; margin-bottom: 0">
						<b>
						<font face="Tahoma" color="#000080" size="5">
						<asp:Label ID="lblEconomia" runat="server" Text='<%# Eval("economia") %>'></asp:Label></font></b>
                        </td>
					</tr>
				</table>
				</td>
			</tr>
		</table>

        <table border="0" width="800" cellspacing="0" cellpadding="0" height="295">
			<tr>
				<td width="785" valign="top" align="left">
                   <asp:Label ID="lblTexto" runat="server" Text='<%# Eval("texto") %>'></asp:Label>
                </td>
			</tr>
		</table>

    </ItemTemplate>
    </asp:DataList>

    </ContentTemplate>
    </asp:UpdatePanel>

</asp:Content>
