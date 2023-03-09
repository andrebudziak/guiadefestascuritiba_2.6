<%@ Page Language="C#" AutoEventWireup="true" CodeFile="Default2.aspx.cs" Inherits="Administracao_Default2" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    
    <form id="form1" runat="server">
    <div>
    <asp:Panel ID="panelDados" runat="server">
    <h3>
        Dados do Boleto</h3>
    <table border="0">
        <tr>
            <td>
                Vencimento:
            </td>
            <td>
                <asp:TextBox ID="txtVencimento" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Valor:
            </td>
            <td>
                <asp:TextBox ID="txtValorBoleto" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Nosso Número:
            </td>
            <td>
                <asp:TextBox ID="txtNossoNumeroBoleto" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Número Documento:
            </td>
            <td>
                <asp:TextBox ID="txtNumeroDocumentoBoleto" runat="server"></asp:TextBox>
            </td>
        </tr>        
    </table>
    <br />
    <h3>
        Dados do Cendente</h3>
    <table border="0">
        <tr>
            <td>
                CPF/CNPJ:
            </td>
            <td>
                <asp:TextBox ID="txtCPFCNPJ" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Código:
            </td>
            <td>
                <asp:TextBox ID="txtCodigoCedente" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Nome:
            </td>
            <td>
                <asp:TextBox ID="txtNomeCedente" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Agência:
            </td>
            <td>
                <asp:TextBox ID="txtAgenciaCendente" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Conta:
            </td>
            <td>
                <asp:TextBox ID="txtContaCedente" runat="server"></asp:TextBox>
            </td>
        </tr>
    </table>
    <br />
    <h3>
        Dados do Sacado</h3>
    <table border="0">
        <tr>
            <td>
                CPF/CNPJ:
            </td>
            <td>
                <asp:TextBox ID="txtCPFCNPJSacado" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Nome:
            </td>
            <td>
                <asp:TextBox ID="txtNomeSacado" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Endereço:
            </td>
            <td>
                <asp:TextBox ID="txtEnderecoSacado" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Bairro:
            </td>
            <td>
                <asp:TextBox ID="txtBairroSacado" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                Cidade:
            </td>
            <td>
                <asp:TextBox ID="txtCidadeSacado" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                CEP:
            </td>
            <td>
                <asp:TextBox ID="txtCEPSacado" runat="server"></asp:TextBox>
            </td>
        </tr>
        <tr>
            <td>
                UF:
            </td>
            <td>
                <asp:TextBox ID="txtUFSacado" runat="server"></asp:TextBox>
            </td>
        </tr>
    </table>
    </asp:Panel>
    <asp:Panel ID="panelBoleto" runat="server"></asp:Panel>
        <%--    <bol:BoletoBancario id="santander" runat="server" CodigoBanco="33">
    </bol:BoletoBancario>--%>
    <asp:Button ID="btnImprimirBoleto" runat="server" Text="Imprimir " onclick="Button1_Click"  />
        <asp:Button ID="btnGeraPdf" runat="server" onclick="btnGeraPdf_Click" 
            Text="Gera PDF" />
    </div>
    </form>
</body>
</html>
