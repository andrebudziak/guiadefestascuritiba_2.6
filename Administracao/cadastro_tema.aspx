<%@ Page Language="C#" AutoEventWireup="true" CodeFile="cadastro_tema.aspx.cs" MasterPageFile="~/Administracao/Site.master" Inherits="Administracao_cadastro_tema" %>
<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="asp" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">
<script src="../Scripts/jquery-1.4.4.min.js" type="text/javascript"></script>
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
                                           Width="200px">
                                       </asp:DropDownList>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label19" runat="server" CssClass="label" Text="Descrição:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtDescricao" runat="server" CssClass="edit" Width="150px"></asp:TextBox>
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

                                       <asp:TextBox ID="txtEmail" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label16" runat="server" CssClass="label" Text="Site:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtSite" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label18" runat="server" CssClass="label" Text="Foto:"></asp:Label>
                                   </td>
                                   <td align="left">
                                        <asp:AsyncFileUpload ID="fileUploadArquivo" runat="server" 
                                                   CompleteBackColor="#B9FFB9" CssClass="botao" 
                                                   OnClientUploadComplete="uploadComplete" 
                                                   OnClientUploadStarted="startUpload" 
                                                   OnClientUploadError="uploadError" 
                                                   ThrobberID="Throbber" 
                                                   onuploadedcomplete="AsyncFileUpload1_UploadedComplete" 
                                                   UploadingBackColor="#CCFFFF" Width="300px" />

                                        <asp:Label ID="Throbber" runat="server" Style="display: none">
                                            <img src="mytnr/indicator.gif" align="absmiddle" alt="carregando..." />Aguarde...
                                        </asp:Label>
                                        <asp:TextBox ID="txtArquivo" runat="server" BorderStyle="None" 
                                            ForeColor="White"></asp:TextBox>
                                   
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
                                        <div id="uploadMessage"><p></p></div>                                   
                                   </td>
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
                                           DeleteMethod="ExcluirTema" InsertMethod="IncluirTema" 
                                           SelectMethod="ConsultaTema" TypeName="WebService" 
                                           UpdateMethod="IncluirTema" ondeleting="ObjectDataSource1_Deleting" 
                                           oninserting="ObjectDataSource1_Inserting" 
                                           onselecting="ObjectDataSource1_Selecting">
                                           <DeleteParameters>
                                               <asp:Parameter Name="codigo" Type="Int32" />
                                           </DeleteParameters>                                   
                                           <UpdateParameters>
                                               <asp:Parameter Name="codigo" Type="Int32" />
                                               <asp:Parameter Name="codigo_cliente" Type="Int32" />
                                               <asp:Parameter Name="cep" Type="String" />
                                               <asp:Parameter Name="bairro" Type="String" />
                                               <asp:Parameter Name="cidade" Type="String" />
                                               <asp:Parameter Name="endereco" Type="String" />
                                               <asp:Parameter Name="telefone" Type="String" />
                                               <asp:Parameter Name="email" Type="String" />
                                               <asp:Parameter Name="site" Type="String" />
                                               <asp:Parameter Name="status" Type="Int32" />
                                               <asp:Parameter Name="foto" Type="String" />
                                           </UpdateParameters>
                                           <SelectParameters>
                                               <asp:Parameter DefaultValue="0" Name="codigo" Type="Int32" />
                                               <asp:Parameter DefaultValue="0" Name="nome" Type="String" />                                       
                                           </SelectParameters>
                                           <InsertParameters>
                                               <asp:Parameter Name="codigo" Type="Int32" />
                                               <asp:Parameter Name="codigo_cliente" Type="Int32" />
                                               <asp:Parameter Name="cep" Type="String" />
                                               <asp:Parameter Name="bairro" Type="String" />
                                               <asp:Parameter Name="cidade" Type="String" />
                                               <asp:Parameter Name="endereco" Type="String" />
                                               <asp:Parameter Name="telefone" Type="String" />
                                               <asp:Parameter Name="email" Type="String" />
                                               <asp:Parameter Name="site" Type="String" />
                                               <asp:Parameter Name="status" Type="Int32" />
                                               <asp:Parameter Name="foto" Type="String" />
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
                                           GridLines="None" Width="1024px" AllowPaging="True" 
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
                                                      <asp:Label ID="lblCodigo" Width="0px" runat="server" Text='<%# Eval("codigo") %>' ForeColor="#FFFBD6"  />
                                                   </ItemTemplate>                                        
                                                </asp:TemplateField>                      
                                               <asp:TemplateField HeaderText="Anunciante">
                                                   <ItemTemplate>
                                                       <asp:DropDownList ID="ddlCliente" Width="150px" runat="server" Enabled="false" 
                                                          DataTextField="nome_fantasia" DataValueField="codigo" SelectedValue='<%# Bind("codigo_cliente")%>'
                                                           DataSourceID="ObjectDataSource2">                                                   
                                                       </asp:DropDownList>
                                                   </ItemTemplate>
                                               </asp:TemplateField>
                                                <asp:TemplateField HeaderText="Descrição" SortExpression="descricao">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblDescricao" Width="100px" runat="server" Text='<%# Eval("descricao") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                      
                                                <asp:TemplateField HeaderText="Cep" SortExpression="cep">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblCep" Width="100px" runat="server" Text='<%# Eval("cep") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                      
                                                <asp:TemplateField HeaderText="Bairro" SortExpression="bairro">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblBairro" Width="100px" runat="server" Text='<%# Eval("bairro") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                        
                                                <asp:TemplateField HeaderText="Cidade" SortExpression="cidade">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblCidade" Width="100px" runat="server" Text='<%# Eval("cidade") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                       
                                                <asp:TemplateField HeaderText="Endereço" SortExpression="endereco">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblEndereco" Width="150px" runat="server" Text='<%# Eval("endereco") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                                                              
                                                <asp:TemplateField HeaderText="Telefone" SortExpression="telefone">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblTelefone" Width="100px" runat="server" Text='<%# Eval("telefone") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>
                                                <asp:TemplateField HeaderText="E-mail" SortExpression="email">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblEmail" Width="200px" runat="server" Text='<%# Eval("email") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>                                       
                                                <asp:TemplateField HeaderText="Site" SortExpression="site">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblSite" Width="200px" runat="server" Text='<%# Eval("site") %>' />
                                                   </ItemTemplate>
                                                </asp:TemplateField>
                                                <asp:TemplateField HeaderText="Arquivo" SortExpression="arquivo">
                                                   <ItemTemplate>
                                                      <asp:Label ID="lblArquivo" Width="200px" runat="server" Text='<%# Eval("foto") %>' />
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
