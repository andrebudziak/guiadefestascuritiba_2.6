<%@ Page Title="Login" Language="C#" MasterPageFile="~/Administracao/Site.master" AutoEventWireup="true"  CodeFile="Login.aspx.cs" Inherits="Account_Login" %>

<asp:Content ID="HeaderContent" runat="server" ContentPlaceHolderID="HeadContent">
</asp:Content>
<asp:Content ID="BodyContent" runat="server" ContentPlaceHolderID="MainContent">
       <table border="0" width="100%" cellspacing="0" cellpadding="0" height="25" background="mytnr/barra2.png">
   	   <tr>
	      <td>          
          </td>
	   </tr>
       </table>

            <table border="0" width="800" cellspacing="0" cellpadding="0" height="500" background="mytnr/fundologin.jpg" bgcolor="#EAEDEC">
				<tr>
					<td>
					<div align="center">

						<table border="0" width="180" height="220" cellspacing="0" cellpadding="0" background="mytnr/fundousuario.png">
							<tr>
								<td align="center">
								<p style="margin-top: 5px; margin-bottom: 7px">
								<font face="Verdana" style="font-weight: 700" size="2">
								Login do Usuário</font></p>
								<p style="margin-top: 0; margin-bottom: 7px">
								<font face="Verdana" style="font-size: 9pt">
								Usuário:</font></p>
								<p style="margin-top: 0; margin-bottom: 7px">
                                    <asp:TextBox ID="UserName" runat="server" Width="120px" CssClass="textEntry"></asp:TextBox>
                                    <asp:RequiredFieldValidator ID="UserNameRequired" runat="server" ControlToValidate="UserName" 
                                         CssClass="failureNotification" ErrorMessage="Nome de usuario obrigatório." ToolTip="Nome de usuário obrigatório." 
                                         ValidationGroup="LoginUserValidationGroup">*</asp:RequiredFieldValidator>
								
                                </p>
								<p style="margin-top: 0; margin-bottom: 7px">
								<font face="Verdana" style="font-size: 9pt">
								Senha:</font></p>
								<p style="margin-top: 0; margin-bottom: 7px">
                                    <asp:TextBox ID="Password" runat="server" CssClass="passwordEntry" Width="120px" TextMode="Password"></asp:TextBox>
                                    <asp:RequiredFieldValidator ID="PasswordRequired" runat="server" ControlToValidate="Password" 
                                         CssClass="failureNotification" ErrorMessage="Senha é obrigatório." ToolTip="Senha é obrigatório." 
                                         ValidationGroup="LoginUserValidationGroup">*</asp:RequiredFieldValidator>
								
                                </p>
								<p style="margin-top: 0; margin-bottom: 7px">
                                    <asp:Button ID="LoginButton" runat="server" CommandName="Login" Text="Login" 
                                        ValidationGroup="LoginUserValidationGroup" onclick="LoginButton_Click"/>
								
                                </p>
								<p style="margin-top: 0; margin-bottom: 7px">
								<font face="Verdana" style="font-size: 9pt">
								Esqueceu sua Senha?</font></td>
							</tr>
						</table>
					</div>
					</td>
				</tr>
			</table>
    
</asp:Content>