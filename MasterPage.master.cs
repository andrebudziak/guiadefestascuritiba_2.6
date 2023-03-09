using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.Web.Security;
using System.Web.UI.HtmlControls;

public partial class MasterPage : System.Web.UI.MasterPage
{
    private int vTipoCategoria = 0, ht = 0;
    private WebService ws = new WebService();
    DataTable tabela = new DataTable();
    private DataSet dadosBanner = new DataSet();
    private DataSet dadosBannerTopo = new DataSet();
    PagedDataSource pds = new PagedDataSource();

    private void Page_PreInit(object sender, EventArgs e)
    {
        Session["menu"] = "0";
    }

    protected void Page_Load(object sender, EventArgs e)
    {

        if (!IsPostBack)
        {
            //CarregaLayout();

            //frmBannerMaior.Attributes["src"] = Page.ResolveUrl("~/slidemaior.aspx");
            CarregaSlideGrande();
            CarregaMenu();
            //GerMenu(grdMenuLocais, "1");
            //GerMenu(grdMenuDecoracao, "2");
            //GerMenu(grdMenuAlimentacao, "3");
            //GerMenu(grdMenuDiversao, "4");
            //GerMenu(grdMenuServico, "5");
            //GerMenu(grdMenuTipo, "6");
            
            //GerMenu(grdMenuSupLocal, "1");
            //GerMenu(grdMenuSupDecoracao, "2");
            //GerMenu(grdMenuSupAlimentacao, "3");
            //GerMenu(grdMenuSupDiversao, "4");
            //GerMenu(grdMenuSupServico, "5");
            //GerMenu(grdMenuSupTipo, "6");

            //banner lateral direito
            CarregaPublicidadeLateral();

        }
    }

    private void GerMenu(GridView grd, string op)
    {
        DataSet dados = ws.montamenu(op);
        grd.DataSource = dados;
        grd.DataBind();   
    }

    private void CarregaSlideGrande()
    {

        string script = "", foto, link = ""; 

        //banner 730X220
        DataSet dadosT = new DataSet();
        dadosBanner = ws.montaBannerPermuta(1);

        script = "";

        foreach (DataRow tRow in dadosBanner.Tables[0].Rows)
        {
            script += "<li>";
            foto = Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString());
            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
            script += "<a href='" + link + "' title='" + "" + "' target='_new'>";
            script += "<img id='image' src='" + foto + "' border='0' alt='' />";
            script += "</a>";
            script += "</li>";
        }

        lblSlide.Text = script;
    
    }

    private void CarregaPublicidadeLateral()
    {
        string script = "", foto, link = ""; 

        DataSet dadosBanner = ws.montabannerlateral("2");
        foreach (DataRow tRow in dadosBanner.Tables[0].Rows)
        {
            script += "";
            foto = Page.ResolveUrl("~/banners/" + tRow["miniatura"].ToString());
            link = Page.ResolveUrl("~/detalhe_banner.aspx?id_banner=" + tRow["codigo"].ToString());
            script += "<a href='" + link + "' title='" + "" + "' target='_new'>";
            script += "<img id='image' class='img-responsive' src='" + foto + "' border='0' alt='' />";
            script += "</a>";
        }
        lblBannerLateral.Text = script;
    }

    private void CarregaMenu()
    {
        UrlRewrite urlr = new UrlRewrite();
        string script = string.Empty;
        DataSet dadosLocal = ws.montamenu("1");
        foreach (DataRow tRow in dadosLocal.Tables[0].Rows)
        {
            script += "<li><a href='Categoria/" + urlr.RemoveSpecialCharacters(tRow["descricao"].ToString()) + "'>" + tRow["descricao"].ToString() + "</a></li>";
        }
        lblLocal.Text = script;
        script = string.Empty;

        DataSet dadosDecoracao = ws.montamenu("2");
        foreach (DataRow tRow in dadosDecoracao.Tables[0].Rows)
        {
            script += "<li><a href='Categoria/" + urlr.RemoveSpecialCharacters(tRow["descricao"].ToString()) + "'>" + tRow["descricao"].ToString() + "</a></li>";
        }
        lblDecoracao.Text = script;
        script = string.Empty;

        DataSet dadosAlimentacao = ws.montamenu("3");
        foreach (DataRow tRow in dadosAlimentacao.Tables[0].Rows)
        {
            script += "<li><a href='Categoria/" + urlr.RemoveSpecialCharacters(tRow["descricao"].ToString()) + "'>" + tRow["descricao"].ToString() + "</a></li>";
        }
        lblAlimentacao.Text = script;
        script = string.Empty;

        DataSet dadosDiversao = ws.montamenu("4");
        foreach (DataRow tRow in dadosDiversao.Tables[0].Rows)
        {
            script += "<li><a href='Categoria/" + urlr.RemoveSpecialCharacters(tRow["descricao"].ToString()) + "'>" + tRow["descricao"].ToString() + "</a></li>";
        }
        lblDiversao.Text = script;
        script = string.Empty;

        DataSet dadosServico = ws.montamenu("5");
        foreach (DataRow tRow in dadosServico.Tables[0].Rows)
        {
            script += "<li><a href='Categoria/" + urlr.RemoveSpecialCharacters(tRow["descricao"].ToString()) + "'>" + tRow["descricao"].ToString() + "</a></li>";
        }
        lblServicos.Text = script;
        script = string.Empty;

        DataSet dadosTipo = ws.montamenu("6");
        foreach (DataRow tRow in dadosTipo.Tables[0].Rows)
        {
            script += "<li><a href='Categoria/" + urlr.RemoveSpecialCharacters(tRow["descricao"].ToString()) + "'>" + tRow["descricao"].ToString() + "</a></li>";
        }
        lblTipo.Text = script;
        script = string.Empty;
    }


    protected void lnk_lnkCategoria_Click(object sender, EventArgs e)
    {
        LinkButton link = (LinkButton)sender;
        GridViewRow gv = (GridViewRow)(link.Parent.Parent);
        //DataListItem dv = (DataListItem)(link.Parent.Parent);

        LinkButton lnkCategoria = (LinkButton)gv.FindControl("lnkCategoria");

        Session["tipo_categoria"] = lnkCategoria.CommandArgument;
        Session["menu"] = "0";

        UrlRewrite urlr = new UrlRewrite();
        lnkCategoria.Text = urlr.RemoveSpecialCharacters(lnkCategoria.Text);

        Response.Redirect("Categoria/" + lnkCategoria.Text);
    }

    protected void dlPublicidade_ItemDataBound(object sender, DataListItemEventArgs e)
    {
        DataRowView dbr = (DataRowView)e.Item.DataItem;

        if (Convert.ToString(DataBinder.Eval(dbr, "descricao")) != "")
        {

            //Label lblCodigoBanner = (Label)e.Item.FindControl("lblCodigoBanner");
            //lblCodigoBanner.Text = Convert.ToString(DataBinder.Eval(dbr, "codigo"));

            Image img = (Image)e.Item.FindControl("imgBanner");
            img.ImageUrl = Page.ResolveUrl("~/banners/" + Convert.ToString(DataBinder.Eval(dbr, "miniatura")));
        }

    }

    protected void dlPublicidade_ItemCommand(object source, DataListCommandEventArgs e)
    {

        if (e.CommandName == "MostraBanner")
        {
            //ifBanner.Attributes["src"] = Page.ResolveUrl("~/mapa.aspx?endereco=" + endereco + "&t=" + lblNomeFantasia.Text);
            Label lblCodigoBanner = (Label)e.Item.FindControl("lblCodigoBanner");

            //DataSet dados = ws.ConsultaBanner(Convert.ToInt32(lblCodigoBanner.Text), "");
            //string codigo_cliente = dados.Tables[0].Rows[0]["codigo_cliente"].ToString();

            LinkButton lnk = (LinkButton)e.Item.FindControl("aBanner");           
            lnk.Attributes["href"] = "detalhe_banner.aspx"; //"http://" + Convert.ToString(DataBinder.Eval(dbr, "site"));


            //DataSet dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(codigo_cliente));
            //lnkPublicidadeGrande.NavigateUrl = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();


           // imgBannerPublicidadeGrande.ImageUrl = Page.ResolveUrl("~/banners/" + dados.Tables[0].Rows[0]["descricao"].ToString());
           // AjaxControlToolkit.ModalPopupExtender mp = (AjaxControlToolkit.ModalPopupExtender)e.Item.FindControl("btnBanner_ModalPopupExtender");
           // mp.Show();
           // upBanner.Update();
        }
    }

    private void CarregaLayout()
    {
        HtmlLink lnk = new HtmlLink();
        lnk.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/bootstrap/css/bootstrap.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk);

        HtmlLink lnk2 = new HtmlLink();
        lnk2.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/bxslider/jquery.bxslider.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk2);

        HtmlLink lnk3 = new HtmlLink();
        lnk3.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/fancybox/source/jquery.fancybox.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk3);

        HtmlLink lnk4 = new HtmlLink();
        lnk4.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/pretty-photo/css/prettyPhoto.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk4);

        HtmlLink lnk5 = new HtmlLink();
        lnk5.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/css/core-css/aspect.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk5);

        HtmlLink lnk6 = new HtmlLink();
        lnk6.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/css/core-css/style.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk6);

        HtmlLink lnk7 = new HtmlLink();
        lnk7.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/magnific-popup/magnific-popup.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk7);

        HtmlLink lnk8 = new HtmlLink();
        lnk8.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/slick/slick.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk8);

        HtmlLink lnk9 = new HtmlLink();
        lnk9.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/css/directorys-style.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk9);

        HtmlLink lnk10 = new HtmlLink();
        lnk10.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/css/shortcodes.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk10);

        HtmlLink lnk11 = new HtmlLink();
        lnk11.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/css/wp-add.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk11);

        HtmlLink lnk12 = new HtmlLink();
        lnk12.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/css/core-css/responsive.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk12);

        HtmlLink lnk13 = new HtmlLink();
        lnk13.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/css/directorys-responsive.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk13);

        HtmlLink lnk14 = new HtmlLink();
        lnk14.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/style.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk14);

        HtmlLink lnk15 = new HtmlLink();
        lnk15.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/fontawesome/css/fontawesome.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk15);

        HtmlLink lnk16 = new HtmlLink();
        lnk16.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/fontello/css/fontello.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk16);

        HtmlLink lnk17 = new HtmlLink();
        lnk17.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/linecons/css/linecons.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk17);

        HtmlLink lnk18 = new HtmlLink();
        lnk18.Attributes["href"] = Page.ResolveUrl("~/css/blueberry.css");
        Page.Header.Controls.Add(lnk18);

        /*HtmlLink lnk19 = new HtmlLink();
        lnk19.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/bootstrap/css/bootstrap.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk19);

        HtmlLink lnk20 = new HtmlLink();
        lnk20.Attributes["href"] = Page.ResolveUrl("~/theme/directorys-v1.2.1/includes/vendors/bootstrap/css/bootstrap.css?ver=4.1.1");
        Page.Header.Controls.Add(lnk20);*/


    }


}
