using System;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;
using System.Collections;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using System.Web.Security;

public partial class _login : System.Web.UI.Page
{
    private string connstring = ConfigurationManager.AppSettings["ConnectionString"];

    protected void Page_Load(object sender, EventArgs e)
    {

    }

    protected void btnLogin_Click_Click(object sender, ImageClickEventArgs e)
    {
        Service ws = new Service();
        Int32 idUsuario = ws.authenticateUser(tedUsuario.Text,tedSenha.Text);
        if(idUsuario !=0)
        {
            string senha = SenhaHASH(Convert.ToString(DateTime.Now));            
            Session["h"] = senha;
            Session["idUsuario"] = idUsuario;
            Response.Redirect("cadastro_agenda.aspx");
            tedUsuario.Text = "";
            tedSenha.Text = "";

        }
        else
        {
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('Usuario e/ou Senha Invalido(s)! Verifique'); </script>", false);
            tedUsuario.Text = "";
            tedSenha.Text = "";
        }

    }

    public string SenhaHASH(string Senha)
    {
        return FormsAuthentication.HashPasswordForStoringInConfigFile(Senha, "sha1");
    }

}
