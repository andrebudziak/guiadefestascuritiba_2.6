using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class detalhe_oferta : System.Web.UI.Page
{
    WebService ws = new WebService();

    private void Page_PreInit(object sender, EventArgs e)
    {
        Session["menu"] = "0";
    }


    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            if (Session["oferta"] != null)
            {
                recarregaLayout();

                string codigo = Session["oferta"].ToString();
                DataSet dados = ws.ConsultaOfertaTela(Convert.ToInt32(codigo), "0");
                ddlOferta.DataSource = dados;
                ddlOferta.DataBind();

                
            
            }        
        }
    }

    protected void ddlOferta_ItemDataBound(object sender, DataListItemEventArgs e)
    {
        DataRowView dbr = (DataRowView)e.Item.DataItem;
        if (Convert.ToString(DataBinder.Eval(dbr, "oferta")) != "")
        {
            Image img = (Image)e.Item.FindControl("imgOferta");
            string imagem = Page.ResolveUrl("~/ofertas/" + Convert.ToString(DataBinder.Eval(dbr, "oferta")));
            img.ImageUrl = imagem;
        }

    }

    private void recarregaLayout()
    {
        imgTopoOfDet.ImageUrl = Page.ResolveUrl("~/imagens/barraOFERTA.jpg");

    }


}