<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Administracao/Site.master" CodeFile="cadastro_video.aspx.cs" Inherits="Administracao_cadastro_video" %>

<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="asp" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">
<script src="../Scripts/jquery-1.4.4.min.js" type="text/javascript"></script>
<script type="text/javascript">

    function startUploadM(sender, args) {
        $('#uploadMessageM p').html();
        $('#uploadMessageM').hide();
    }

    function uploadCompleteM(sender, args) {
        showUploadMessageM(" Concluido Upload de - " + args.get_fileName() + " - Tamanho - " + args.get_length() + " bytes", '');
        $('#<%= txtArquivoMiniatura.ClientID %>').val(args.get_fileName());

    }

    function uploadErrorM(sender, args) {
        showUploadMessageM("Erro ao realizar upload. " + args.get_errorMessage(), '#ff0000');
    }

    function showUploadMessageM(text, color) {
        $('#uploadMessageM p').html(text).css('color', color);
        $('#uploadMessageM').show();
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
                                           Width="200px" CssClass="edit">
                                       </asp:DropDownList>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label18" runat="server" CssClass="label" Text="Titulo:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtTitulo" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label19" runat="server" CssClass="label" Text="Descrição:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtDescricao" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label9" runat="server" CssClass="label" Text="Video:"></asp:Label>
                                   </td>
                                   <td align="left">
                                       <asp:TextBox ID="txtVideo" runat="server" CssClass="edit" Width="200px"></asp:TextBox>
                                   </td>
                                   <td>
                                       &nbsp;</td>
                               </tr>
                               <tr>
                                   <td align="right">
                                       <asp:Label ID="Label10" runat="server" CssClass="label" Text="Miniatura:"></asp:Label>
                                   </td>
                                   <td align="left">
                                        <asp:AsyncFileUpload ID="fileUploadMiniatura" runat="server" 
                                                   CompleteBackColor="#B9FFB9" CssClass="botao" 
                                                   OnClientUploadComplete="uploadCompleteM" 
                                                   OnClientUploadStarted="startUploadM" 
                                                   OnClientUploadError="uploadErrorM" 
                                                   ThrobberID="ThrobberM" 
                                                   onuploadedcomplete="AsyncFileUpload1_UploadedCompleteM" 
                                                   UploadingBackColor="#CCFFFF" Width="300px" />

                                        <asp:Label ID="ThrobberM" runat="server" Style="display: none">
                                            <img src="mytnr/indicator.gif" align="absmiddle" alt="carregando..." />Aguarde...
                                        </asp:Label>
                                        <asp:TextBox ID="txtArquivoMiniatura" runat="server" BorderStyle="None" 
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
                                        <div id="uploadMessageM"><p></p></div>                                   
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
                                           DeleteMethod="ExcluirVideo" InsertMethod="IncluirVideo" 
                                           SelectMethod="ConsultaVideo" TypeName="WebService" 
                                           UpdateMethod="IncluirVideo" ondeleting="ObjectDataSource1_Deleting" 
                                           oninserting="ObjectDataSource1_Inserting" 
                                           onselecting="ObjectDataSource1_Selecting">
                                       <DeleteParameters>
                                           <asp:Parameter Name="codigo" Type="Int32" />
                                       </DeleteParameters>
                                       <UpdateParameters>
                                           <asp:Parameter Name="codigo" Type="Int32" />
                                           <asp:Parameter Name="video" Type="String" />
			                               <asp:Parameter Name="miniatura" Type="String" />	
			                               <asp:Parameter Name="codigo_anuncio" Type="Int32" />
			                               <asp:Parameter Name="status" Type="Int32" />
    			                           <asp:Parameter Name="descricao" Type="String" />	
			                               <asp:Parameter Name="titulo" Type="String" />	
                                       </UpdateParameters>
                                       <SelectParameters>
                                           <asp:Parameter DefaultValue="0" Name="codigo" Type="Int32" />
                                           <asp:Parameter DefaultValue="0" Name="descricao" Type="String" />
                                       </SelectParameters>
                                       <InsertParameters>
                                           <asp:Parameter Name="codigo" Type="Int32" />
                                           <asp:Parameter Name="video" Type="String" />
			                               <asp:Parameter Name="miniatura" Type="String" />	
			                               <asp:Parameter Name="codigo_anuncio" Type="Int32" />
			                               <asp:Parameter Name="status" Type="Int32" />
    			                           <asp:Parameter Name="descricao" Type="String" />	
			                               <asp:Parameter Name="titulo" Type="String" />	
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
                                                  <asp:Label ID="lblCodigo" runat="server" Text='<%# Eval("codigo") %>' />
                                               </ItemTemplate>
                                            </asp:TemplateField>
                                            <asp:TemplateField HeaderText="Anunciante">
                                               <ItemTemplate>
                                                   <asp:DropDownList ID="ddlCliente" runat="server" Enabled="false" Width="250px"
                                                      DataTextField="nome_fantasia" DataValueField="codigo" SelectedValue='<%# Bind("codigo_anuncio")%>'
                                                       DataSourceID="ObjectDataSource2">                                                   
                                                   </asp:DropDownList>
                                               </ItemTemplate>
                                           </asp:TemplateField>
                                            <asp:TemplateField HeaderText="Titulo" SortExpression="titulo">
                                               <ItemTemplate>
                                                  <asp:Label ID="lblTitulo" runat="server" Text='<%# Eval("titulo") %>' />
                                               </ItemTemplate>
                                            </asp:TemplateField>
                                            <asp:TemplateField HeaderText="Descrição" SortExpression="descricao">
                                               <ItemTemplate>
                                                  <asp:Label ID="lblDescricao" runat="server" Text='<%# Eval("descricao") %>' />
                                               </ItemTemplate>
                                            </asp:TemplateField>
                                            <asp:TemplateField HeaderText="Video" SortExpression="video">
                                               <ItemTemplate>
                                                  <asp:Label ID="lblVideo" runat="server" Text='<%# Eval("video") %>' />
                                               </ItemTemplate>
                                            </asp:TemplateField>
                                            <asp:TemplateField HeaderText="Miniatura" SortExpression="miniatura">
                                               <ItemTemplate>
                                                  <asp:Label ID="lblMiniatura" runat="server" Text='<%# Eval("miniatura") %>' />
                                               </ItemTemplate>
                                            </asp:TemplateField>                                       
                                           <asp:TemplateField HeaderText="Status">
                                              <ItemTemplate>
                                                 <asp:DropDownList ID="ddlStatus" Width="65px" runat="server" SelectedValue='<%# Bind("status")%>' Enabled="false" >
                                                    <asp:ListItem Value="1" Text="Ativo"></asp:ListItem>
                                                    <asp:ListItem Value="0" Text="Inativo"></asp:ListItem>
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