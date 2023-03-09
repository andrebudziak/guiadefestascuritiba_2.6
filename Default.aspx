
<%@ page language="C#" autoeventwireup="true" MasterPageFile="~/MasterPage.master"  CodeFile="Default.aspx.cs" Inherits="_Default" %>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  

<div class="col-md-7 content-wrapper">                

                <div id="holo_row-3315" class="content" style="position: relative;border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-right-width: 1px;">
                    <div class="row">                        
                        <div class="col-sm-12"><style type="text/css">#holo_divider-7931{ margin-bottom: 20px; }</style>
                            <div id="holo_divider-7931" class="divider divider-1">
                               <h1>Noticias</h1><div class="separator"></div>
                           </div>
                       </div>
                    </div>
                </div>
            
<div class="site-wrapper clearfix">
    <div class="description">
        <div class="col-md-9 descriptioninfo">
                            <asp:DataList ID="dlDestaque" runat="server">
                                <ItemTemplate>
                                   <asp:Label ID="lblCodigo" runat="server" Visible="false" Text='<%# Eval("codigo") %>' />
                                   <asp:Label ID="lblDestaque" runat="server" Text='<%# Eval("destaque") %>' />                      
                                </ItemTemplate>
                            </asp:DataList>
         </div>
     </div>
</div>
            

</div>
</asp:Content>