<%@ Page Language="C#" AutoEventWireup="true" CodeFile="cadastro_agenda.aspx.cs" MasterPageFile="~/Cliente.master" Inherits="cadastro_agenda" %>
<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="asp" %>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  


           <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
               <tr>
                   <td>
                       &nbsp;</td>
                   <td>
                     
                   </td>
                   <td>
                      <asp:Label ID="lblHash" runat="server"></asp:Label>
                      <asp:Label ID="lblCodigoAnuncio" runat="server" Text=""></asp:Label>
                   </td>
               </tr>
               <tr>
                   <td>
                       &nbsp;</td>
                   <td align="left">
                                               &nbsp;</td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       &nbsp;</td>
                   <td align="center">
                       <asp:UpdatePanel ID="UpdatePanel1" runat="server" UpdateMode="Always">
                           <ContentTemplate>
                               <asp:GridView ID="grdBonus" runat="server" 
                                   AutoGenerateColumns="False" CellPadding="4" DataSourceID="ObjectDataSource1" 
                                   Font-Names="Arial" Font-Size="11px" ForeColor="#333333" GridLines="Horizontal" 
                                   ShowFooter="True" onrowcommand="grdBonus_RowCommand" 
                                   onrowcreated="grdBonus_RowCreated" onrowdeleting="grdBonus_RowDeleting" 
                                   AllowPaging="True" Width="800px" onrowdatabound="grdBonus_RowDataBound">
                                   <PagerSettings Position="Top" />
                                   <RowStyle BackColor="#FFFBD6" ForeColor="#333333" />
                                   <FooterStyle BackColor="#990000" Font-Bold="True" ForeColor="White" />
                                   <PagerStyle BackColor="#FFCC66" ForeColor="#333333" HorizontalAlign="Center" />
                                   <SelectedRowStyle BackColor="#FFCC66" Font-Bold="True" ForeColor="Navy" />
                                   <HeaderStyle BackColor="#990000" Font-Bold="True" ForeColor="White" />
                                   <EditRowStyle BackColor="Silver" />
                                   <AlternatingRowStyle BackColor="White" />
                                   <Columns>
                                       <asp:TemplateField ShowHeader="False">
                                          <EditItemTemplate>
                                             <asp:LinkButton ID="LinkButtonUpdate" runat="server" CausesValidation="true" CommandName="Update" Text="Atualizar" />
                                             <asp:LinkButton ID="LinkButtonCancel" runat="server" CausesValidation="False" CommandName="Cancel" Text="Cancelar" />
                                          </EditItemTemplate>
                                          <ItemTemplate>
                                             <asp:LinkButton ID="LinkButtonEdit" runat="server" CausesValidation="False" CommandName="Edit" Text="Editar" />
                                             <asp:LinkButton ID="LinkButtonDelete"  CssClass="deletar" runat="server" CausesValidation="False" CommandName="Delete"
                                                OnClientClick="return confirm('Deseja excluir o registro?');" Text="Deletar" />
                                          </ItemTemplate>
                                          <FooterTemplate>
                                             <asp:LinkButton ID="LinkButtonUpdate" runat="server" CausesValidation="true" CommandName="Save" Text="Salvar" />
                                          </FooterTemplate>
                                       </asp:TemplateField>
                                   
                                        <asp:TemplateField HeaderText="Codigo" SortExpression="codigo">
                                           <EditItemTemplate>
                                              <asp:TextBox ID="txtCodigo" runat="server" Width="20px" Text='<%# Bind("codigo") %>' />
                                           </EditItemTemplate>
                                           <ItemTemplate>
                                              <asp:Label ID="lblCodigo" runat="server" Text='<%# Bind("codigo") %>' />
                                           </ItemTemplate>
                                           <FooterTemplate>
                                              <asp:TextBox ID="txtCodigo" runat="server" Width="20px" />
                                           </FooterTemplate>
                                        </asp:TemplateField>
                                        <asp:TemplateField HeaderText="Data" SortExpression="data">
                                           <EditItemTemplate>
                                              <asp:TextBox ID="txtData" runat="server" Width="100px" Text='<%# Bind("data") %>' />
                                               <asp:CalendarExtender ID="txtDataE_CalendarExtender" runat="server" 
                                                  Enabled="True" TargetControlID="txtData">
                                               </asp:CalendarExtender>
                                           </EditItemTemplate>
                                           <ItemTemplate>
                                              <asp:Label ID="lblData" runat="server" Text='<%# Bind("data") %>' />
                                           </ItemTemplate>
                                           <FooterTemplate>
                                              <asp:TextBox ID="txtData" runat="server" Width="100px" />
                                               <asp:CalendarExtender ID="txtDataI_CalendarExtender" runat="server" 
                                                  Enabled="True" TargetControlID="txtData">
                                               </asp:CalendarExtender>
                                           </FooterTemplate>
                                        </asp:TemplateField>
                                        <asp:TemplateField HeaderText="Descrição" SortExpression="descricao">
                                           <EditItemTemplate>
                                              <asp:TextBox ID="txtDescricao" runat="server" Width="400px" Text='<%# Bind("descricao") %>' />
                                           </EditItemTemplate>
                                           <ItemTemplate>
                                              <asp:Label ID="lblDescricao" runat="server" Text='<%# Bind("descricao") %>' />
                                           </ItemTemplate>
                                           <FooterTemplate>
                                              <asp:TextBox ID="txtDescricao" runat="server" Width="400px" />
                                           </FooterTemplate>
                                        </asp:TemplateField>    
                                       <asp:TemplateField HeaderText="Status">
                                          <ItemTemplate>
                                                <asp:DropDownList ID="ddlStatus" Width="150px" Enabled="false" runat="server" SelectedValue='<%# Eval("codigo_status")%>'>
                                                   <asp:ListItem Value="1" Text="Ativo"></asp:ListItem>
                                                   <asp:ListItem Value="0" Text="Inativo"></asp:ListItem>
                                                </asp:DropDownList>
                                          </ItemTemplate>
                                          <EditItemTemplate>
                                             <asp:DropDownList ID="ddlStatus" Width="150px" runat="server" SelectedValue='<%# Eval("codigo_status")%>'>
                                                <asp:ListItem Value="1" Text="Ativo"></asp:ListItem>
                                                <asp:ListItem Value="0" Text="Inativo"></asp:ListItem>
                                             </asp:DropDownList>
                                          </EditItemTemplate>
                                          <FooterTemplate>
                                             <asp:DropDownList ID="ddlStatus" Width="150px" runat="server" >
                                                <asp:ListItem Value="1" Text="Ativo"></asp:ListItem>
                                                <asp:ListItem Value="0" Text="Inativo"></asp:ListItem>
                                             </asp:DropDownList>                                          
                                          </FooterTemplate>                                                                                          
                                       </asp:TemplateField>    
                                                                        
                                   </Columns>                                   
                                   
                               </asp:GridView>
                               <asp:Label ID="lblCodigo" runat="server"></asp:Label>
                               <asp:ObjectDataSource ID="ObjectDataSource1" runat="server" 
                                   DeleteMethod="ExcluirAgenda" InsertMethod="IncluirAgenda" 
                                   SelectMethod="ConsultaDadosAgenda" TypeName="WebService" 
                                   UpdateMethod="IncluirAgenda" onupdating="ObjectDataSource1_Updating" 
                                   ondeleting="ObjectDataSource1_Deleting" 
                                   oninserting="ObjectDataSource1_Inserting" 
                                   onselected="ObjectDataSource1_Selected">
                                   <DeleteParameters>
                                       <asp:Parameter Name="codigo" Type="Int32" />
                                   </DeleteParameters>
                                   <UpdateParameters>
                                       <asp:Parameter Name="codigo" Type="Int32" />
                                       <asp:Parameter Name="codigo_anuncio" Type="Int32" />
                                       <asp:Parameter Name="descricao" Type="String" />
                                       <asp:Parameter Name="data" Type="DateTime" />
                                       <asp:Parameter Name="status" Type="Int32" />
                                   </UpdateParameters>
                                   <SelectParameters>
                                       <asp:Parameter DefaultValue="0" Name="codigo_agenda" Type="Int32" />
                                   </SelectParameters>
                                   <InsertParameters>
                                       <asp:Parameter Name="codigo" Type="Int32" />
                                       <asp:Parameter Name="codigo_anuncio" Type="Int32" />
                                       <asp:Parameter Name="descricao" Type="String" />
                                       <asp:Parameter Name="data" Type="DateTime" />
                                       <asp:Parameter Name="status" Type="Int32" />
                                   </InsertParameters>
                               </asp:ObjectDataSource>
                               <asp:ObjectDataSource ID="ObjectDataSource2" runat="server" 
                                   SelectMethod="PopulaAnuncio" TypeName="WebService">
                               </asp:ObjectDataSource>
                               
                           </ContentTemplate>
                       </asp:UpdatePanel>
                   </td>
                   <td>
                       &nbsp;</td>
               </tr>
               <tr>
                   <td>
                       &nbsp;</td>
                   <td>
                       <asp:UpdateProgress ID="UpdateProgress1" runat="server" 
                           AssociatedUpdatePanelID="UpdatePanel1">
                           <ProgressTemplate>
                               <img alt="" src="imagens/wait.gif" 
    style="width: 50px; height: 50px" />Aguarde..
                           </ProgressTemplate>
                       </asp:UpdateProgress>
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
               </table>
 </asp:Content>