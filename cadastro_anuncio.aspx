<%@ Page Language="C#" AutoEventWireup="true" CodeFile="cadastro_anuncio.aspx.cs" MasterPageFile="~/Default.master" Inherits="cadastro_anuncio" %>
<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="cc1" %>

<asp:Content ID="HeaderCont" runat="server" ContentPlaceHolderID="HeadContent">
</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  

        <table border="0" width="600" cellspacing="0" cellpadding="0" >
        <tr>
        <td colspan="3" align="right">
           
        </td>
        </tr>
		<tr>
			<td width="600" valign="top" align="left">            
			<p align="center" style="margin: 0 50px">
			&nbsp;<p align="center" style="margin-top: 0; margin-bottom: 0">
			<b><font face="Verdana">EFETUAR CADASTRO</font></b></p>
			<p align="center" style="margin-top: 20px; margin-bottom: 10px">
			<b><font face="Verdana">Cadastro financeiro&nbsp;&nbsp;&nbsp;&nbsp;
			</font></b><asp:CheckBox ID="ckPessoaJuridica" runat="server" /><b><font face="Verdana">Pessoa 
			Jurídica&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></b>
			<asp:CheckBox ID="ckPessoaFisica" runat="server" /><b><font face="Verdana">Pessoa 
			Física</font></b></p>
			<div align="center">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Razão Social / 
						Nome</font></td>
						<td height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtRazaoSocial" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Nome Fantasia 
						(anuncio)</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtNomeFantasia" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">CNPJ / CPF</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtCnpjCpf" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Inscrição 
						Estadual / RG</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtIncricaoEstadualRG" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Endereço 
						Financeiro</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtEnderecoFinanceiro" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Bairro </font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtBairro" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Cidade / 
						Estado</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtCidadeEstado" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">CEP</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtCep" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Responsável</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtResponsavel" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">E-mail</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtEmail" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Telefone</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtTelefone" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				</div>
			<p align="center" style="margin-top: 20px; margin-bottom: 10px">
			<b><font face="Verdana">Cadastro comercial para o 
			anuncio CLASSIFICADO ON-LINE</font></b></p>
			<div align="center">
				<div align="center">
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Nome Fantasia</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtNomeFantasiaC" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Bairro </font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtBairroC" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Cidade </font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtCidadeC" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Endereço</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtEnderecoC" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Telefone</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtTelefoneC" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">E-mail</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtEmailC" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="194" height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Site</font></td>
						<td  height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana">
							<asp:TextBox ID="txtSite" Width="250px" runat="server"></asp:TextBox>
                        </font></td>
					</tr>
				</table>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td width="193" height="25" valign="top" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Citar as 
						categorias</font></p>
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">em que seu 
						anuncio</font></p>
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">deverá ser 
						incluída</font></td>
						<td width="407" height="25">
						<p style="margin-top: 0; margin-bottom: 0">
  							<asp:TextBox ID="txtCategoria" TextMode="MultiLine" Height="50px" Width="250px" runat="server"></asp:TextBox>
                        </td>
					</tr>
				</table>
					<p align="center" style="margin-top: 20px; margin-bottom: 0; ">
					<b><font face="Verdana">Anúncios adicionais</font></b></p>
					<blockquote>
					<blockquote>
						<blockquote>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>                                    
						<td height="25" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckClubeOfertas" runat="server" /><font face="Verdana" size="2">Clube 
						de Ofertas</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckTvOnline" runat="server" /><font face="Verdana" size="2">TV 
						ON-Line</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckTema" runat="server" /><font face="Verdana" size="2">Vitrine 
						Tema Infantil</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckConvite" runat="server" /><font face="Verdana" size="2">Vitrine 
						Convites / Lembrancinhas</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckBannerPublicidade" runat="server" /><font face="Verdana" size="2">Banner 
						Publicidade&nbsp;&nbsp;&nbsp;&nbsp; </font>
						<p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckBannerTopo" runat="server" /><font face="Verdana" size="2">Banner 
						Topo&nbsp;&nbsp;&nbsp;&nbsp; </font>
						<p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckBannerCentral" runat="server" /><font face="Verdana" size="2">Banner 
						Central</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckMateriaHome" runat="server" /><font face="Verdana" size="2">Matéria 
						Home</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckMateriaTema" runat="server" /><font face="Verdana" size="2">Matéria 
						Vitrine Tema Infantil</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckMateriaConvite" runat="server" /><font face="Verdana" size="2">Matéria 
						vitrine Convites / Lembrancinhas</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckHotSiteBasico" runat="server" /><font face="Verdana" size="2">Criação 
						de Hot site Básico</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckHotSiteIntermediario" runat="server" /><font face="Verdana" size="2">Criação 
						de Hot site Intermediário</font><p style="margin-top: 0; margin-bottom: 0">
						<asp:CheckBox ID="ckHotSiteAvancado" runat="server" /><font face="Verdana" size="2">Criação 
						de Hot site Avançado</font></td>
					</tr>
				</table>
						</blockquote>
					</blockquote>
				</blockquote>
				</div>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
				<table border="0"  cellspacing="0" cellpadding="0">
					<tr>
						<td height="25" valign="top" align="left">
						<p style="margin-top: 0; margin-bottom: 0">
						<font face="Verdana" size="2">Observação</font></td>
						<td height="25">
						<p style="margin-top: 0; margin-bottom: 0">
						<asp:TextBox ID="txtObservacao" TextMode="MultiLine" Height="50px" Width="350px" runat="server"></asp:TextBox>                                    
                        </td>
					</tr>
				</table>
				</div>
						
                            
			</td>
		</tr>
	</table>
    


         <asp:Button ID="btnProsseguir" runat="server" Text="Ler o Contrato e Prosseguir" /> 
         <cc1:modalpopupextender ID="btnProsseguir_ModalPopupExtender" 
         runat="server" BackgroundCssClass="ModalPopupBG" CancelControlID="btnFechar" 
         Drag="True" DynamicServicePath="" Enabled="True" OnOkScript="onOk()" 
         PopupControlID="pnContrato" TargetControlID="btnProsseguir">
         </cc1:modalpopupextender>                                                                

     


    <asp:Panel ID="pnContrato" runat="server" BackColor="White" Width="800px" Height="400px" ScrollBars="Vertical">
        <table style="width:100%;">
        <tr>
          <td colspan="3" align="right">
             <asp:ImageButton ID="btnCloseVideo" runat="server" ImageUrl="~/imagens/close.png" />
          </td>
        </tr>
        </table>

	    <p style="margin-left: 100px; margin-top: 0; margin-bottom: 10px" align="left">&nbsp;<p class="MsoNormal" align="center" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <b><span style="font-family: Verdana,sans-serif">
	    CONTRATO DE PRESTAÇÃO DE SERVIÇOS</span></b></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Pelo presente instrumento particular de contrato, de 
	    um lado, TEM NA REDE PROVEDORES LTDA, empresa 
	    inscrita no CNPJ sob o número 10.624.585/0001-74, 
	    com sede em Curitiba - PR, doravante denominada 
	    prestadora de serviços de publicidade on-line, de 
	    outro lado doravante denominado simplesmente 
	    Cliente/Anunciante, contrata neste ato a prestação 
	    de serviços de divulgação empresarial em portal de 
	    serviços na internet, mediante as seguintes 
	    cláusulas e condições, plenamente aceitas por ambas 
	    as partes:</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    1 - DO OBJETO - O objeto do presente contrato é a 
	    prestação de serviços de divulgação empresarial em 
	    portal de serviços na internet a prestação de 
	    serviço de internet, a ser utilizado respeitando o 
	    presente contrato.</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    2 - DO PRAZO - O contrato terá início a partir da 
	    data de solicitação da abertura da conta conforme 
	    registrado em nosso sistema, com sua duração de 06 
	    meses.</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    PARÁGRAFO ÚNICO - O presente contrato, firmado pelo 
	    prazo 06 meses, poderá ser rescindido, por ambas as 
	    partes, mediante simples comunicação escrita à outra 
	    parte (por e-mail).</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    3- OPÇÕES DE ANÚNCIOS OFERECIDOS PELO PORTAL GUIA DE 
	    FESTAS CURITIBA</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    a)Anúncios Classificados / Segmentados</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Nessa área você divulgará sua logomarca no formato 
	    JPG, 2 fones, endereço, e-mail, link para website,&nbsp; 
	    link para redes sociais( Facebook / Orkut / Twitter 
	    / Google+) e mapa de localização. O formato de 
	    visualização será de forma randômica, ou seja, a 
	    cada click seu anúncio será visualizado em uma 
	    posição diferente. A pesquisa será efetuada através 
	    de palavras-chaves (palavras que vinculam ao 
	    segmento do anunciante), ordem alfabética ou por 
	    bairros. O Anunciante poderá incluir seu anuncio em 
	    vários segmentos, desde que atenda a demanda e a 
	    necessidade do consumidor final.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    b)Banner publicidade</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Os banners publicidades serão visualizados de forma 
	    randômica, ou seja, a cada click seu anúncio será 
	    visualizado em uma posição diferente em todas as 
	    paginas do portal Guia de Festas Curitiba.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Nesse formato específico, você poderá incluir a 
	    logomarca da sua empresa para apresentação na parte 
	    lateral direita do Guia de Festas Curitiba, quando 
	    clicar no banner, será visualizado automaticamente 
	    um folder no tamanho 780x580 pixel, com informações 
	    mais detalhadas, dando link para seu website.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    c)Banner Principal Topo</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Os banners do tipo principal terão até 4 anunciantes 
	    e serão visualizados de forma randômica, ou seja, a 
	    cada click seu anúncio será visualizado em uma 
	    posição diferente em todas as paginas do portal Guia 
	    de Festas Curitiba.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Nesse formato específico, você poderá incluir a 
	    logomarca da sua empresa, bem como informações mais 
	    detalhadas de promoções, dando link para seu web 
	    site no tamanho 700x100 pixel.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    d)Banner Principal Randômico Central</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Os banners do tipo principal randômico central, 
	    serão visualizados de forma randômica, ou seja, a 
	    cada click seu anúncio será visualizado em uma 
	    posição diferente em todas as paginas do portal Guia 
	    de Festas Curitiba, totalizando até 20 anunciantes.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Nesse formato específico, você poderá incluir a 
	    logomarca da sua empresa, bem como informações mais 
	    detalhadas de promoções, dando link para seu website 
	    no tamanho 730x220 pixel.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    e)Clube de Ofertas</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    O anúncio será visualizado de forma randômica, ou 
	    seja, cada click a sua OFERTA poderá ser&nbsp; 
	    visualizada em uma posição diferente dentro da área 
	    CLUBE DE OFERTAS.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Quando clicar na OFERTA, o internauta será 
	    direcionado automaticamente para informações mais 
	    detalhadas fornecidas pelo anunciante.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    O anunciante poderá contratar esse tipo de anúncio 
	    por um período mínimo de 30 dias, e terá autonomia 
	    de administrar suas vendas sem que o GUIA DE FESTAS 
	    CURITIBA sirva de intermediário na transação 
	    comercial/financeira realizada.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span lang="EN-US" style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    f)Vitrine On-line Tema Infantil</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Aperfeiçoamos a busca pelos temas infantis 
	    oferecidos pelos nossos anunciantes. Nessa seção, o 
	    seu anuncio será diferenciado, você poderá incluir 
	    fotos dos temas separadamente.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    A base de pesquisas será o TEMA INFANTIL e não mais 
	    o Anunciante, seu cliente terá oportunidade de 
	    visualizar a foto de seu tema cadastrado em 
	    destaque.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    A contratação será por tema infantil, sendo que 
	    estipulamos um mínimo de 15 temas para cada 
	    anunciante, agregando valor no montante da sua 
	    mensalidade.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    g)Vitrine On-line Convites e Lembrancinhas</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Aperfeiçoamos a busca pelos convites e lembrancinhas 
	    oferecidos pelos nossos anunciantes. Nessa seção, o 
	    seu anuncio será diferenciado, você poderá incluir 
	    fotos dos seus produtos separadamente.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    A base de pesquisas será o PRODUTO e não mais o 
	    Anunciante, seu cliente terá oportunidade de 
	    visualizar a foto de seu produto cadastrado em 
	    destaque.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    A contratação será por produtos, sendo que 
	    estipulamos um mínimo de 15 produtos para cada 
	    anunciante, agregando valor no montante da sua 
	    mensalidade.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    h)TV On-line Guia de Festas Curitiba</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Os vídeos inseridos nesse formato de anúncio serão 
	    produzidos e enviados pelo próprio anunciante. O 
	    anunciante ganhará destaque na página inicial do 
	    portal GUIA DE FESTAS CURITIBA, bem como uma área 
	    exclusiva para esse formato de anuncio. </span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Os vídeos deverão ser breves para que você possa ter 
	    um resultado eficaz.</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    i)Matérias de Capa Home Guia de Festas Curitiba</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Desenvolvemos mais um canal para você poder divulgar 
	    seus produtos e serviços. Disponibilizamos uma área 
	    especial na página principal do GUIA DE FESTAS 
	    CURITIBA. Nessa seção você poderá divulgar as 
	    novidades de sua empresa, ou até mesmo escrever 
	    sobre as tendências do segmento de festas e eventos.
	    </span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    j)Matérias de Capa link Decorações</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Desenvolvemos mais um canal para você poder divulgar 
	    seus produtos e serviços. Disponibilizamos uma área 
	    especial no link de DECORAÇÕES do GUIA DE FESTAS 
	    CURITIBA. Nessa seção você poderá divulgar as 
	    novidades de sua empresa, ou até mesmo escrever 
	    sobre as tendências do segmento de DECORAÇÕES 
	    INFANTIS. </span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    k)Matérias de Capa link Convites e Lembrancinhas</span></p>
	    <p class="MsoNormal" align="justify" style="margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    Desenvolvemos mais um canal para você poder divulgar 
	    seus produtos e serviços. Disponibilizamos uma área 
	    especial no link de Convites e Lembrancinhas do GUIA 
	    DE FESTAS CURITIBA. Nessa seção você poderá divulgar 
	    as novidades de sua empresa, ou até mesmo escrever 
	    sobre as tendências do segmento de Convites e 
	    Lembrancinhas</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 120px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <font color="#CE1324">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    PARÁGRAFO ÚNICO - O valor do contrato será
	    <strong style="font-weight: 400">
	    <span style="font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">
	    acordado entre ambas as partes posteriormente, após 
	    aprovação desse contrato. O valor desse acordo, será 
	    enviado através do e-mail citado nesse contato pelo 
	    cliente/anunciante, após a escolha de anúncio a ser 
	    veiculado em nosso portal de internet Guia de Festas 
	    Curitiba.</span></strong></span></font></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    4 - ATRASO - O não cumprimento, por parte do 
	    Cliente/Anunciante, da obrigação de pagamento das 
	    mensalidades(período de veiculação) acarretará na 
	    suspensão dos serviços prestados após 5 (cinco) dias 
	    do vencimento da última mensalidade, mediante aviso 
	    por e-mail. Após 15 dias do vencimento da última 
	    mensalidade, independente de aviso ou notificação 
	    informará que seu anúncio será automaticamente 
	    congelado/inativado de nosso portal de internet
	    </span>
	    <a target="_blank" style="text-decoration: underline; text-underline: single" href="http://www.guiadefestascuritiba.com.br">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    <font color="#000000">
	    www.guiadefestascuritiba.com.br</font></span></a><span style="font-size: 10.0pt; font-family: Verdana,sans-serif">. 
	    Após 30 dias de atraso da última mensalidade, seu 
	    nome deverá ser incluído nos SERVIÇOS DE PROTEÇÃO AO 
	    CRÉDITO. Para reativar os serviços, o Cliente deverá 
	    quitar as pendências e solicitar nova inscrição.</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    5 - RESPONSABILIDADE CIVIL - O Cliente será 
	    responsável por qualquer tipo de indenização, devida 
	    em virtude de danos causados a terceiros, decorrente 
	    de informações veiculadas em seu site, bem como, não 
	    se limitando a isso, da utilização e processamento 
	    de informações a partir de seu site. O 
	    Cliente/Anunciante será responsável por qualquer 
	    prejuízo que possa causar a terceiros, bem como, por 
	    desrespeito às leis e normas dos órgãos públicos, 
	    inclusive, responde por usuários que venham a 
	    armazenar softwares piratas, arquivos hackers, 
	    vírus, material adulto, observado o estatuto da 
	    criança e adolescente, conteúdos impróprios e/ou 
	    vedados por lei, material com direito reservado e 
	    outros em seu site.</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    6 - O TEM NA REDE PROVEDORES LTDA não se 
	    responsabiliza pelos serviços prestados pela Fapesp 
	    e Provedor, relacionados a registro e publicação de 
	    domínios. Os domínios desativados ou sem respostas, 
	    são de única e exclusiva responsabilidade dos órgãos 
	    competentes, responsáveis pela administração dos 
	    mesmos.</span></p>
	    <p class="MsoNormal" style="text-align: justify; margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    7 - COMUNICAÇÃO - A comunicação será efetuada por 
	    e-mail. Mantenha o endereço do seu e-mail de contato 
	    atualizado em nosso cadastro.</span></p>
	    <p align="justify" style="margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">
	    <span style="font-size: 10.0pt; font-family: Verdana,sans-serif">
	    8 - VALIDAÇÃO DO CONTRATO – A validação desse 
	    contrato deverá ser efetuada após escolha de opção 
	    de anuncio a ser divulgado em nosso portal de 
	    internet Guia de Festas Curitiba, bem como análise e 
	    aprovação de nosso setor de Cadastro. O Cliente 
	    /Anunciante será comunicado através de e-mail 
	    fornecido por livre e espontânea vontade a respeito 
	    da validação do mesmo.</span></p>
	    <p align="justify" style="margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px">&nbsp;</p>
	    <p style="margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px" align="justify">
	    <asp:CheckBox ID="ckAceito" runat="server" /><font face="Verdana" size="2"> 
	    Li e concordo com os termos de contrato&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    </font>
	    <p style="margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 5px" align="justify">
	    <asp:CheckBox ID="NaoAceito" runat="server" /><font face="Verdana" size="2"> 
	    Não concordo com os termos de contrato</font><p style="margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 10px" align="justify">&nbsp;<p style="margin-left: 100px; margin-right: 100px; margin-top: 0; margin-bottom: 10px" align="justify">
		    <asp:Button ID="btnEnviar" runat="server" Text="Enviar" onclick="btnEnviar_Click" />
                <asp:Button ID="btnLimpar" runat="server" Text="Limpar" 
                    onclick="btnLimpar_Click" /><p>&nbsp;  
                    </asp:Panel>


    <cc1:RoundedCornersExtender ID="pnContrato_RoundedCornersExtender" 
        runat="server" BorderColor="ActiveBorder" Enabled="True" 
        TargetControlID="pnContrato">
    </cc1:RoundedCornersExtender>


</asp:Content>