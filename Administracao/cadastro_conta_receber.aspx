<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Administracao/Site.master" CodeFile="cadastro_conta_receber.aspx.cs" Inherits="Administracao_cadastro_anuncio" %>
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
                                       <asp:Label ID="Label13" runat="server" CssClass="label" Text="Cliente:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:DropDownList ID="ddlCliente" runat="server" 
                                           DataSourceID="ObjectDataSource2" DataTextField="nome_fantasia" 
                                           DataValueField="codigo"  
                                           Width="300px">
                                       </asp:DropDownList>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label19" runat="server" CssClass="label" Text="Vencimento:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtVencimento" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                       <asp:CalendarExtender ID="txtVencimento_CalendarExtender" runat="server" Enabled="True" TargetControlID="txtVencimento">
                                       </asp:CalendarExtender>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label24" runat="server" CssClass="label" Text="Documento:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtDocumento" runat="server"></asp:TextBox>
                                   </td>
                                   <td>&nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label25" runat="server" CssClass="label" Text="Valor:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtValor" runat="server"></asp:TextBox>
                                   </td>
                                   <td>&nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label21" runat="server" CssClass="label" Text="Nosso Numero:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:Label ID="lblNossoNumero" runat="server" CssClass="label" Text="***"></asp:Label>
                                   </td>
                                   <td>&nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label11" runat="server" CssClass="label" Text="Observação:"></asp:Label>
                                   </td>
                                   <td align="left">
                                      
                                       <asp:TextBox ID="txtObservacao" runat="server" CssClass="edit" Width="350px" Height="100px" TextMode="MultiLine"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label22" runat="server" CssClass="label" Text="Boleto:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:HyperLink ID="hlBoleto" runat="server">***</asp:HyperLink>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label17" runat="server" CssClass="label" Text="Status:"></asp:Label>
                                   </td>
                                   <td align="left">
                                        <asp:DropDownList ID="ddlStatus" runat="server" >
                                            <asp:ListItem Text="Ativo" Value="1"></asp:ListItem>
                                            <asp:ListItem Text="Inativo" Value="0"></asp:ListItem>
                                        </asp:DropDownList>

                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       &nbsp;</td>
                                   <td align="left">
                                       &nbsp;</td>
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
                                           DeleteMethod="ExcluirContaReceber" InsertMethod="IncluirContaReceber" 
                                           SelectMethod="ConsultaContaReceber" TypeName="WebService" 
                                           UpdateMethod="IncluirContaReceber" ondeleting="ObjectDataSource1_Deleting" 
                                           oninserting="ObjectDataSource1_Inserting" 
                                           onselecting="ObjectDataSource1_Selecting">
                                           <DeleteParameters>
                                               <asp:Parameter Name="codigo" Type="Int32" />
                                           </DeleteParameters>                                   
                                           <UpdateParameters>
                                               <asp:Parameter Name="codigo" Type="Int32" />
                                               <asp:Parameter Name="codigo_cliente" Type="Int32" />
                                               <asp:Parameter Name="vencimento" Type="DateTime" />
                                               <asp:Parameter Name="valor" Type="Double" />
                                               <asp:Parameter Name="nosso_numero" Type="String" />
                                               <asp:Parameter Name="documento" Type="String" />
                                               <asp:Parameter Name="observacao" Type="String" />
                                               <asp:Parameter Name="status" Type="Int32" />
                                               <asp:Parameter Name="boleto" Type="String" />
                                           </UpdateParameters>
                                           <SelectParameters>
                                               <asp:Parameter DefaultValue="0" Name="codigo" Type="Int32" />
                                               <asp:Parameter DefaultValue="0" Name="nome" Type="String" />
                                           </SelectParameters>
                                           <InsertParameters>
                                               <asp:Parameter Name="codigo" Type="Int32" />
                                               <asp:Parameter Name="codigo_cliente" Type="Int32" />
                                               <asp:Parameter Name="vencimento" Type="DateTime" />
                                               <asp:Parameter Name="valor" Type="Double" />
                                               <asp:Parameter Name="nosso_numero" Type="String" />
                                               <asp:Parameter Name="documento" Type="String" />
                                               <asp:Parameter Name="observacao" Type="String" />
                                               <asp:Parameter Name="status" Type="Int32" />
                                               <asp:Parameter Name="boleto" Type="String" />
                                           </InsertParameters>
                                       </asp:ObjectDataSource>

                                       <asp:ObjectDataSource ID="ObjectDataSource2" runat="server" 
                                           SelectMethod="PopulaAnuncio" TypeName="WebService">
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


                                       &nbsp;
                                       

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
                                           onselectedindexchanged="grdDados_SelectedIndexChanged">
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
                                                    <asp:LinkButton ID="lkbSelecione" runat="server" CausesValidation="False" CommandName="Select" Text="Selecione" />
                                                 </ItemTemplate>                                                                                                  
                                              </asp:TemplateField>
                                              <asp:TemplateField ShowHeader="False">
                                                 <ItemTemplate>
                                                    <asp:LinkButton ID="lkbGerar" runat="server" CausesValidation="False" CommandName="Gerar" Text="Gerar" />
                                                 </ItemTemplate>                                                                                                  
                                              </asp:TemplateField>
                                                <asp:TemplateField HeaderText="Codigo" SortExpression="codigo">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblCodigo" Width="0px" runat="server" Text='<%# Eval("codigo") %>' ForeColor="#FFFBD6"  />
                                                   </ItemTemplate>                                        
                                                </asp:TemplateField>                      
                                               <asp:TemplateField HeaderText="Anunciante">
                                                   <ItemTemplate>
                                                       <asp:Label ID="lblAnunciante" Font-Bold="true" Width="200px" runat="server" Text=""></asp:Label>
                                                       <asp:Label ID="lblCodigoCliente" runat="server" Text='<%# Eval("codigo_cliente") %>' Visible="false"></asp:Label>
                                                   </ItemTemplate>
                                               </asp:TemplateField>
                                                <asp:TemplateField HeaderText="Vencimento" SortExpression="vencimento">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblVencimento" Width="100px" runat="server" Text='<%# Eval("vencimento") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                     
                                                <asp:TemplateField HeaderText="Valor" SortExpression="valor">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblValor" Width="100px" runat="server" Text='<%# Eval("valor") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                      
                                                <asp:TemplateField HeaderText="Nosso Numero" SortExpression="nosso_numero">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblNossoNumero" Width="100px" runat="server" Text='<%# Eval("nosso_numero") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="Documento" SortExpression="documento">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblDocumento" Width="100px" runat="server" Text='<%# Eval("documento") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                       
                                                <asp:TemplateField HeaderText="Observação" SortExpression="observacao">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblObservacao" Width="150px" runat="server" Text='<%# Eval("observacao") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>
                                                <asp:TemplateField HeaderText="Boleto" SortExpression="boleto">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblBoleto" Width="100px" runat="server" Text='<%# Eval("boleto") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                                                                                                                                                    
                                               <asp:TemplateField HeaderText="Status">
                                                   <ItemTemplate>
                                                       <asp:DropDownList ID="ddlStatus" Width="50px" runat="server" SelectedValue='<%# Bind("status")%>' Enabled="false" >
                                                           <asp:ListItem Text="Ativo" Value="1"></asp:ListItem>
                                                           <asp:ListItem Text="Inativo" Value="0"></asp:ListItem>
                                                       </asp:DropDownList>
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
                      &nbsp;</td>
                  <td align="center">
                      <asp:Panel ID="panelBoleto" runat="server">
                      </asp:Panel>
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
