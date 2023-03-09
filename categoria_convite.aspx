<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Convite.master" CodeFile="categoria_convite.aspx.cs" Inherits="categoria_convite" %>

<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="cc1" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">  
</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  

    <asp:UpdatePanel ID="UpdatePanel1" UpdateMode="Conditional" runat="server">
    <ContentTemplate>
    


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
                    <asp:ListItem Value="nome_fantasia">NOME</asp:ListItem>
                    <asp:ListItem Value="bairro">BAIRRO</asp:ListItem>
                    </asp:DropDownList>      
                    
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            
                </td>
            </tr>
        </table>
        <asp:ImageButton ID="imgSemDados" ImageUrl="imagens/semclientes.png" runat="server" />
    <asp:DataList ID="dlAnunciante" runat="server" ShowFooter="False" 
        ShowHeader="False" onitemdatabound="dlAnunciante_ItemDataBound" Width="570px" 
        BorderWidth="0px" CellPadding="0" onitemcommand="dlAnunciante_ItemCommand">
        <AlternatingItemStyle Font-Bold="False" Font-Italic="False" 
            Font-Overline="False" Font-Strikeout="False" Font-Underline="False" />
        <ItemTemplate>
            
            <div>
            <span itemprop="offerDetails">

			<table border="0" class="tblpontosCategoria" width="570" cellspacing="0" cellpadding="0" background="layout/pontilhado_categoria.png">
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
                                 
            <table border="0" width="570" cellspacing="0" cellpadding="0" height="169">
				<tr>
					<td width="347" height="169" valign="top" align="left">					
                        <asp:Image ID="imgFoto" runat="server" width="340" height="230" border="0"  />
                    </td>
					<td width="223" height="169" valign="top" align="left">
					<p style="margin-top: 0; margin-bottom: 3px">
                    <asp:HyperLink ID="aLogo" runat="server" Target="_blank" > 
                        <asp:ImageButton border="0" ID="btnImgLogo" CommandName="ContaClick" runat="server" Width="136px" Height="136px"  />
                    </asp:HyperLink>								                        
                    </p>
					<table border="0" width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td>
							<p style="margin-top: 0; margin-bottom: 3px"><b>
							<font face="Verdana" color="#666666" size="1">
                                <asp:Label ID="lblCodigoAnuncio" runat="server" Text="" Visible="false"></asp:Label>
                                <asp:Label ID="lblNomeFantasia" runat="server" Text=""></asp:Label>
                            </font></b></td>
						</tr>
						<tr>
							<td>
							<p style="margin-top: 0; margin-bottom: 3px"><b>
							<font face="Verdana" size="1" color="#666666">
							<asp:Label ID="lblDescricao" runat="server" Text=""></asp:Label>
                            </font></b></td>
						</tr>
						<tr>
							<td>
							<p style="margin-top: 0; margin-bottom: 3px">
							<font face="Verdana" size="1" color="#666666">
							<asp:Label ID="lblEndereco" runat="server" Text=""></asp:Label>
                            </font></td>
						</tr>
						<tr>
							<td>
							<p style="margin-top: 0; margin-bottom: 3px">
							<font face="Verdana" size="1" color="#666666">
							<asp:Label ID="lblBairroCidade" runat="server" Text=""></asp:Label>
                            </font></td>
						</tr>
						<tr>
							<td>
							<p style="margin-top: 0; margin-bottom: 3px">
							   <b>
								<font face="Verdana" color="#666666" size="1">
                                   <asp:Label ID="lblTelefone" runat="server" Text=""></asp:Label>
                                </font>
                               </b>
                            </td>
						</tr>
						<tr>
							<td>
							<p style="margin-top: 0; margin-bottom: 3px"><b>
							<font face="Verdana" size="1" color="#A2A2A2">
                            <asp:HyperLink CssClass="link_fonesite" Width="25px" ID="aSite" runat="server" Target="_blank" >site</asp:HyperLink>
                            <asp:Label ID="Label1" CssClass="link_fonesite" Width="4px" runat="server" Text="|"></asp:Label>
                            <asp:HyperLink CssClass="link_fonesite" ID="aEmail" Width="45px" runat="server" >e-mail</asp:HyperLink>
                            <asp:Label ID="Label2" CssClass="link_fonesite" Width="4px" runat="server" Text="|"></asp:Label>
                            <asp:Button ID="btnFAKE" runat="server" Text="Fake Button" style="display: none;" /> 
                            <asp:LinkButton CssClass="link_fonesite" ID="aMapa" Width="18px" Text="mapa" runat="server" CommandName="MostraMapa" />                           
                            <cc1:ModalPopupExtender ID="btnMapaCategoria_ModalPopupExtender" 
                            runat="server" BackgroundCssClass="ModalPopupBG" CancelControlID="btnFechar" 
                            Drag="True" DynamicServicePath="" Enabled="True" OnOkScript="onOk()" 
                            PopupControlID="pnAnuncioCategoria" TargetControlID="btnFAKE">
                            </cc1:ModalPopupExtender>
                            
                            </font></b></td>
						</tr>
					</table>
					</td>
				</tr>
			</table>                                 
            </span>
            </div>                                        
                                       
        </ItemTemplate>
    </asp:DataList>
 
        <asp:Panel ID="pnAnuncioCategoria" runat="server" BackColor="White" Height="600px" Width="800px">
            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                <tr>
                    <td>
                        &nbsp;</td>
                    <td>
                        &nbsp;</td>
                    <td align="right">
                        <asp:ImageButton ID="btnFechar" runat="server" 
                            ImageUrl="~/imagens/close.png" />
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="3">
                        <iframe ID="ifCategoriaAnuncio" runat="server" align="middle" frameborder="0" 
                            height="570px" marginheight="0" marginwidth="0" scrolling="auto" 
                            width="780px">
                        </iframe>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;</td>
                    <td>
                        &nbsp;</td>
                    <td>
                        &nbsp;</td>
                </tr>
            </table>
        </asp:Panel>                   
    
    <cc1:RoundedCornersExtender ID="pnAnuncioCategoria_RoundedCornersExtender" 
        runat="server" Color="ActiveBorder" Enabled="True" 
        TargetControlID="pnAnuncioCategoria">
    </cc1:RoundedCornersExtender>
    

    </ContentTemplate>
    </asp:UpdatePanel>
    <asp:UpdateProgress ID="UpdateProgress2" runat="server" 
        AssociatedUpdatePanelID="UpdatePanel1">
        <ProgressTemplate>
           <div class="overlay" />
            <div class="overlayContent">
                <h2>Aguarde...</h2>
                <asp:Image CssClass="aguarde" ID="imgAguarde" ImageUrl='<% Page.ResolveUrl("~/imagens/wait.gif") %>' runat="server" />
            </div>
            
        </ProgressTemplate>
    </asp:UpdateProgress>





</asp:Content>