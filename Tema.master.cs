using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class Tema : System.Web.UI.MasterPage
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

            frmBannerMenor.Attributes["src"] = Page.ResolveUrl("~/slidemenor.aspx");
            frmBannerMaior.Attributes["src"] = Page.ResolveUrl("~/slidemaior.aspx");

            //if (Session["menu"] == "0")
            //{
                GerMenu(grdMenuLocais, "9");

                GerMenuSup(dlLocais, "9");

                DataSet dadosBanner = ws.montabannerlateral("2");
                dlPublicidade.DataSource = dadosBanner;
                dlPublicidade.DataBind();

                MostraVideo();

                montaBanner();
                Session["menu"] = "1";
            //}

            //TabContainer1.ActiveTabIndex = GeraIndice(20);
            //TabContainer2.ActiveTabIndex = GeraIndice(4);

            string appPath = Page.Request.ApplicationPath.ToString();


            lblCodigo.Visible = false;
            lblCodigoCategoria.Visible = false;
            lblDescricao.Visible = false;

            if (Session["tipo_tema"] != null)
            {
                string ncategoria = Session["tipo_tema"].ToString();
                DataSet dados = new DataSet();
                dados = ws.descricaoCodigoCategoria(ncategoria);

                if (dados.Tables[0].Rows.Count > 0)
                    vTipoCategoria = Convert.ToInt32(dados.Tables[0].Rows[0]["codigo"].ToString());

            }

            recarregaLayout();

        }
    }

    protected void btnBusca_Click(object sender, ImageClickEventArgs e)
    {
        if (txtBusca.Text != "")
        {
            //string appPath = Server.MapPath("~"); 
            Session["busca"] = txtBusca.Text;
            Session["tipo_tema"] = null;

            UrlRewrite urlr = new UrlRewrite();
            txtBusca.Text = urlr.RemoveSpecialCharacters(txtBusca.Text);

            Response.Redirect("~/Tema/" + txtBusca.Text);

        }
        else
        {
            string myScript = @"alert('Digite um conteudo para pesquisa!');";
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);
        }

    }
    protected void ddlStatus_SelectedIndexChanged(object sender, EventArgs e)
    {

    }

    private DataTable CriaDataTable()
    {

        DataTable mDataTable = new DataTable();

        DataColumn mDataColumn;

        mDataColumn = new DataColumn();
        mDataColumn.DataType = Type.GetType("System.String");
        mDataColumn.ColumnName = "email";
        mDataTable.Columns.Add(mDataColumn);

        mDataColumn = new DataColumn();
        mDataColumn.DataType = Type.GetType("System.String");
        mDataColumn.ColumnName = "usuario";
        mDataTable.Columns.Add(mDataColumn);

        return mDataTable;

    }

    private void incluirNoDataTable(string email, string usuario, DataTable mTable)
    {

        DataRow linha;
        linha = mTable.NewRow();

        linha["email"] = email;

        linha["usuario"] = usuario;

        mTable.Rows.Add(linha);

        tabela = mTable;
        HttpContext.Current.Session["dadosT"] = mTable;

    }

    protected void btnLogin_Click(object sender, ImageClickEventArgs e)
    {
        /* if (ddlTipoAcesso.SelectedValue == "2")
         {
             Session["UserName"] = txtUsuarioCliente.Text;
             Session["EmailUsuario"] = txtEmailCliente.Text;
        
         }
         string senha = SenhaHASH(Convert.ToString(DateTime.Now));
         Response.Redirect("Chat.aspx?h=" + senha + "&rid=2&tp=" + ddlTipoAcesso.SelectedValue, false);

         UpdatePanel2.Update();*/
    }

    protected void btnMini_Click(object sender, ImageClickEventArgs e)
    {

    }

    protected void btnLoginCliente_Click(object sender, ImageClickEventArgs e)
    {
        /*Service ws = new Service();
        int login = ws.authenticateUser(txtUsuario.Text, txtSenha.Text);
        if (login != 0)
        {
            string nomeUser = ws.NomeUser(txtUsuario.Text, txtSenha.Text);
            Session["UserName"] = nomeUser;
            Session["idCliente"] = login;

            string senha = SenhaHASH(Convert.ToString(DateTime.Now));
            Response.Redirect("Chat.aspx?h="+senha+"&rid=2&tp=" + ddlTipoAcesso.SelectedValue, false);
            txtUsuario.Text = "";
            txtSenha.Text = "";
        }
        else
        {
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('Usuario e/ou Senha Invalido(s)! Verifique'); </script>", false);
            txtUsuario.Text = "";
            txtSenha.Text = "";
        }
        UpdatePanel2.Update();*/

    }

    protected void Timer1_Tick(object sender, EventArgs e)
    {
        //TabContainer1.ActiveTabIndex = GeraIndice(20);
        //TabContainer2.ActiveTabIndex = GeraIndice(4);
        //upBannerTopoDireito.Update();
        //upBannerCentral.Update();
    }

    protected void ddlTipoAcesso_SelectedIndexChanged(object sender, EventArgs e)
    {
        /*   if (ddlTipoAcesso.SelectedValue != "0")
           {
               if (ddlTipoAcesso.SelectedValue == "1")
               {
                   pnChatCli.Visible = true;
                   pnChatUsr.Visible = false;

               }
               if (ddlTipoAcesso.SelectedValue == "2")
               {
                   pnChatUsr.Visible = true;
                   pnChatCli.Visible = false;
               }

               UpdatePanel2.Update();
           }*/
    }

    protected void montaBanner()
    {

        int contaBanner = 0;

        //banner 730X220
        dadosBanner = ws.montaBannerPermuta(1);
        DataSet dadosT;
        string link;

        //foreach (DataRow tRow in dadosBanner.Tables[0].Rows)
        //{
        //    contaBanner++;

        //    switch (contaBanner)
        //    {
        //        case 1:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner1.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 2:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner2.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 3:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner3.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 4:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner4.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 5:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner5.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 6:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner6.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 7:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner7.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 8:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner8.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 9:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner9.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 10:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner10.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 11:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner11.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 12:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner12.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 13:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner13.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 14:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner14.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 15:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner15.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 16:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner16.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 17:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner17.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 18:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner18.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 19:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner19.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 20:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBanner20.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //    }
        //}


        ////banner 700X100
        //contaBanner = 0;

        //dadosBannerTopo = ws.montaBannerPermuta(3);
        //foreach (DataRow tRow in dadosBannerTopo.Tables[0].Rows)
        //{
        //    contaBanner++;
        //    switch (contaBanner)
        //    {
        //        case 1:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBannerTopo1.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 2:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBannerTopo2.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 3:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBannerTopo3.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //        case 4:
        //            dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(tRow["codigo_cliente"].ToString()));
        //            link = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();
        //            lblBannerTopo4.Text = "<a style='text-decoration: none' target='_new' href='" + link + "'><img src='" + Page.ResolveUrl("~/banners/" + tRow["descricao"].ToString()) + "' width='" + tRow["largura"].ToString() + "' height='" + tRow["altura"].ToString() + "' border='0' alt=''></a>";
        //            break;
        //    }

        //}


        if (Session["tipo_categoria"] != null)
        {

            string sCat = Session["tipo_categoria"].ToString();
            dadosT = ws.descricaoCodigoCategoria(sCat);

            if (dadosT.Tables[0].Rows.Count > 0)
            {
                string codigo = dadosT.Tables[0].Rows[0]["codigo"].ToString();
                vTipoCategoria = Convert.ToInt32(codigo);
            }
        }

    }


    protected void dlPublicidade_ItemCommand(object source, DataListCommandEventArgs e)
    {

        if (e.CommandName == "MostraBanner")
        {
            //ifBanner.Attributes["src"] = Page.ResolveUrl("~/mapa.aspx?endereco=" + endereco + "&t=" + lblNomeFantasia.Text);
            Label lblCodigoBanner = (Label)e.Item.FindControl("lblCodigoBanner");

            DataSet dados = ws.ConsultaBanner(Convert.ToInt32(lblCodigoBanner.Text), "");
            string codigo_cliente = dados.Tables[0].Rows[0]["codigo_cliente"].ToString();

            DataSet dadosT = ws.ConsultaAnuncioCliente(Convert.ToInt32(codigo_cliente));
            lnkPublicidadeGrande.NavigateUrl = "http://" + dadosT.Tables[0].Rows[0]["site"].ToString();


            imgBannerPublicidadeGrande.ImageUrl = Page.ResolveUrl("~/banners/" + dados.Tables[0].Rows[0]["descricao"].ToString());
            AjaxControlToolkit.ModalPopupExtender mp = (AjaxControlToolkit.ModalPopupExtender)e.Item.FindControl("btnBanner_ModalPopupExtender");
            mp.Show();
            upBanner.Update();
        }
    }

    protected void lnk_lnkTema_Click(object sender, EventArgs e)
    {
        LinkButton link = (LinkButton)sender;
        GridViewRow gv = (GridViewRow)(link.Parent.Parent);
        LinkButton lnkCategoria = (LinkButton)gv.FindControl("lnkCategoria");
        
        Session["tipo_tema"] = lnkCategoria.CommandArgument;
        Session["menu"] = "0";

        UrlRewrite urlr = new UrlRewrite();
        lnkCategoria.Text = urlr.RemoveSpecialCharacters(lnkCategoria.Text);

        Response.Redirect("~/Tema/" + lnkCategoria.Text);
    }

    protected void lnk_lnkCategoriaSup_Click(object sender, EventArgs e)
    {
        LinkButton link = (LinkButton)sender;
        DataListItem dv = (DataListItem)(link.Parent);

        LinkButton lnkCategoria = (LinkButton)dv.FindControl("lnkCategoria");

        Session["tipo_tema"] = lnkCategoria.CommandArgument;
        Session["menu"] = "0";

        UrlRewrite urlr = new UrlRewrite();
        lnkCategoria.Text = urlr.RemoveSpecialCharacters(lnkCategoria.Text);

        Response.Redirect("~/Tema/" + lnkCategoria.Text);
    }


    private int GeraIndice(Int32 valor)
    {
        Random rnd = new Random(DateTime.Now.Millisecond);
        int index = rnd.Next(valor);
        return index;
    }

    private void GerMenu(GridView grd, string op)
    {
        DataSet dados = ws.montamenu(op);
        grd.DataSource = dados;
        grd.DataBind();
    }

    private void GerMenuSup(DataList grd, string op)
    {
        DataSet dados = ws.montamenu(op);
        grd.DataSource = dados;
        grd.DataBind();
    }

    private void recarregaLayout()
    {
        CssSite.Attributes["href"] = Page.ResolveUrl("~/Styles.css");
        tabCss.Attributes["href"] = Page.ResolveUrl("~/visoft__tab_xpie7.css");
        imgLocaisFestas.Attributes["src"] = Page.ResolveUrl("~/imagens/locais_festas.png");
        imgLogo.ImageUrl = Page.ResolveUrl("~/imagens/logo.png");
        btnBusca.ImageUrl = Page.ResolveUrl("~/imagens/ok.png");
        btnClubOfertas.ImageUrl = Page.ResolveUrl("~/imagens/BT_GUIA.png");
        btnVitrineTema.ImageUrl = Page.ResolveUrl("~/imagens/BT_TEMA.png");
        btnVitrineConvite.ImageUrl = Page.ResolveUrl("~/imagens/BT_CONVITE.png");
        btnOrcamento.ImageUrl = Page.ResolveUrl("~/imagens/BT_ORCAMENTO.png");
        imgSejaCliente.ImageUrl = Page.ResolveUrl("~/imagens/seja_cliente.png");
        medidor2.ImageUrl = Page.ResolveUrl("~/imagens/medidor_verde.png");
        btnFechar.ImageUrl = Page.ResolveUrl("~/imagens/close.png");
        Image img = (Image)uProgBanner.FindControl("imgAguarde");
        img.ImageUrl = Page.ResolveUrl("~/imagens/wait.gif");
        imgPlayDir.ImageUrl = Page.ResolveUrl("~/imagens/play_dir.png");
        imgPlayEsq.ImageUrl = Page.ResolveUrl("~/imagens/play_esq.png");

    }

    protected void LoginButton_Click(object sender, EventArgs e)
    {

    }

    protected void dlPublicidade_ItemDataBound(object sender, DataListItemEventArgs e)
    {
        DataRowView dbr = (DataRowView)e.Item.DataItem;

        if (Convert.ToString(DataBinder.Eval(dbr, "descricao")) != "")
        {

            Label lblCodigoBanner = (Label)e.Item.FindControl("lblCodigoBanner");
            lblCodigoBanner.Text = Convert.ToString(DataBinder.Eval(dbr, "codigo"));

            Image img = (Image)e.Item.FindControl("imgBanner");
            img.ImageUrl = Page.ResolveUrl("~/banners/" + Convert.ToString(DataBinder.Eval(dbr, "miniatura")));
        }

    }

    protected void dlVideo_ItemCommand(object source, DataListCommandEventArgs e)
    {

        if (e.CommandName == "MostraVideo")
        {

            WebControl wc = ((WebControl)e.CommandSource);
            DataListItem row = ((DataListItem)wc.NamingContainer);

            LinkButton lkbItem = ((LinkButton)dlVideo.Items[row.ItemIndex].FindControl("aBanner"));
            Session["idVideo"] = lkbItem.CommandArgument;
            Response.Redirect("tvOnline.aspx");

        }
    }

    protected void dlVideo_ItemDataBound(object sender, DataListItemEventArgs e)
    {
        DataRowView dbr = (DataRowView)e.Item.DataItem;

        if (Convert.ToString(DataBinder.Eval(dbr, "miniatura")) != "")
        {
            string imagem = Page.ResolveUrl("~/video/" + Convert.ToString(DataBinder.Eval(dbr, "miniatura")));
            Image imgVideo = (Image)e.Item.FindControl("imgVideo");
            imgVideo.ImageUrl = imagem;
        }

    }

    protected string montaVisualizadorG(string nomeArquivo)
    {
        string tipo_arquivo = nomeArquivo.Substring(nomeArquivo.Length - 3, 3);
        string player = "";

        switch (tipo_arquivo.ToUpper())
        {
            case "JPG":
                {
                    string imagePath = MapPath("~/album/") + nomeArquivo;
                    System.Drawing.Image img = System.Drawing.Image.FromFile(imagePath);
                    player = "<img id='imgFotoG' src='album/" + nomeArquivo + "' style='border-width:0px;'>";
                    if (img.Height > 450)
                    {
                        player = "<img id='imgFotoG' src='album/" + nomeArquivo + "' style='height:450px;border-width:0px;'>";
                    }
                    if (img.Height > 600)
                    {
                        player = "<img id='imgFotoG' src='album/" + nomeArquivo + "' style='height:650px;border-width:0px;'>";
                    }
                    if (img.Height < 450)
                    {
                        player = "<img id='imgFotoG' src='album/" + nomeArquivo + "' style='height:100%;border-width:0px;'>";
                    }
                    img.Dispose();
                    break;
                }

            case "WMV":
                {
                    player = "<asp:MediaPlayer ID='mp1' runat='server' MediaSource='album/" + nomeArquivo + "' /> ";
                    break;
                }

            case "MP4":
                {
                    player = "<iframe ID='ifVideo' runat='server' align='middle' frameborder='0' " +
                             "height='480px' marginheight='0' src='video.aspx?a=" + nomeArquivo + "' marginwidth='0' scrolling='auto' " +
                             "width='640px'>" +
                             "</iframe>";

                    break;
                }
        }

        if (nomeArquivo.Substring(0, 4).ToUpper() == "HTTP")
        {
            player = " <iframe ID='ifVideo' runat='server' align='middle' frameborder='0' " +
                     "height='480px' marginheight='0' src='video.aspx?a=" + nomeArquivo + "' marginwidth='0' scrolling='auto' " +
                     "width='640px'>" +
                     "</iframe>";

        }

        return player;

    }


    private void MostraVideo()
    {
        DataSet dados = ws.ConsultaVideo(0, "0");

        pds.DataSource = dados.Tables[0].DefaultView;
        pds.AllowPaging = true;
        pds.PageSize = 4;
        pds.CurrentPageIndex = CurrentPage;
        lnkProximo.Enabled = !pds.IsLastPage;
        lnkAnterior.Enabled = !pds.IsFirstPage;

        dlVideo.DataSource = pds;
        dlVideo.DataBind();
    }

    public int CurrentPage
    {
        get
        {
            if (this.ViewState["CurrentPage"] == null)
                return 0;
            else
                return Convert.ToInt16(this.ViewState["CurrentPage"].ToString());
        }

        set
        {
            this.ViewState["CurrentPage"] = value;
        }
    }

    protected void lnkAnterior_Click(object sender, EventArgs e)
    {
        CurrentPage -= 1;
        MostraVideo();
    }

    protected void lnkProximo_Click(object sender, EventArgs e)
    {
        CurrentPage += 1;
        MostraVideo();
    }


    protected void btnClubOfertas_Click(object sender, ImageClickEventArgs e)
    {
        Response.Redirect("~/Index.aspx");
    }

    protected void btnVitrineTema_Click(object sender, ImageClickEventArgs e)
    {
        Response.Redirect("~/tema.aspx");
    }

    protected void btnVitrineConvite_Click(object sender, ImageClickEventArgs e)
    {
        Response.Redirect("~/convite.aspx");
    }

    protected void btnCloseVideo_Click(object sender, EventArgs e)
    {
        MostraVideo();
    }

    protected void lkbHome_Click(object sender, EventArgs e)
    {
        Response.Redirect("~/Index.aspx");
    }
}
