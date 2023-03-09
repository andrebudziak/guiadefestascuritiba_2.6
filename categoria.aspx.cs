using System;
using System.Collections;
using System.Configuration;
using System.Data;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Data.Common;
using System.Text;
using System.IO;
using System.Text.RegularExpressions;

public partial class categoria : System.Web.UI.Page
{
    private int vTipoCategoria = 0;
    private string vCategoria = "";
    private AjaxControlToolkit.Accordion acc;
    private WebService ws = new WebService();


    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            Session["tipo_categoria"] = '1';
            if (Session["tipo_categoria"] != null)
            {
                string ncategoria = Session["tipo_categoria"].ToString();
                string busca = "";
                DataSet dadosDesc = new DataSet();
                dadosDesc = ws.descricaoCategoria(ncategoria);

                if (Session["busca"] != null)
                {
                    busca = Session["busca"].ToString();

                    if (dadosDesc.Tables[0].Rows.Count > 0)
                    {
                        vTipoCategoria = Convert.ToInt32(dadosDesc.Tables[0].Rows[0]["codigo"].ToString());
                        Session["tipo_categoria"] = vTipoCategoria;
                        DataSet dados = ws.ConsultaAnuncioTela(vTipoCategoria, busca);
                        if (dados.Tables[0].Rows.Count == 0)
                        {
                            imgSemDados.Visible = true;
                            imgSemDados.ImageUrl = Page.ResolveUrl("~/imagens/semclientes.png");
                            //pnAnuncioCategoria.Visible = false;
                        }
                        else
                        {
                            imgSemDados.Visible = false;
                            dlAnunciante.DataSource = dados;
                            dlAnunciante.DataBind();
                        }
                    }
                }
                else if (dadosDesc.Tables[0].Rows.Count > 0)
                {
                   vTipoCategoria = Convert.ToInt32(dadosDesc.Tables[0].Rows[0]["codigo"].ToString());
                   Session["tipo_categoria"] = vTipoCategoria;
                   DataSet dados = ws.ConsultaAnuncioTela(vTipoCategoria, "0");
                   if (dados.Tables[0].Rows.Count == 0)
                   {
                       imgSemDados.Visible = true;
                       imgSemDados.ImageUrl = Page.ResolveUrl("~/imagens/semclientes.png");
                       //pnAnuncioCategoria.Visible = false;
                   }
                   else
                   {
                       imgSemDados.Visible = false;
                       dlAnunciante.DataSource = dados;
                       dlAnunciante.DataBind();
                   }

                }

            }
            else
            {
                string busca = "";
                DataSet dadosDesc = new DataSet();

                if (Session["busca"] == null)
                {
                    if (Request.QueryString["tipo_categoria"] != null)
                    {
                        Session["tipo_categoria"] = Request.QueryString["tipo_categoria"].ToString();
                    }
                    else
                    {
                        string ncategoria = Page.Request.Url.Query;
                        int pos = ncategoria.IndexOf("Categoria/");
                        ncategoria = ncategoria.Substring(pos + 10, ncategoria.Length - pos - 10);
                        ncategoria = Server.UrlDecode(ncategoria);

                        ncategoria = Regex.Replace(ncategoria, "-", " ");
                        dadosDesc = ws.descricaoCodigoCategoria(ncategoria);

                        Session["tipo_categoria"] = dadosDesc.Tables[0].Rows[0]["codigo"].ToString();
                    }

                }

                if (Session["busca"] != null)
                {
                    busca = Session["busca"].ToString();

                    DataSet dados = ws.ConsultaAnuncioTela(0, busca);
                    if (dados.Tables[0].Rows.Count == 0)
                    {
                        imgSemDados.Visible = true;
                        imgSemDados.ImageUrl = Page.ResolveUrl("~/imagens/semclientes.png");
                        //pnAnuncioCategoria.Visible = false;
                    }
                    else
                    {
                        imgSemDados.Visible = false;
                        dlAnunciante.DataSource = dados;
                        dlAnunciante.DataBind();
                    }

                }
                else if (dadosDesc.Tables.Count > 0)
                {
                    vTipoCategoria = Convert.ToInt32(dadosDesc.Tables[0].Rows[0]["codigo"].ToString());
                    Session["tipo_categoria"] = vTipoCategoria;
                    DataSet dados = ws.ConsultaAnuncioTela(vTipoCategoria, "0");
                    if (dados.Tables[0].Rows.Count == 0)
                    {
                        imgSemDados.Visible = true;
                        imgSemDados.ImageUrl = Page.ResolveUrl("~/imagens/semclientes.png");
                        //pnAnuncioCategoria.Visible = false;
                    }
                    else
                    {
                        imgSemDados.Visible = false;
                        dlAnunciante.DataSource = dados;
                        dlAnunciante.DataBind();
                    }
                }
                else
                {

                    vTipoCategoria = Convert.ToInt32(Session["tipo_categoria"].ToString());
                    DataSet dados = ws.ConsultaAnuncioTela(vTipoCategoria, "0");
                    if (dados.Tables[0].Rows.Count == 0)
                    {
                        imgSemDados.Visible = true;
                        imgSemDados.ImageUrl = Page.ResolveUrl("~/imagens/semclientes.png");
                        //pnAnuncioCategoria.Visible = false;
                    }
                    else
                    {
                        imgSemDados.Visible = false;
                        dlAnunciante.DataSource = dados;
                        dlAnunciante.DataBind();
                    }
                }

            }


            DataSet dadosT = new DataSet();
            dadosT = ws.descricaoCategoria(Convert.ToString(vTipoCategoria));
            Session["tipo_categoria"] = vTipoCategoria;
            if (dadosT.Tables[0].Rows.Count != 0)
            {
                lblTituloCat.Text = dadosT.Tables[0].Rows[0]["descricao"].ToString();
                //Page.Title = dadosT.Tables[0].Rows[0]["descricao"].ToString();
            }


        }
        /*else
        {
            Session.Clear();
        
        }*/
    }

    protected void dlAnunciante_ItemDataBound(object sender, DataListItemEventArgs e)
    {
        DataRowView dbr = (DataRowView)e.Item.DataItem;

        Label lblCodigoAnuncio = (Label)e.Item.FindControl("lblCodigoAnuncio");
        lblCodigoAnuncio.Text = Convert.ToString(DataBinder.Eval(dbr, "codigo"));

        Label lblDescricao = (Label)e.Item.FindControl("lblDescricao");
        lblDescricao.Text = Convert.ToString(DataBinder.Eval(dbr, "descricao"));

        Label lblTituloAnuncio = (Label)e.Item.FindControl("lblNomeFantasia");
        lblTituloAnuncio.Text = Convert.ToString(DataBinder.Eval(dbr, "nome_fantasia"));

        Label lblBairroCidade = (Label)e.Item.FindControl("lblBairroCidade");
        lblBairroCidade.Text = Convert.ToString(DataBinder.Eval(dbr, "bairro")) +" - "+ Convert.ToString(DataBinder.Eval(dbr, "cidade"));

        Label lblEndereco = (Label)e.Item.FindControl("lblEndereco");
        lblEndereco.Text = Convert.ToString(DataBinder.Eval(dbr, "endereco"));

        Label lblTelefone = (Label)e.Item.FindControl("lblTelefone");
        lblTelefone.Text = Convert.ToString(DataBinder.Eval(dbr, "telefone"));

        //Label lblRedes = (Label)e.Item.FindControl("lblRedes");
        //lblRedes.Text = "";

        /*Int32 mes = DateTime.Now.Month;
        DataSet dados = ws.ConsultaMesAgenda(Convert.ToInt32(lblCodigoAnuncio.Text),mes);

        DropDownList ddlMes = (DropDownList)e.Item.FindControl("ddlMes");
        ddlMes.SelectedValue = mes.ToString();

        Label lblCodAnuncio = (Label)e.Item.FindControl("lblCodAnuncio");
        lblCodAnuncio.Text = Convert.ToString(DataBinder.Eval(dbr, "codigo"));

        if (dados != null)
        {
            if (dados.Tables[0].Rows.Count > 0)
            {
                foreach (DataRow row in dados.Tables[0].Rows)
                {
                    TextBox txtInformacoes = (TextBox)e.Item.FindControl("txtInformacoes");
                    txtInformacoes.Text = "-" + row["descricao"].ToString() + " Data:" + Convert.ToDateTime(row["data"].ToString()).ToString("dd/MM/yyyy") + " Hora: " + Convert.ToDateTime(row["data"].ToString()).ToString("HH:mm:ss");                    
                }
            }
        }
        */

        if (Convert.ToString(DataBinder.Eval(dbr, "logo")) != "")
        {
            ImageButton btn = (ImageButton)e.Item.FindControl("btnImgLogo");

            string logo = Page.ResolveUrl("~/logos/" + Convert.ToString(DataBinder.Eval(dbr, "logo")));

            btn.ImageUrl = logo;
        }

        if (Convert.ToString(DataBinder.Eval(dbr, "site")) == "")
        {

            HyperLink lnk = (HyperLink)e.Item.FindControl("aSite");
        }
        else
        {
            HyperLink lnk = (HyperLink)e.Item.FindControl("aSite");
            lnk.Attributes["href"] = Page.ResolveUrl("~/detalhe_categoria.aspx?id_anuncio="+ lblCodigoAnuncio.Text) ;
            //"http://" + Convert.ToString(DataBinder.Eval(dbr, "site"));

            HyperLink lnk2 = (HyperLink)e.Item.FindControl("aLogo");

            //string myScript = "window.open('" + "http://" + Convert.ToString(DataBinder.Eval(dbr, "site")) + "', null,''); void(0)";
            //lnk2.Attributes["onclick"] = myScript;
            //lnk.Attributes["onclick"] = myScript;

            lnk2.Attributes["href"] = "detalhe_categoria.aspx?id_anuncio=" + lblCodigoAnuncio.Text; //"http://" + Convert.ToString(DataBinder.Eval(dbr, "site"));

            /*Label lblNomeFantasia = (Label)e.Item.FindControl("lblNomeFantasia");
            lblNomeFantasia.Text = "";
            lblNomeFantasia.Text += "<g:plusone size='small' href='" + Convert.ToString(DataBinder.Eval(dbr, "site")) + "'></g:plusone>";
            lblNomeFantasia.Text += "<a href='http://twitter.com/share' class='twitter-share-button' data-url='" + Convert.ToString(DataBinder.Eval(dbr, "site")) + "' data-text='Acesse " + Convert.ToString(DataBinder.Eval(dbr, "site")) + "' data-count='none' data-via='guiafestasctba' data-lang='pt'>Tweet</a><script type='text/javascript' src='http://platform.twitter.com/widgets.js'></script>";
            lblNomeFantasia.Text += "<iframe src='http://www.facebook.com/plugins/like.php?href='" + Convert.ToString(DataBinder.Eval(dbr, "site")) + "&layout=button_count&show_faces=false&width=380&action=like&colorscheme=light&height=25&locale=pt_BR' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:100px; height:20px; vertical-align:bottom; ' allowTransparency='true'></iframe>";
            */

        }


         if (Convert.ToString(DataBinder.Eval(dbr, "email")) == "")
        {
            HyperLink lnk = (HyperLink)e.Item.FindControl("aEmail");
        }
        else
        {
            /*HtmlImage btn = (HtmlImage)e.Item.FindControl("imgEmail");
            string imagem = Page.ResolveUrl("/imagens/EMAIL.png");
            btn.Src = imagem;*/
           
            HyperLink lnk = (HyperLink)e.Item.FindControl("aEmail");
            lnk.Attributes["href"] = "mailto:" + Convert.ToString(DataBinder.Eval(dbr, "email"));

        }


         if (Convert.ToString(DataBinder.Eval(dbr, "facebook")) != "")
         {
             HyperLink lnk = (HyperLink)e.Item.FindControl("aFacebook");
             lnk.Attributes["href"] = Convert.ToString(DataBinder.Eval(dbr, "facebook"));
         }

         if (Convert.ToString(DataBinder.Eval(dbr, "gmais")) != "")
         {
             HyperLink lnk = (HyperLink)e.Item.FindControl("aGmais");
             lnk.Attributes["href"] = Convert.ToString(DataBinder.Eval(dbr, "gmais"));
         }

         /*if (Convert.ToString(DataBinder.Eval(dbr, "orkut")) != "")
         {
             HyperLink lnk = (HyperLink)e.Item.FindControl("aOrkut");
             lnk.Attributes["href"] = Convert.ToString(DataBinder.Eval(dbr, "orkut"));

             HtmlImage btn = (HtmlImage)e.Item.FindControl("imgOrkut");
             string imagem = Page.ResolveUrl("~/imagens/orkut.jpg");
             btn.Src = imagem;

         }
         else
         {
             HtmlImage btn = (HtmlImage)e.Item.FindControl("imgOrkut");
             string imagem = Page.ResolveUrl("~/imagens/orkut_cinza.jpg");
             btn.Src = imagem;
         }

         if (Convert.ToString(DataBinder.Eval(dbr, "facebook")) != "")
         {
             HyperLink lnk = (HyperLink)e.Item.FindControl("aFacebook");
             lnk.Attributes["href"] = Convert.ToString(DataBinder.Eval(dbr, "facebook"));

             HtmlImage btn = (HtmlImage)e.Item.FindControl("imgFacebook");
             string imagem = Page.ResolveUrl("~/imagens/facebook.jpg");
             btn.Src = imagem;
         }
         else
         {
             HtmlImage btn = (HtmlImage)e.Item.FindControl("imgFacebook");
             string imagem = Page.ResolveUrl("~/imagens/facebook_cinza.jpg");
             btn.Src = imagem;
         }

         if (Convert.ToString(DataBinder.Eval(dbr, "twitter")) != "")
         {
             HyperLink lnk = (HyperLink)e.Item.FindControl("aTwitter");
             lnk.Attributes["href"] = Convert.ToString(DataBinder.Eval(dbr, "twitter"));

             HtmlImage btn = (HtmlImage)e.Item.FindControl("imgTwitter");
             string imagem = Page.ResolveUrl("~/imagens/twitter.jpg");
             btn.Src = imagem;
         }
         else
         {
             HtmlImage btn = (HtmlImage)e.Item.FindControl("imgTwitter");
             string imagem = Page.ResolveUrl("~/imagens/twitter_cinza.jpg");
             btn.Src = imagem;
         }

         if (Convert.ToString(DataBinder.Eval(dbr, "endereco")) == "")
         {
             //string endereco = Convert.ToString(DataBinder.Eval(dbr, "endereco")) + " " + Convert.ToString(DataBinder.Eval(dbr, "bairro")) + " " + Convert.ToString(DataBinder.Eval(dbr, "cidade"));
             //string info = "";//lblTituloAnuncio.Text + "</br>" + endereco;

             LinkButton lnk = (LinkButton)e.Item.FindControl("aMapa");
             lnk.Enabled = false;
             //lnk.Attributes["onclick"] = "javascript:window.open('mapa.aspx?info=" + info + "&endereco="+endereco+"', null, 'left = 400, top = 100, height = 480, width = 500, status = no, resizable = no, scrollbars = no, toolbar = no, location = no, menubar = no'); void(0)";

         }

        /* if (Convert.ToString(DataBinder.Eval(dbr, "gmais")) != "")
         {
             HyperLink lnk = (HyperLink)e.Item.FindControl("aGmais");
             lnk.Attributes["href"] = Convert.ToString(DataBinder.Eval(dbr, "gmais"));
            
             HtmlImage btnG = (HtmlImage)e.Item.FindControl("imgGmais");
             string imagemG = Page.ResolveUrl("~/imagens/google.jpg");
             btnG.Src = imagemG;
         }
         else
         {
             HtmlImage btnG = (HtmlImage)e.Item.FindControl("imgGmais");
             string imagemG = Page.ResolveUrl("~/imagens/google_cinza.jpg");
             btnG.Src = imagemG;
         }

         HtmlImage btnTV = (HtmlImage)e.Item.FindControl("imgTvOnline");
         string imagemTV = Page.ResolveUrl("~/imagens/TVONLINE_cinza.jpg");
         btnTV.Src = imagemTV;

         if (Convert.ToString(DataBinder.Eval(dbr, "oferta")) != "")
         {

             ImageButton btnO = (ImageButton)e.Item.FindControl("imgOferta");
             string imagemO = Page.ResolveUrl("~/imagens/OFERTA.jpg");
             btnO.ImageUrl = imagemO;

         }
         else
         {
             ImageButton btnO = (ImageButton)e.Item.FindControl("imgOferta");
             string imagemO = Page.ResolveUrl("~/imagens/OFERTA_cinza.jpg");
             btnO.ImageUrl = imagemO;
         }*/

    }   

    /*protected void ddlFiltro_SelectedIndexChanged(object sender, EventArgs e)
    {
        vTipoCategoria = Convert.ToInt32(Session["tipo_categoria"].ToString());
        DataSet dados = ws.ConsultaAnuncioTela(vTipoCategoria, "0");
        DataTable table = dados.Tables["anuncio"];
        DataView view = table.DefaultView;
        view.Sort = ddlFiltro.SelectedValue;
        
        dlAnunciante.DataSource = view;
        dlAnunciante.DataBind();

    }*/

    protected void dlAnunciante_ItemCommand(object source, DataListCommandEventArgs e)
    {
        if (e.CommandName == "ContaClick") 
        {
            Label lnk1 = (Label)e.Item.FindControl("lblCodigoAnuncio"); 
            string key = lnk1.Text;
            ws.contaClicks(Convert.ToInt32(key));

            HyperLink lnk = (HyperLink)e.Item.FindControl("aLogo");

            string myScript = "window.open('"+lnk.NavigateUrl+"', null,''); void(0)";

            lnk.Attributes["onclick"] = myScript; 
        }

        if (e.CommandName == "MostraMapa")
        {

            Label lblEndereco = (Label)e.Item.FindControl("lblEndereco");
            Label lblBairroCidade = (Label)e.Item.FindControl("lblBairroCidade");
            Label lblNomeFantasia = (Label)e.Item.FindControl("lblNomeFantasia");

            string endereco;
            endereco = lblEndereco.Text +" "+ lblBairroCidade.Text ;

        
        }

        if (e.CommandName == "MostraOferta")
        {
            Label lblCodigoOferta = (Label)e.Item.FindControl("lblCodigoOferta");
            Session["Oferta"] = lblCodigoOferta.Text;

            int codigo = Convert.ToInt32(lblCodigoOferta.Text);
            DataSet dados = ws.ConsultaOfertaTela(codigo, "0");
            string descricao = dados.Tables[0].Rows[0]["nome_fantasia"].ToString();

            UrlRewrite urlr = new UrlRewrite();
            descricao = urlr.RemoveSpecialCharacters(descricao);

            Response.Redirect("~/Oferta/" + descricao);


        }

    }

    protected void ddlMes_SelectedIndexChanged(object sender, EventArgs e)
    {
        DropDownList actionsDDL = sender as DropDownList;
        Label projectCandidateIdHF = actionsDDL.Parent.FindControl("lblCodAnuncio") as Label;
    }




}
