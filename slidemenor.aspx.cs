using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using System.Net.Mail;


public partial class teste : System.Web.UI.Page
{
    private int vTipoCategoria = 0, ht = 0;
    private WebService ws = new WebService();
    DataTable tabela = new DataTable();
    private DataSet dadosBanner = new DataSet();
    private DataSet dadosBannerTopo = new DataSet();
    PagedDataSource pds = new PagedDataSource();

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {

            string script = "", foto,link="" ;

            //banner 730X220
            DataSet dadosT = new DataSet();
            dadosBannerTopo = ws.montaBannerPermuta(3);

            script = "";
            script += "<div id='slides'>";
            script += "<div class='slides_container'>";

            foreach (DataRow tRow in dadosBannerTopo.Tables[0].Rows)
            {
                foto = Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString());
                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
                script += "<div class='slide'>";
                script += "<a href='" + link + "' title='" + "" + "' target='_new'>";
                script += "<img src='" + foto + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''>";
                script += "</a>";
                script += "<div class='caption' style='bottom:0'>";
                script += "<p>" + tRow["nome_fantasia"].ToString() + " - " + tRow["telefone"].ToString() + "</p>";
                script += "</div>";
                script += "</div>";

            }
            script += "</div>";
            script += "<a href='#' class='prev'><img src='img/arrow-prev.png' width='24' height='43' border='0' alt='Arrow Prev'></a>";
            script += "<a href='#' class='next'><img src='img/arrow-next.png' width='24' height='43' border='0' alt='Arrow Next'></a>";
            script += "</div>";

            lblSlidem.Text = script;
        }
    }

    protected void btnBusca_Click(object sender, ImageClickEventArgs e)
    {

    }

    //protected void montaBanner()
    //{

    //    int contaBanner = 0;

    //    //banner 730X220
    //    dadosBanner = ws.montaBannerPermuta(1);
    //    DataSet dadosT;
    //    string link;

    //    foreach (DataRow tRow in dadosBanner.Tables[0].Rows)
    //    {
    //        contaBanner++;

    //        switch (contaBanner)
    //        {
    //            case 1:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner1.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 2:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner2.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 3:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner3.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 4:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner4.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 5:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner5.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 6:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner6.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 7:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner7.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 8:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner8.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 9:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner9.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 10:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner10.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 11:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner11.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 12:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner12.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 13:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner13.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 14:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner14.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 15:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner15.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 16:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner16.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 17:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner17.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 18:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner18.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 19:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner19.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //            case 20:
    //                dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
    //                link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
    //                lblBanner20.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
    //                break;
    //        }
    //    }


    //    //banner 700X100
    //    contaBanner = 0;

      


    //    if (Session["tipo_categoria"] != null)
    //    {

    //        string sCat = Session["tipo_categoria"].ToString();
    //        dadosT = ws.descricaoCodigoCategoria(sCat);

    //        if (dadosT.Tables[0].Rows.Count > 0)
    //        {
    //            string codigo = dadosT.Tables[0].Rows[0]["codigo"].ToString();
    //            vTipoCategoria = Convert.ToInt32(codigo);
    //        }
    //    }

    //}


    protected void Timer1_Tick(object sender, EventArgs e)
    {
        //TabContainer1.ActiveTabIndex = GeraIndice(20);
        //TabContainer2.ActiveTabIndex = GeraIndice(4);
        //upBannerTopoDireito.Update();
        //upBannerCentral.Update();
    }

    private int GeraIndice(Int32 valor)
    {
        Random rnd = new Random(DateTime.Now.Millisecond);
        int index = rnd.Next(valor);
        return index;
    }

    protected void Button1_Click(object sender, EventArgs e)
    {
    }
}