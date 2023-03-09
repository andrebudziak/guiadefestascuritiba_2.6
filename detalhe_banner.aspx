<%@ Page Language="C#" AutoEventWireup="true" CodeFile="detalhe_banner.aspx.cs"  MasterPageFile="~/MasterPage.master" Inherits="detalhe_banner" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">      

        <div class="col-md-7 blog-wrapper">

        
            <div class="divider divider-1">
                <h1 class="title"><asp:Label ID="lblNomeFantasia" runat="server" Text=""></asp:Label></h1><div class="separator"></div>
            </div>

            <div class="list-wrapper">

                <div class="single-listing">
<!--                    <div class="image">-->
<!--                        --><!--                    </div>-->
                    <div class="post-media"><div class="image">
                    <a class="overlay mgp-img" href="http://www.guiadefestassantacatarina.com.br/wp-content/uploads/2015/03/maissaborsalgados.jpg">
                        <i class="fa-search md"></i>
                    </a>
                    <img width="735" height="518" src="http://www.guiadefestassantacatarina.com.br/wp-content/uploads/2015/03/maissaborsalgados-735x518.jpg" class="attachment-post_image" alt="maissaborsalgados" />
                </div>

                    </div>
                    <div class="content">


                        <div class="content-bottom">

                            <div class="col-sm-8">

                            
                                <h4>Contato</h4>
                            
                                <ul class="list">

                                    <li><i class="fa-location main-text-color"></i><asp:Label ID="lblEndereco" runat="server" Text=""></asp:Label>-<asp:Label ID="lblBairroCidade" runat="server" Text=""></asp:Label></li>
                                    <li><i class="fa-phone main-text-color"></i><asp:Label ID="lblTelefone" runat="server" Text=""></asp:Label></li>
                                    <li><i class="fa-mail-alt main-text-color"></i><asp:HyperLink CssClass="link_fonesite" ID="aEmail" runat="server"><asp:Label ID="lblEmail" runat="server" Text=""></asp:Label></asp:HyperLink></li>
                                    <li><i class="fa-globe main-text-color"></i><asp:HyperLink CssClass="link_fonesite" ID="aSite" runat="server" Target="_blank" ><asp:Label ID="lblSite" runat="server" Text=""></asp:Label></asp:HyperLink></li>                             

                                </ul>

                            
                                
                            </div>

                            
                            <div class="col-sm-4">
                                <div class="map">
                                    <div id="map-canvas"></div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>

            </div>

            

        </div>

</asp:Content>