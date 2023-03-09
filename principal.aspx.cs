using System;
using System.Collections;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Xml.Linq;


public partial class principal : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            lblHash.Visible = false;

            if (Request.QueryString["h"] != null)
            {
                lblHash.Text = Request.QueryString["h"].ToString();

                //'HTTP/1.1
                Response.CacheControl = "no-cache";
                Response.AddHeader("cache-control", "no-cache");
                //'HTTP/1.0
                Response.AddHeader("Pragma", "no-cache");
                Response.Expires = -1;// ' minutos até a expiração
                Response.ExpiresAbsolute = DateTime.Now; //' data de expiração
               
            }
            else
            {
                Response.Redirect("login.aspx");
            }
        }
    }


    protected void lbtnCliente_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_cliente.aspx?h="+lblHash.Text;
    }

    protected void lbtnAnuncio_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_anuncio.aspx?h=" + lblHash.Text;
    }

    protected void lbtnFinanceiro_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_financeiro.aspx?h=" + lblHash.Text;
    }

    protected void lbtnBanner_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_banner.aspx?h=" + lblHash.Text;
    }

    protected void lbtnBonus_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_bonus.aspx?h=" + lblHash.Text;
    }

    protected void lbtnCategoria_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_categoria.aspx?h=" + lblHash.Text;
    }

    protected void lbtnCategoriaAnuncio_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_categoria_anuncio.aspx?h=" + lblHash.Text;
    }

    protected void lbtnLinkAnuncio_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_link.aspx?h=" + lblHash.Text;

    }

    protected void lbtnLogo_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_logo.aspx?h=" + lblHash.Text;

    }

    protected void lbtnUsuario_Click(object sender, EventArgs e)
    {
        ifPrincial.Attributes["src"] = "cadastro_usuario.aspx?h=" + lblHash.Text;

    }

}
