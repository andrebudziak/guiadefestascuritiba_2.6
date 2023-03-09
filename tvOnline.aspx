<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/TvOnline.master" CodeFile="tvOnline.aspx.cs" Inherits="tvOnline" %>
<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="cc1" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">  
</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  

    <asp:UpdatePanel ID="upPlayerTv" UpdateMode="Conditional" runat="server">
    <ContentTemplate>
				<div align="center">
                    <table border="0" cellspacing="0" cellpadding="0" height="205">
					<tr>
						<td>
						<p align="center">
						<asp:LinkButton id="lnkAnterior" runat="server" CssClass="navega" onclick="lnkAnterior_Click">
                            <asp:Image ID="imgPlayDir" runat="server" border="0" width="70" height="70" ImageUrl="imagens/play_dir.png" />
                        </asp:LinkButton>
                        </td>
						<td width="650">
                            <p>
                                <table border="0" width="650" cellspacing="0" cellpadding="0" height="190">
								<tr>
                                <td align="center" valign="top">
                                    <asp:DataList ID="dlVideoGrande" runat="server"  
                                        RepeatDirection="Horizontal"          
                                        onitemdatabound="dlVideoGrande_ItemDataBound"          
                                        CellSpacing="5">
                                        <ItemTemplate>
                                                <asp:Label ID="lblArquivo" Visible="false" runat="server" Text=""></asp:Label>
                                                <asp:Label ID="lblVisualiza" runat="server" Text=""></asp:Label>
                                        </ItemTemplate>
                                    </asp:DataList>
                                </td>
								</tr>
							</table>

                            </p>

                               
	                    </td>
						<td >
						<p align="center">
                        <asp:LinkButton id="lnkProximo" runat="server" CssClass="navega"  onclick="lnkProximo_Click">
                            <asp:Image ID="imgPlayEsq" runat="server" border="0" width="70" height="70" ImageUrl="imagens/play_esq.png" />
                        </asp:LinkButton>
                                            
                        </td>
					</tr>
				</table>

				</div>

    </ContentTemplate>
    </asp:UpdatePanel>

    <asp:UpdatePanel ID="upTvOnline" UpdateMode="Conditional" runat="server">
    <ContentTemplate>



                <asp:DataList ID="dlVideo" runat="server"  
                    RepeatDirection="Horizontal" 
                    RepeatColumns="4"   
                    CellSpacing="5"                         
                    onitemdatabound="dlVideo_ItemDataBound"
                    onitemcommand="dlVideo_ItemCommand">
                    <ItemTemplate>
					    <table border="0" width="190" cellspacing="0" cellpadding="0">
						    <tr>
							    <td width="190" height="115">
                                    <asp:LinkButton CssClass="link_fonesite" ID="aBanner" CommandArgument='<%# Eval("codigo") %>' Text="" runat="server" CommandName="MostraVideo" >
                                        <asp:Image ID="imgVideo" runat="server" width="193" height="153" />
                                    </asp:LinkButton>                                                
                                </td>
						    </tr>
						    <tr>
							    <td width="190">
			                       <font face="Verdana">
                                      <asp:Label ID="lblTitulo" Font-Names="Verdana" Font-weight="700" Font-Size="12px" runat="server">
                                      </asp:Label>
                                   </font>
							    </td>
						    </tr>
						    <tr>
							    <td width="190" height="20">
                                   <font face="Verdana" color="#666666" style="font-size: 9pt">
                                      <asp:Label ID="lblDescricao" Font-Names="Verdana" Font-weight="700" Font-Size="12px" runat="server">
                                      </asp:Label>
                                   </font>
                                </td>
						    </tr>
						    <tr>
							    <td height="50">
                                </td>
						    </tr>

					    </table>


                    </ItemTemplate>
                </asp:DataList>



    </ContentTemplate>
    </asp:UpdatePanel>
    <asp:UpdateProgress ID="UpdateProgress2" runat="server" 
        AssociatedUpdatePanelID="upVideo">
        <ProgressTemplate>
           <div class="overlay" />
            <div class="overlayContent">
                <h2>Aguarde...</h2>
                <asp:Image CssClass="aguarde" ID="imgAguarde" ImageUrl='<% Page.ResolveUrl("~/imagens/wait.gif") %>' runat="server" />
            </div>
            
        </ProgressTemplate>
    </asp:UpdateProgress>
</asp:Content>

