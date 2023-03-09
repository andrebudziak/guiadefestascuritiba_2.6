using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class Account_Default : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            if (Session["hash"] != null)
            {
            }
            else
            {
                Response.Redirect("login.aspx");
            }
        }
    }

    protected void lbtnCadastroAnuncio_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_anuncio.aspx");
    }

    protected void lbtnCadastroLinkAnuncio_Click(object sender, EventArgs e)
    {
       Response.Redirect("cadastro_link.aspx");
    }

    protected void lbtnCadastroLogo_Click(object sender, EventArgs e)
    {
       Response.Redirect("cadastro_logo.aspx");
    }

    protected void lbtnCadastroBanner_Click(object sender, EventArgs e)
    {
       Response.Redirect("cadastro_banner.aspx");
    }

    protected void lbtnCadastroCategoria_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_categoria.aspx");
    }

    protected void lbtnCadastroLogin_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_usuario.aspx");
    }

    protected void lbtnCadastroCliente_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_cliente.aspx");
    }

    protected void lbtnCadastroDestaque_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_destaque.aspx");
    }

    protected void lbtnCadastroCategoriaAnuncio_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_categoria_anuncio.aspx");
    }

    protected void lbtnCadastroSinonimo_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_sinonimo.aspx");
    }

    protected void lbtnCadastroAnuncioSinonimo_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_sinonimo_anuncio.aspx");
    }

    protected void lbtnCadastroCategoriaBanner_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_categoria_banner.aspx");
    }

    protected void lbtnCadastroTema_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_tema.aspx");
    }

    protected void lbtnCadastroCategoriaTema_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_categoria_tema.aspx");
    }

    protected void lbtnCadastroConvite_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_convite.aspx");
    }

    protected void lbtnCadastroCategoriaConvite_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_categoria_convite.aspx");
    }

    protected void lbtnCadastroOferta_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_oferta.aspx");
    }

    protected void lbtnCadastroVideo_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_video.aspx");
    }
    protected void lbtnRelatorioAtivos_Click(object sender, EventArgs e)
    {
        Response.Redirect("RelatorioAtivos.aspx");
    }

    protected void lbtnRelatorioBanner_Click(object sender, EventArgs e)
    {
        Response.Redirect("RelatorioBanner.aspx");
    }
    

}