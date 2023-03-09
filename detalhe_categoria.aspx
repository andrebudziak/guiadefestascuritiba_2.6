<%@ Page Language="C#" AutoEventWireup="true" CodeFile="detalhe_categoria.aspx.cs" MasterPageFile="~/MasterPage.master" Inherits="detalhe_categoria" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">      

<div class="col-md-7 content-wrapper">
        
            <div class="divider divider-1">
                <h1 class="title"<asp:Label ID="lblNomeFantasia" runat="server" Text=""></asp:Label></h1><div class="separator"></div>
            </div>

            <div class="list-wrapper">

                <div class="single-listing">
                    
                    <div class="content">

                        <p>Qualquer conteudo</p>                       

                        <div class="content-bottom">

                            <div class="col-sm-8">
                            
                                <h4>Contato</h4>
                            
                                <ul class="list">

                                    <li><i class="fa-location main-text-color"></i><asp:Label ID="lblEndereco" runat="server" Text=""></asp:Label>-<asp:Label ID="lblBairroCidade" runat="server" Text=""></asp:Label></li>
                                    <li><i class="fa-phone main-text-color"></i><asp:Label ID="lblTelefone" runat="server" Text=""></asp:Label></li>
                                    <li><i class="fa-mail-alt main-text-color"></i><asp:HyperLink CssClass="link_fonesite" ID="aEmail" runat="server"><asp:Label ID="lblEmail" runat="server" Text=""></asp:Label></asp:HyperLink></li>
                                    <li><i class="fa-globe main-text-color"></i><asp:HyperLink CssClass="link_fonesite" ID="aSite" runat="server" Target="_blank" ><asp:Label ID="lblSite" runat="server" Text=""></asp:Label></asp:HyperLink></li>                             
                                    <li><i class="fa-eye main-text-color"></i>Localização</li>
                                </ul>                            
                                
                            </div>
                            

                             <asp:Label ID="lblMapa" runat="server" Text=""></asp:Label>            
                            
                            
                        </div>
                    </div>



                </div>

            </div>

      
        </div>

</asp:Content>