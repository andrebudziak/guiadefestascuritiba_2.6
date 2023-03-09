<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Administracao/Site.master" CodeFile="cadastro_link.aspx.cs" Inherits="Administracao_cadastro_link" %>

<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="asp" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">
    
</asp:Content>
<asp:Content ID="BodyContent" runat="server" ContentPlaceHolderID="MainContent">
    <div>
       <center>
           <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
               <tr>
                   <td>
                       &nbsp;</td>
                   <td>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       &nbsp;</td>
                   <td align="center">
                       <asp:Panel ID="Panel1" runat="server" Width="1024px" BackColor="White">
                           <asp:UpdatePanel ID="UpdatePanel1" runat="server">
                           <ContentTemplate>                          
                           
                           <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label8" runat="server" CssClass="label" Text="Codigo:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:Label ID="lblCodigo" runat="server" CssClass="label"></asp:Label>
                                       <asp:Label ID="lblHash" runat="server" Text=""></asp:Label>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label13" runat="server" CssClass="label" Text="Anuncio:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:DropDownList ID="ddlAnuncio" runat="server" 
                                           DataTextField="nome_fantasia" 
                                           DataValueField="codigo" Width="200px" AutoPostBack="True">
                                       </asp:DropDownList>

                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label9" runat="server" CssClass="label" Text="Orkut:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtOrkut" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label14" runat="server" CssClass="label" Text="Facebook:"></asp:Label>
                                   </td>
                                   <td align="left">

                                       <asp:TextBox ID="txtFacebook" runat="server" CssClass="edit" Width="200px"></asp:TextBox>

                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label15" runat="server" CssClass="label" Text="Twitter:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtTwitter" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td>
                                       &nbsp;</td>
                                   <td>
                                       &nbsp;</td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td>
                                       &nbsp;</td>
                                   <td>
                                       <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                           <tr>
                                               <td>
                                                   <asp:Button ID="btnIncluir" runat="server" CssClass="botao" 
                                                       onclick="btnIncluir_Click" Text="Incluir" Width="200px" />
                                               </td>
                                               <td>
                                                   <asp:Button ID="btnSalvar" runat="server" CssClass="botao" 
                                                       onclick="btnSalvar_Click" Text="Salvar" Width="200px" />
                                               </td>
                                               <td>
                                                   &nbsp;</td>
                                           </tr>
                                       </table>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                           </table>
                          </ContentTemplate>
                               <Triggers>                                
                                   <asp:AsyncPostBackTrigger ControlID="btnIncluir" EventName="Click" />
                               </Triggers>
                           </asp:UpdatePanel>
                       
                       </asp:Panel>
                                      <asp:RoundedCornersExtender ID="Panel1_RoundedCornersExtender" runat="server" 
                                          BorderColor="ActiveBorder" Enabled="True" TargetControlID="Panel1">
                                      </asp:RoundedCornersExtender>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       &nbsp;</td>
                   <td align="center">
                       &nbsp;</td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       &nbsp;</td>
                   <td align="center">
                       <asp:Panel ID="Panel2" runat="server" BackColor="White" ScrollBars="Auto" Width="1024px">
                       <asp:UpdatePanel ID="UpdatePanel2" runat="server">
                          <ContentTemplate>                      
                       
                           <table style="width:100%;" border="0" cellpadding="0" cellspacing="0">
                               <tr>
                                   <td >
                                       &nbsp;</td>
                                   <td>

                                       <asp:ObjectDataSource ID="ObjectDataSource1" runat="server" 
                                           DeleteMethod="ExcluirLink" InsertMethod="IncluirLink" 
                                           SelectMethod="ConsultaLink" TypeName="WebService" 
                                           UpdateMethod="IncluirLink" ondeleting="ObjectDataSource1_Deleting" 
                                           oninserting="ObjectDataSource1_Inserting" 
                                           onselecting="ObjectDataSource1_Selecting">
                                       <DeleteParameters>
                                           <asp:Parameter Name="codigo" Type="Int32" DefaultValue="0" />
                                       </DeleteParameters>
                                       <UpdateParameters>
                                           <asp:Parameter Name="codigo" Type="Int32" />
                                           <asp:Parameter Name="codigo_anuncio" Type="Int32" />
                                           <asp:Parameter Name="orkut" Type="String" />
                                           <asp:Parameter Name="facebook" Type="String" />
                                           <asp:Parameter Name="twitter" Type="String" />
                                       </UpdateParameters>
                                       <SelectParameters>
                                           <asp:Parameter DefaultValue="0" Name="codigo" Type="Int32" />
                                           <asp:Parameter DefaultValue="0" Name="anuncio" Type="String" />
                                       </SelectParameters>
                                       <InsertParameters>
                                           <asp:Parameter Name="codigo" Type="Int32" />
                                           <asp:Parameter Name="codigo_anuncio" Type="Int32" />
                                           <asp:Parameter Name="orkut" Type="String" />
                                           <asp:Parameter Name="facebook" Type="String" />
                                           <asp:Parameter Name="twitter" Type="String" />
                                       </InsertParameters>
                                       </asp:ObjectDataSource>


                                   </td>
                                   <td >
                                   </td>
                               </tr>
                               <tr>
                                   <td align="right" >
                                       <asp:Label ID="Label6" runat="server" CssClass="label" Text="Pesquisar:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtPesquisa" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                       &nbsp;&nbsp;&nbsp;
                                       <asp:Button ID="btnPesquisar" runat="server" CssClass="botao" Text="Pesquisar" 
                                           Width="150px" onclick="btnPesquisar_Click1" />
                                       &nbsp;&nbsp;&nbsp;
                                       <asp:ImageButton ID="btnRefresh" runat="server" Height="20px" 
                                           ImageUrl="~/Administracao/mytnr/refresh.png" onclick="btnRefresh_Click" 
                                           Width="20px" />


                                   </td>
                                   <td align="center">

                                   </td>
                               </tr>

                               <tr>
                                   <td >
                                       &nbsp;</td>
                                   <td>
                                       &nbsp;</td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="center" colspan="3">
                                       <asp:GridView ID="grdDados" runat="server" AutoGenerateColumns="False" 
                                           CellPadding="4" Font-Names="Verdana" Font-Size="11px" ForeColor="#333333" 
                                           GridLines="None" Width="1024px" AllowPaging="True" 
                                           DataSourceID="ObjectDataSource1" onrowdeleting="grdDados_RowDeleting" 
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

                                                <asp:TemplateField HeaderText="Codigo" SortExpression="codigo">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblCodigo" runat="server" Text='<%# Bind("codigo") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>
                                                <asp:TemplateField HeaderText="Anuncio">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblCodigoAnuncio" Visible="false" runat="server" Text='<%# Bind("codigo_anuncio") %>'  />
                                                      <asp:Label ID="lblAnunciante" Width="200px" Font-Bold="true" runat="server" Text='<%# Bind("nome_fantasia") %>'  />
                                                   </ItemTemplate>
                                               </asp:TemplateField>
                                               <asp:TemplateField HeaderText="Orkut" SortExpression="orkut">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblOrkut" runat="server" Text='<%# Eval("orkut") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                                         
                                               <asp:TemplateField HeaderText="Facebook" SortExpression="facebook">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblFacebook" runat="server" Text='<%# Eval("facebook") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                                         
                                               <asp:TemplateField HeaderText="Twitter" SortExpression="twitter">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblTwitter" runat="server" Text='<%# Eval("twitter") %>' />
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
                                   </td>                             
                               </tr>
                               <tr>
                                   <td >
                                       &nbsp;</td>
                                   <td>
                                       &nbsp;</td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                           </table>
                           
                           </ContentTemplate>
                       </asp:UpdatePanel>
                       </asp:Panel>
                       <asp:RoundedCornersExtender ID="Panel2_RoundedCornersExtender" runat="server" 
                           BorderColor="ActiveBorder" Enabled="True" TargetControlID="Panel2">
                       </asp:RoundedCornersExtender>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                  <td>
                  </td>
                  <td align="center">
                      <asp:ImageButton ID="ImageButton1" runat="server" 
                          ImageUrl="~/Administracao/mytnr/voltar.gif" onclick="ImageButton1_Click" />
                  </td>
                  <td>
                  </td>
               </tr>
               <tr>
                   <td>
                       &nbsp;</td>
                   <td align="center">
                       <asp:UpdateProgress ID="UpdateProgress1" runat="server" 
                           AssociatedUpdatePanelID="UpdatePanel1">
                           <ProgressTemplate>
                               <img alt="" src="mytnr/wait.gif" class="style1" />Aguarde...
                           </ProgressTemplate>
                       </asp:UpdateProgress>
                   </td>
                   <td align="center">
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       &nbsp;</td>
                   <td align="center">
                       <asp:UpdateProgress ID="UpdateProgress2" runat="server" 
                           AssociatedUpdatePanelID="UpdatePanel2">
                           <ProgressTemplate>
                               <img alt="" class="style1" src="mytnr/wait.gif" />
                               Aguarde...
                           </ProgressTemplate>
                       </asp:UpdateProgress>
                   
                   </td>
                   <td align="center">
                       &nbsp;</td>
               </tr>
           </table>
       </center>    
    </div>

</asp:Content>