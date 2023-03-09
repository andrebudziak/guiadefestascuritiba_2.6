using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class detalhe_banner : System.Web.UI.Page
{
    private WebService ws = new WebService();
    private Int32 vIdAnuncio = 0;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            Session["id_anuncio"] = '1';

            DataSet dadosT = new DataSet();
            dadosT = ws.ConsultaAnuncioAtivo(vIdAnuncio, "0");
            Session["id_anuncio"] = vIdAnuncio;
            if (dadosT.Tables[0].Rows.Count != 0)
            {
                lblNomeFantasia.Text = dadosT.Tables[0].Rows[0]["nome_fantasia"].ToString();

                lblBairroCidade.Text = dadosT.Tables[0].Rows[0]["bairro"].ToString() + "-" + dadosT.Tables[0].Rows[0]["cidade"].ToString();

                lblEndereco.Text = dadosT.Tables[0].Rows[0]["endereco"].ToString();

                lblTelefone.Text = dadosT.Tables[0].Rows[0]["telefone"].ToString();

                lblSite.Text = dadosT.Tables[0].Rows[0]["site"].ToString();

                lblEmail.Text = dadosT.Tables[0].Rows[0]["email"].ToString();

            }


        }

    }
}