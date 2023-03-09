<%@ Page Title="Home Page" Language="C#" MasterPageFile="~/Administracao/Site.master" AutoEventWireup="true"
    CodeFile="Default.aspx.cs" Inherits="Account_Default" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">
    
</asp:Content>
<asp:Content ID="BodyContent" runat="server" ContentPlaceHolderID="MainContent">
<div style="width:100%; height:150px;">       
   <table border="0" width="100%" cellspacing="0" cellpadding="0" height="25" background="mytnr/barra2.png">
	<tr>
		<td>     
            <div id="menu">
            <ul>
              <li><h2>Home</h2>
                <ul>
                   <li><asp:LinkButton ID="lbtnCadastroDestaque" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroDestaque_Click">Destaque</asp:LinkButton></li>
                </ul>
              </li>
            </ul>

            <ul>
              <li><h2>Anuncio</h2>
                <ul>
                   <li><asp:LinkButton ID="lbtnCadastroAnuncio" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroAnuncio_Click">Cadastro</asp:LinkButton></li>
                   <li><asp:LinkButton ID="lbtnCadastroCategoriaAnuncio" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroCategoriaAnuncio_Click">Categoria Anuncio</asp:LinkButton></li>
                   <li><asp:LinkButton ID="lbtnCadastroLinkAnuncio" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroLinkAnuncio_Click">Link</asp:LinkButton></li>
                   <li><asp:LinkButton ID="lbtnCadastroLogo" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroLogo_Click">Logo</asp:LinkButton></li>
                   <li><asp:LinkButton ID="lbtnCadastroSinonimo" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroSinonimo_Click">Sinonimo</asp:LinkButton></li>
                   <li><asp:LinkButton ID="lbtnCadastroAnuncioSinonimo" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroAnuncioSinonimo_Click">Anuncio Sinonimo</asp:LinkButton></li>
                </ul>
              </li>
            </ul>
            <ul>
              <li><h2>Banner</h2>
                <ul>
                   <li><asp:LinkButton ID="lbtnCadastroBanner" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroBanner_Click">Cadastro</asp:LinkButton></li>
                   <li><asp:LinkButton ID="lbtnCadastroCategoriaBanner" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroCategoriaBanner_Click">Categoria Banner</asp:LinkButton></li>

                </ul>
              </li>
            </ul>
            <ul>
              <li><h2>Categoria</h2>
                 <ul>
                   <li><asp:LinkButton ID="lbtnCadastroCategoria" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroCategoria_Click">Cadastro</asp:LinkButton></li>
                 </ul>
              </li>
            </ul>
            <ul>
              <li><h2>Usuario</h2>
                 <ul>
                   <li><asp:LinkButton ID="lbtnCadastroLogin" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroLogin_Click">Cadastro</asp:LinkButton></li>
                 </ul>
              </li>
            </ul>
            <ul>
              <li><h2>Cliente</h2>
                 <ul>
                   <li><asp:LinkButton ID="lbtnCadastroCliente" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroCliente_Click" >Cadastro</asp:LinkButton></li>
                 </ul>
              </li>
            </ul>
            <ul>
              <li><h2>Tema</h2>
                 <ul>
                   <li><asp:LinkButton ID="lbtnCadastroTema" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroTema_Click" >Cadastro</asp:LinkButton></li>
                   <li><asp:LinkButton ID="lbtnCadastroCategoriaTema" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroCategoriaTema_Click" >Categoria Tema</asp:LinkButton></li>
                 </ul>
              </li>
            </ul>
            <ul>
              <li><h2>Convite</h2>
                 <ul>
                   <li><asp:LinkButton ID="lbtnCadastroConvite" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroConvite_Click" >Cadastro</asp:LinkButton></li>
                   <li><asp:LinkButton ID="lbtnCadastroCategoriaConvite" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroCategoriaConvite_Click" >Categoria Convite</asp:LinkButton></li>
                 </ul>
              </li>
            </ul>
            <ul>
              <li><h2>Oferta</h2>
                 <ul>
                   <li><asp:LinkButton ID="lbtnCadastroOferta" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroOferta_Click" >Cadastro</asp:LinkButton></li>
                 </ul>
              </li>
            </ul>
            <ul>
              <li><h2>Video</h2>
                 <ul>
                   <li><asp:LinkButton ID="lbtnCadastroVideo" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnCadastroVideo_Click" >Cadastro</asp:LinkButton></li>
                 </ul>
              </li>
            </ul>
            <ul>
              <li><h2>Relatório</h2>
                 <ul>
                   <li><asp:LinkButton ID="lbtnRelatorioAtivos" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnRelatorioAtivos_Click" >Anuncios</asp:LinkButton></li>
                   <li><asp:LinkButton ID="lbtnRelatorioBanner" runat="server" Font-Names="Arial" Font-Size="12px" ForeColor="Black" onclick="lbtnRelatorioBanner_Click" >Banners</asp:LinkButton></li>                 
                 </ul>
              </li>
            </ul>
            </div>           
       </td>
	</tr>
   </table>
</div>        

<asp:Panel ID="Panel1" Height="400px" runat="server">
</asp:Panel>
  
</asp:Content>
