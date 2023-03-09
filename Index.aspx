<%@ page language="C#" autoeventwireup="true" MasterPageFile="~/Default.master"  CodeFile="Index.aspx.cs" Inherits="Index" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>

<asp:Content ID="HeaderCont" runat="server" ContentPlaceHolderID="HeadContent">
</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  
            <asp:DataList ID="dlDestaque" runat="server">
                <ItemTemplate>
                   <asp:Label ID="lblCodigo" runat="server" Visible="false" Text='<%# Eval("codigo") %>' />
                   <asp:Label ID="lblDestaque" runat="server" Text='<%# Eval("destaque") %>' />                      
                </ItemTemplate>
            </asp:DataList>


              <table border="0" cellpadding="0" cellspacing="0" style="width:380px;">
               <tr>
                   <td align="center" >


                       
     
                   </td>
               </tr>
				<tr>
                   <td align="center">
                       </td>
                 
               </tr>
				
				<tr>
                   <td align="center">
					</td>
                 
               </tr>
				<tr>
                   <td align="right">
                   
                   </td>
                 
               </tr>
               </table>
</asp:Content>


