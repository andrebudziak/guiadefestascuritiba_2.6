<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Tema.master" CodeFile="tema.aspx.cs" Inherits="tema" %>

<%@ Register Assembly="AjaxControlToolkit" Namespace="AjaxControlToolkit" TagPrefix="cc1" %>

<asp:Content ID="HeaderCont" runat="server" ContentPlaceHolderID="head">
</asp:Content>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">  

            <asp:DataList ID="dlDestaque" runat="server">
                <ItemTemplate>
                   <asp:Label ID="lblCodigo" runat="server" Visible="false" Text='<%# Eval("codigo") %>' />
                   <asp:Label ID="lblDestaque" runat="server" Text='<%# Eval("destaque") %>' />                      
                </ItemTemplate>
            </asp:DataList>

</asp:Content>