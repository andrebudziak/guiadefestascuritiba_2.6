using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class oferta : System.Web.UI.Page
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
            DataSet dados = ws.ConsultaOfertaTela(0, "0");
            ddlOferta.DataSource = dados;
            ddlOferta.DataBind();        
        }

    }

    protected void ddlOferta_ItemCommand(object source, DataListCommandEventArgs e)
    {
        if (e.CommandName == "Visualizar")
        {

            WebControl wc = ((WebControl)e.CommandSource);
            DataListItem row = ((DataListItem)wc.NamingContainer);

            ImageButton lkbItem = ((ImageButton)ddlOferta.Items[row.ItemIndex].FindControl("btnImgMiniatura"));
            int codigo = Convert.ToInt32(lkbItem.CommandArgument);
            Session["oferta"] = codigo;
            DataSet dados = ws.ConsultaOfertaTela(codigo, "0");
            string descricao = dados.Tables[0].Rows[0]["nome_fantasia"].ToString();

            UrlRewrite urlr = new UrlRewrite();
            descricao = urlr.RemoveSpecialCharacters(descricao);

            Response.Redirect("~/Oferta/" + descricao);
        }
    }

    protected void ddlOferta_ItemDataBound(object sender, DataListItemEventArgs e)
    {
        DataRowView dbr = (DataRowView)e.Item.DataItem;
        if (Convert.ToString(DataBinder.Eval(dbr, "miniatura")) != "")
        {
            ImageButton img = (ImageButton)e.Item.FindControl("btnImgMiniatura");
            string imagem = Page.ResolveUrl("~/ofertas/" + Convert.ToString(DataBinder.Eval(dbr, "miniatura")));
            img.ImageUrl = imagem;
        }

        if (Convert.ToString(DataBinder.Eval(dbr, "validade")) != "")
        {
            Label lblValidade = (Label)e.Item.FindControl("lblValidade");
            DateTime data = Convert.ToDateTime(DataBinder.Eval(dbr, "validade"));
            lblValidade.Text = data.ToString("dd/MM/yyyy");
        }

        Image imgC = (Image)e.Item.FindControl("imgConferir");
        string imagemC = Page.ResolveUrl("~/imagens/conferirOFERTA.jpg");
        imgC.ImageUrl = imagemC;

    }

    protected void ddlFiltro_SelectedIndexChanged(object sender, EventArgs e)
    {
        DataSet dados = ws.ConsultaOfertaTela(0, "0"); 
        DataTable table = dados.Tables["oferta"];
        DataView view = table.DefaultView;

        view.Sort = ddlFiltro.SelectedValue;

        ddlOferta.DataSource = view;
        ddlOferta.DataBind();

    }



}