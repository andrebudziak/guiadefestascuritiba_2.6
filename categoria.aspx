<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/MasterPage.master" CodeFile="categoria.aspx.cs" Inherits="categoria" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">  

<!-- CSS -->
<link href="http://www.guiactbatemp.comercial.ws/css/style.css" rel="stylesheet" type="text/css" />

<!-- Font Awesome CSS -->
<link href="http://www.guiactbatemp.comercial.ws/css/font-awesome.css" rel="stylesheet" type="text/css" />

<!-- JS -->
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://www.guiactbatemp.comercial.ws/Scripts/custom.js"></script>


<link rel="stylesheet" href="http://www.guiactbatemp.comercial.ws/css/blueberry.css" />
<script src="http://www.guiactbatemp.comercial.ws/Scripts/jquery.blueberry.js"></script>



</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">      
    
    
<div class="col-md-7 content-wrapper">                
          <div class="recent-places">
              <asp:ScriptManager ID="ScriptManager1" runat="server"></asp:ScriptManager>

              <asp:UpdatePanel ID="UpdatePanel1" UpdateMode="Always" runat="server">
              <ContentTemplate>

             <div class="post-header clearfix">
                  <asp:ImageButton ID="imgSemDados" ImageUrl="imagens/semclientes.png" runat="server" />
                  <div class="divider divider-1"><h1><asp:Label ID="lblTituloCat" runat="server" ></asp:Label></h1><div class="separator"></div></div>
					

                <div class="posts-show-number">


                </div>
             </div>

                    <asp:DataList ID="dlAnunciante" runat="server" ShowFooter="False" 
                        ShowHeader="False" onitemdatabound="dlAnunciante_ItemDataBound"  
                        BorderWidth="0px" CellPadding="0" onitemcommand="dlAnunciante_ItemCommand">
                        <AlternatingItemStyle Font-Bold="False" Font-Italic="False" 
                            Font-Overline="False" Font-Strikeout="False" Font-Underline="False" />
                        <ItemTemplate>


                            <div class="site-wrapper clearfix">
                               <div class="picture">
                                   <asp:HyperLink ID="aLogo" runat="server" Target="_blank" > 
                                     <asp:ImageButton border="0" ID="btnImgLogo" CommandName="ContaClick" runat="server"  />
                                   </asp:HyperLink>								                        
                               </div>
                               <div class="description"><i class="iconstyle"><img src="http://www.guiadefestassantacatarina.com.br/wp-content/uploads/2015/03/badge-31.png" alt="site badge"></i>
                                  <div class="col-md-9 descriptioninfo">
                                        <p>
                                        <h5>
                                           <asp:HyperLink CssClass="link_fonesite" ID="aSite" runat="server" Target="_blank" >
                                               <asp:Label ID="lblCodigoAnuncio" runat="server" Text="" Visible="false"></asp:Label>
                                               <asp:Label ID="lblNomeFantasia" runat="server" Text=""></asp:Label>
                                            </asp:HyperLink>
                                        </h5>
                                            </p>

                                        <p style="text-align:left;"><i class="fa-child main-text-color"></i><asp:Label ID="lblDescricao" runat="server" Text=""></asp:Label></p>                                        
                                        <p style="text-align:left;"><i class="fa-location main-text-color"></i><asp:Label ID="lblEndereco" runat="server" Text=""></asp:Label></p>
                                        <p style="text-align:left;"><i class="fa-flag main-text-color"></i><asp:Label ID="lblBairroCidade" runat="server" Text=""></asp:Label></p>
                                        <p style="text-align:left;"><i class="fa-mail-alt main-text-color"></i><asp:HyperLink CssClass="link_fonesite" ID="aEmail" runat="server">E-mail</asp:HyperLink></p>
                                        <p style="text-align:left;"><i class="fa-phone main-text-color"></i><asp:Label ID="lblTelefone" runat="server" Text=""></asp:Label></p>
                                      
                                </div>
                                <div class="col-md-3 rating">
                                   <div class="star" style="height:50px;">
                                        <section id="container">
                                        <!-- Style 2 -->
                                        <div id="menu-wrap">

		                                        <div class="menu-item">
			                                        <span id="active" class="icon fa fa-facebook"></span>
                                                    <asp:HyperLink ID="aFacebook" runat="server" Target="_blank" class="text"> 
			                                        <i class="fa fa-facebook"></i>
                                                     </asp:HyperLink>  
 		                                        </div><!-- Menu Item -->
        
		                                        <div class="menu-item">
			                                        <span id="active" class="icon fa fa-twitter"></span>
			                                        <a id="hover" class="text" href="#"><i class="fa fa-twitter"></i></a>
		                                        </div><!-- Menu Item -->
        
		                                        <div class="menu-item">
			                                        <span id="active" class="icon fa fa-google-plus"></span>
			                                        <a id="hover" class="text" href="#"><i class="fa fa-google-plus"></i></a>
		                                        </div><!-- Menu Item -->
        
		                                        <div class="menu-item">
			                                        <span id="active" class="icon fa fa-instagram"></span>
			                                        <a id="hover" class="text" href="#"><i class="fa fa-instagram"></i></a>
		                                        </div><!-- Menu Item -->
        

                                        </div><!-- Menu Wrap -->
                                        </section><!-- Container -->                                      

                                   </div>
                                </div>
                                </div>
                            </div>


                        </ItemTemplate>
                    </asp:DataList>


                  </ContentTemplate>
              </asp:UpdatePanel>
 

          </div>    
 </div>
    




</asp:Content>

