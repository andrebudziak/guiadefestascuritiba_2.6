using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class teste : System.Web.UI.Page
{
    private WebService ws = new WebService();
    private DataSet dadosBanner = new DataSet();

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            CarregaSlideGrande();
            CarregaMenu();

        }

    }

    private void CarregaSlideGrande()
    {

        string script = "", foto, link = ""; ;

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

    private void CarregaMenu()
    {
        UrlRewrite urlr = new UrlRewrite();
        string script=string.Empty;
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



}