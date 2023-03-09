using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.Security;

public partial class Account_Login : System.Web.UI.Page
{
    Service ws = new Service();
    
    protected void Page_Load(object sender, EventArgs e)
    {

    }

    protected void LoginButton_Click(object sender, EventArgs e)
    {

        if (ws.authenticateUser(UserName.Text, Password.Text) == 0)
        {
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('Usuario e/ou Senha Invalido(s)! Verifique'); </script>", false);
            UserName.Text = "";
            Password.Text = "";
        }
        else
        {
            string senha = SenhaHASH(Convert.ToString(DateTime.Now));
            Session["hash"] = senha;
            Response.Redirect("~/Administracao/Default.aspx");
            UserName.Text = "";
            Password.Text = "";
        }

    }

    public string SenhaHASH(string Senha)
    {
        return FormsAuthentication.HashPasswordForStoringInConfigFile(Senha, "sha1");
    }



}
