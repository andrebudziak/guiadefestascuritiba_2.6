<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Administracao/Site.master" CodeFile="cadastro_cliente.aspx.cs" Inherits="Administracao_cadastro_cliente" %>

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
                                       <asp:Label ID="Label13" runat="server" CssClass="label" Text="Nome Fantasia:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtNomeFantasia" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label18" runat="server" CssClass="label" Text="Razão Social:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtRazaoSocial" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label21" runat="server" CssClass="label" Text="C.N.P.J:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtCNPJ" runat="server" CssClass="edit" Width="150px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label19" runat="server" CssClass="label" Text="C.P.Fl:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtCPF" runat="server" CssClass="edit" Width="150px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label20" runat="server" CssClass="label" Text="R.G:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtRg" runat="server" CssClass="edit" Width="150px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label9" runat="server" CssClass="label" Text="Cep:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtCep" runat="server" CssClass="edit" Width="100px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label10" runat="server" CssClass="label" Text="Bairro:"></asp:Label>
                                   </td>
                                   <td align="left">
                                  
                                       <asp:TextBox ID="txtBairro" runat="server" CssClass="edit" Width="150px" ></asp:TextBox>
                                  
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label11" runat="server" CssClass="label" Text="Cidade:"></asp:Label>
                                   </td>
                                   <td align="left">
                                      
                                       <asp:TextBox ID="txtCidade" runat="server" CssClass="edit" Width="150px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label12" runat="server" CssClass="label" Text="Endereço:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtEndereco" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label14" runat="server" CssClass="label" Text="Telefone:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtTelefone" runat="server" CssClass="edit" Width="150px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label15" runat="server" CssClass="label" Text="E-mail:"></asp:Label>
                                   </td>
                                   <td align="left">
                                    <asp:Label ID="Throbber" runat="server" Style="display: none">
                                        <img src="mytnr/indicator.gif" align="absmiddle" alt="carregando..." />Aguarde...
                                    </asp:Label>

                                       <asp:TextBox ID="txtEmail" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label16" runat="server" CssClass="label" Text="Responsavel:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtResponsavel" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
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
                                           DeleteMethod="ExcluirCliente" InsertMethod="IncluirCliente" 
                                           SelectMethod="ConsultaCliente" TypeName="WebService" 
                                           UpdateMethod="IncluirCliente" ondeleting="ObjectDataSource1_Deleting" 
                                           oninserting="ObjectDataSource1_Inserting" 
                                           onselecting="ObjectDataSource1_Selecting">
                                           <DeleteParameters>
                                               <asp:Parameter Name="codigo" Type="Int32" />
                                           </DeleteParameters>                                   
                                           <UpdateParameters>
                                               <asp:Parameter Name="codigo" Type="Int32" />
                                               <asp:Parameter Name="razao_social" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="nome_fantasia" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="cnpj" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="cpf" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="rg" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="endereco" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="cep" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="bairro" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="cidade" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="email" DefaultValue=""  Type="String" />
                                               <asp:Parameter Name="responsavel" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="telefone" DefaultValue="" Type="String" />
                                           </UpdateParameters>
                                           <SelectParameters>
                                               <asp:Parameter DefaultValue="0" Name="codigo" Type="Int32" />
                                               <asp:Parameter DefaultValue="0" Name="nome" Type="String" />                                       
                                           </SelectParameters>
                                           <InsertParameters>
                                               <asp:Parameter Name="codigo" Type="Int32" />
                                               <asp:Parameter Name="razao_social" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="nome_fantasia" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="cnpj" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="cpf" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="rg" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="endereco" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="cep" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="bairro" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="cidade" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="email" DefaultValue=""  Type="String" />
                                               <asp:Parameter Name="responsavel" DefaultValue="" Type="String" />
                                               <asp:Parameter Name="telefone" DefaultValue="" Type="String" />
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
                                           GridLines="None" Width="100%" AllowPaging="True" 
                                           DataSourceID="ObjectDataSource1" onrowdeleting="grdDados_RowDeleting" 
                                           onrowcommand="grdDados_RowCommand" onrowdatabound="grdDados_RowDataBound">
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
                                                      <asp:Label ID="lblCodigo" runat="server" Text='<%# Eval("codigo") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>
                                                <asp:TemplateField HeaderText="Nome Fantasia" SortExpression="nome_fantasia">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblNomeFantasia" runat="server" Text='<%# Eval("nome_fantasia") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                                                                            
                                                <asp:TemplateField HeaderText="Razão Social" SortExpression="razao_social">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblRazaoSocial" runat="server" Text='<%# Eval("razao_social") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="C.N.P.J" SortExpression="cnpj">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblCnpj" runat="server" Text='<%# Eval("cnpj") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="C.P.F" SortExpression="cpf">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblCpf" runat="server" Text='<%# Eval("cpf") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="R.G" SortExpression="rg">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblRg" runat="server" Text='<%# Eval("rg") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="Endereço" SortExpression="endereco">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblEndereco" runat="server" Text='<%# Eval("endereco") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                       
                                                <asp:TemplateField HeaderText="Bairro" SortExpression="bairro">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblBairro" runat="server" Text='<%# Eval("bairro") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="Cidade" SortExpression="cidade">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblCidade" runat="server" Text='<%# Eval("cidade") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="Cep" SortExpression="cep">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblCep" runat="server" Text='<%# Eval("cep") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="E-mail" SortExpression="email">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblEmail" runat="server" Text='<%# Eval("email") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="Responsavel" SortExpression="responsavel">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblResponsavel" runat="server" Text='<%# Eval("responsavel") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="Telefone" SortExpression="telefone">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblTelefone" runat="server" Text='<%# Eval("telefone") %>' />
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
