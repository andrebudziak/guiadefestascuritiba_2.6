using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class detalhe_categoria : System.Web.UI.Page
{
    private WebService ws = new WebService();
    private string vIdAnuncio;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            vIdAnuncio = Session["id_anuncio"].ToString();
            DataSet dadosT = new DataSet();
            dadosT = ws.ConsultaAnuncioAtivo(Convert.ToInt32(vIdAnuncio), "0");
            
            if (dadosT.Tables[0].Rows.Count != 0)
            {
                lblNomeFantasia.Text = dadosT.Tables[0].Rows[0]["nome_fantasia"].ToString();

                lblBairroCidade.Text = dadosT.Tables[0].Rows[0]["bairro"].ToString() + "-" + dadosT.Tables[0].Rows[0]["cidade"].ToString();

                lblEndereco.Text = dadosT.Tables[0].Rows[0]["endereco"].ToString();

                lblTelefone.Text = dadosT.Tables[0].Rows[0]["telefone"].ToString();

                lblSite.Text = dadosT.Tables[0].Rows[0]["site"].ToString();

                lblEmail.Text = dadosT.Tables[0].Rows[0]["email"].ToString();

                string endereco = dadosT.Tables[0].Rows[0]["endereco"].ToString() + " " + dadosT.Tables[0].Rows[0]["bairro"].ToString() + "-" + dadosT.Tables[0].Rows[0]["cidade"].ToString();
                string info = dadosT.Tables[0].Rows[0]["nome_fantasia"].ToString() + "</br>" + endereco;

                lblMapa.Text = "<iframe runat='server' id='frmMapa' frameborder='0' width='600px' height='400px' src='mapa.aspx?endereco=" + endereco + "&info=" + dadosT.Tables[0].Rows[0]["nome_fantasia"].ToString() + "'></iframe>";
            }


        }

    }
}