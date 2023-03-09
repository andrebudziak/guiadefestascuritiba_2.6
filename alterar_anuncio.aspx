<%@ Page Language="C#" AutoEventWireup="true" CodeFile="alterar_anuncio.aspx.cs" MasterPageFile="~/Default.master" Inherits="alterar_anuncio" %>

<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="cc1" %>

<asp:Content ID="HeaderCont" runat="server" ContentPlaceHolderID="HeadContent">
    <script src="Scripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript">

    function startUpload(sender, args) {
        $('#uploadMessage p').html();
        $('#uploadMessage').hide();
    }

    function uploadComplete(sender, args) {
        showUploadMessage(" Concluido Upload de - " + args.get_fileName() + " - Tamanho - " + args.get_length() + " bytes", '');
        $('#<%= txtArquivo.ClientID %>').val(args.get_fileName());

    }

    function uploadError(sender, args) {
        showUploadMessage("Erro ao realizar upload. " + args.get_errorMessage(), '#ff0000');
    }

    function showUploadMessage(text, color) {
        $('#uploadMessage p').html(text).css('color', color);
        $('#uploadMessage').show();
    }
    
</script>

</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  

                    <table border="0" cellspacing="0" cellpadding="0" >
					<tr>
						<td valign="top">
						<p align="justify" style="margin: 0 50px">
						&nbsp;<p align="justify" style="margin-top: 0; margin-bottom: 0">
						<b><font face="Verdana">ALTERAÇÕES DE ANUNCIO</font></b><p align="justify" style="margin-top: 0; margin-bottom: 0">
						&nbsp;<div align="center">
							<blockquote>
								<blockquote>
									<blockquote>
										<p align="justify" style="margin-top: 0; margin-bottom: 0">
										<b><font face="Verdana">Dados do 
										anunciante</font></b></p>
									</blockquote>
								</blockquote>
							</blockquote>
							<table border="0"  cellspacing="0" cellpadding="0">
								<tr>
									<td width="150" height="25">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2">Nome da 
									Empresa</font></td>
									<td width="450" height="25">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana">
									   <asp:TextBox ID="txtEmpresa" Width="200px" runat="server"></asp:TextBox>
                                    </font></td>
								</tr>
								<tr>
									<td width="150" height="25">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2">Responsável</font></td>
									<td width="450" height="25">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana">
									   <asp:TextBox ID="txtResposanvel" Width="200px" runat="server"></asp:TextBox>
                                    </font></td>
								</tr>
								<tr>
									<td width="150" height="25" align="left">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2">Código de 
									cliente</font></td>
									<td width="450" height="25">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana">
									   <asp:TextBox ID="txtCodigoCliente" Width="50px" runat="server"></asp:TextBox>
                                    </font></td>
								</tr>
								<tr>
									<td width="150" height="25">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2">Telefone</font></td>
									<td width="450" height="25">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana">
									   <asp:TextBox ID="txtTelefone" Width="200px" runat="server"></asp:TextBox>
                                    </font></td>
								</tr>
							</table>
							<table border="0"  cellspacing="0" cellpadding="0">
								<tr>
									<td width="150" height="25">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2">E-mail</font></td>
									<td width="450" height="25">
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana">
									   <asp:TextBox ID="txtEmail" Width="200px" runat="server"></asp:TextBox>
                                    </font></td>
								</tr>
								</table>
							<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
							<blockquote>
								<blockquote>
									<blockquote>
										<p align="justify" style="margin-top: 0; margin-bottom: 0">
										<b><font face="Verdana">Tipo de Anuncio 
										a ser alterado</font></b></p>
							<table border="0"  cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" height="25">
									<p style="margin-top: 0; margin-bottom: 0">                                        
									<font face="Verdana" size="2"><asp:CheckBox ID="ckDadosCadastro" Text="Dados de Cadastro" runat="server" /></font>
                                    <p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckDadosAnuncio" Text="Dados do Anuncio Classificado" runat="server" />
									</font>
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckDadosOferta" Text="Dados do Anuncio Clube de Ofertas" runat="server" /></font>
                                    <p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckDadosTV" Text="Dados do Anuncio TV Online" runat="server" /></font>
                                    <p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckDadosTema" Text="Dados do Anuncio Classificado Vitrine Tema" runat="server" />
									Infantil</font><p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckDadosConvite" Text="Dados do Anuncio Classificado Vitrine Convite/Lembrancinhas" runat="server" /></font>
                                    <p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckBannerPublicidade" Text="Dados de Banner Publicidade" runat="server" /></font>
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckBannerTopo" Text="Dados de Banner Topo" runat="server" /></font>
									<p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckBannerCentral" Text="Dados de Banner Central" runat="server" /></font>
                                    <p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckMateriaHome" Text="Dados de Matéria Home" runat="server" /></font>
                                    <p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckMateriaTema" Text="Dados de Matéria Vitrine Tema Infantil" runat="server" /></font>
                                    <p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckMateriaConvite" Text="Dados de Materia Vitrine Convite/Lembrancinhas" runat="server" /></font>
                                    <p style="margin-top: 0; margin-bottom: 0">
									<font face="Verdana" size="2"><asp:CheckBox ID="ckHotSite" Text="Dados de Hot Site" runat="server" /></font>
                                    </td>
								</tr>
							</table>
									</blockquote>
								</blockquote>
							</blockquote>
							<div align="center">
								<table border="0"  cellspacing="0" cellpadding="0">
									<tr>
										<td width="150" height="25" valign="top">
										<p style="margin-top: 0; margin-bottom: 0">
										<b>
										<font face="Verdana" size="2">Relatar 
										Alteração</font></b></td>
										<td width="450" height="25">
										<p style="margin-top: 0; margin-bottom: 0">
										<asp:TextBox ID="txtAlteracao" Width="200px" Height="100px" TextMode="MultiLine" runat="server"></asp:TextBox>
                                        </td>
									</tr>
								</table>
								<div align="center">
									<div align="center">
										<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
										<blockquote>
											<blockquote>
												<blockquote>
													<p align="justify" style="margin-top: 0; margin-bottom: 0">
													<b><font face="Verdana">
													Enviar Fotos</font></b></p>
												</blockquote>
											</blockquote>
										</blockquote>
										<div align="center">
											<table border="0"  cellspacing="0" cellpadding="0">
												<tr>
													<td width="150" height="25" valign="top">
													<p style="margin-top: 0; margin-bottom: 0">
													<font face="Verdana" size="2">
													Arquivo 01</font></td>
													<td width="450" height="25">
													<p style="margin-top: 0; margin-bottom: 0">
													
                                                    <cc1:AsyncFileUpload ID="fileUploadArquivo1" runat="server" 
                                                               CompleteBackColor="#B9FFB9" CssClass="botao" 
                                                               OnClientUploadComplete="uploadComplete" 
                                                               OnClientUploadStarted="startUpload" 
                                                               OnClientUploadError="uploadError" 
                                                               ThrobberID="Throbber" 
                                                               onuploadedcomplete="AsyncFileUpload1_UploadedComplete" 
                                                               UploadingBackColor="#CCFFFF" Width="200px" />

                                                    <asp:Label ID="Throbber" runat="server" Style="display: none">
                                                        <img src="Administracao/mytnr/indicator.gif" align="absmiddle" alt="carregando..." />Aguarde...
                                                    </asp:Label>
                                                    <asp:TextBox ID="txtArquivo" runat="server" BorderStyle="None" ForeColor="White"></asp:TextBox>


                                                    </td>
												</tr>
											</table>
											<div align="center">
                                               <asp:GridView ID="grdDados" runat="server" AutoGenerateColumns="False" 
                                                   CellPadding="4" Font-Names="Verdana" Font-Size="11px" ForeColor="#333333" 
                                                   GridLines="None" Width="500px" AllowPaging="True" 
                                                   onrowdeleting="grdDados_RowDeleting" 
                                                   onrowcommand="grdDados_RowCommand" onrowdatabound="grdDados_RowDataBound" 
                                                   EnableModelValidation="True">
                                                   <PagerSettings Position="Top" />
                                                   <RowStyle BackColor="#EFF3FB" />
                                                   <FooterStyle BackColor="#507CD1" Font-Bold="True" ForeColor="White" />
                                                   <PagerStyle BackColor="#2461BF" ForeColor="White" HorizontalAlign="Center" />
                                                   <SelectedRowStyle BackColor="#D1DDF1" Font-Bold="True" ForeColor="#333333" />
                                                   <HeaderStyle BackColor="#507CD1" Font-Bold="True" ForeColor="White" />
                                                   <EditRowStyle BackColor="#2461BF" />
                                                   <AlternatingRowStyle BackColor="White" />
                                                   <Columns>     
                                                      <asp:TemplateField ShowHeader="False">
                                                         <ItemTemplate>
                                                            <asp:LinkButton ID="LinkButtonEdit" runat="server" CausesValidation="False" CommandName="Select" Text="Selecione" />
                                                         </ItemTemplate>                                                
                                                      </asp:TemplateField>

                                                        <asp:TemplateField HeaderText="Foto">
                                                           <ItemTemplate>
                                                              <asp:Label ID="lblFoto" runat="server" Text='<%# Bind("foto") %>'  />
                                                           </ItemTemplate>
                                                       </asp:TemplateField>
                                                      <asp:TemplateField ShowHeader="False">
                                                         <ItemTemplate>
                                                            <asp:LinkButton ID="LinkButtonDelete" runat="server" CausesValidation="False" CommandName="Delete"
                                                               OnClientClick="return confirm('Deseja excluir o registro?');" Text="Deletar" />                                          
                                                         </ItemTemplate>                                                
                                                      </asp:TemplateField>
                                                                                        
                                                   </Columns>   
                                               </asp:GridView>


											</div>
                                               <div id="uploadMessage"><p></p></div> 
											</div>
										</div>
									</div>
								</div>
							</div>							
							<p style="margin-top: 0; margin-bottom: 0">
							<input type="button" value="Enviar Alterações" name="B11"><input type="reset" value="Limpar dados" name="B12"></p>
							
							<p>&nbsp;</div>
						</td>
					</tr>
				</table>

</asp:Content>