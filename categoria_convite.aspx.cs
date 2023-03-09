using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.Text.RegularExpressions;

public partial class categoria_convite : System.Web.UI.Page
{
    private int vTipoCategoria = 0;
    private string vCategoria = "";
    private AjaxControlToolkit.Accordion acc;
    private WebService ws = new WebService();


    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            if (Session["tipo_convite"] != null)
            {
                string ncategoria = Session["tipo_convite"].ToString();
                string busca = "";
                DataSet dadosDesc = new DataSet();
                dadosDesc = ws.descricaoCategoria(ncategoria);

                if (Session["busca"] != null)
                {
                    busca = Session["busca"].ToString();

                    if (dadosDesc.Tables[0].Rows.Count > 0)
                    {
                        vTipoCategoria = Convert.ToInt32(dadosDesc.Tables[0].Rows[0]["codigo"].ToString());
                        DataSet dados = ws.ConsultaConviteTela(vTipoCategoria, busca);
                        if (dados.Tables[0].Rows.Count == 0)
                        {
                            imgSemDados.Visible = true;
                            imgSemDados.ImageUrl = Page.ResolveUrl("~/imagens/semclientes.png");
                            pnAnuncioCategoria.Visible = false;
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
                    DataSet dados = ws.ConsultaConviteTela(vTipoCategoria, "0");
                    if (dados.Tables[0].Rows.Count == 0)
                    {
                        imgSemDados.Visible = true;
                        imgSemDados.ImageUrl = Page.ResolveUrl("~/imagens/semclientes.png");
                        pnAnuncioCategoria.Visible = false;
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

                    string ncategoria = Page.Request.Url.Query;
                    int pos = ncategoria.IndexOf("Convite/");
                    ncategoria = ncategoria.Substring(pos + 8, ncategoria.Length - pos - 8);
                    ncategoria = Server.UrlDecode(ncategoria);

                    ncategoria = Regex.Replace(ncategoria, "-", " ");
                    dadosDesc = ws.descricaoCodigoCategoria(ncategoria);

                    Session["tipo_convite"] = dadosDesc.Tables[0].Rows[0]["codigo"].ToString();
                }

                if (Session["busca"] != null)
                {
                    busca = Session["busca"].ToString();

                    DataSet dados = ws.ConsultaConviteTela(0, busca);
                    if (dados.Tables[0].Rows.Count == 0)
                    {
                        imgSemDados.Visible = true;
                        imgSemDados.ImageUrl = Page.ResolveUrl("~/imagens/semclientes.png");
                        pnAnuncioCategoria.Visible = false;
                    }
                    else
                    {
                        imgSemDados.Visible = false;
                        dlAnunciante.DataSource = dados;
                        dlAnunciante.DataBind();
                    }

                }
                else if (dadosDesc.Tables[0].Rows.Count > 0)
                {
                    vTipoCategoria = Convert.ToInt32(dadosDesc.Tables[0].Rows[0]["codigo"].ToString());
                    DataSet dados = ws.ConsultaConviteTela(vTipoCategoria, "0");
                    if (dados.Tables[0].Rows.Count == 0)
                    {
                        imgSemDados.Visible = true;
                        imgSemDados.ImageUrl = Page.ResolveUrl("~/imagens/semclientes.png");
                        pnAnuncioCategoria.Visible = false;
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
            if (dadosT.Tables[0].Rows.Count != 0)
            {
                lblTituloCat.Text = dadosT.Tables[0].Rows[0]["descricao"].ToString();
                Page.Title = dadosT.Tables[0].Rows[0]["descricao"].ToString();
            }

            recarregaLayout();

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
        lblBairroCidade.Text = Convert.ToString(DataBinder.Eval(dbr, "bairro")) + "-" + Convert.ToString(DataBinder.Eval(dbr, "cidade"));

        Label lblEndereco = (Label)e.Item.FindControl("lblEndereco");
        lblEndereco.Text = Convert.ToString(DataBinder.Eval(dbr, "endereco"));

        Label lblTelefone = (Label)e.Item.FindControl("lblTelefone");
        lblTelefone.Text = Convert.ToString(DataBinder.Eval(dbr, "telefone"));


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
            lnk.Attributes["href"] = "http://" + Convert.ToString(DataBinder.Eval(dbr, "site"));

            HyperLink lnk2 = (HyperLink)e.Item.FindControl("aLogo");

            string myScript = "window.open('" + "http://" + Convert.ToString(DataBinder.Eval(dbr, "site")) + "', null,''); void(0)";
            lnk2.Attributes["onclick"] = myScript;
            lnk.Attributes["onclick"] = myScript;

            lnk2.Attributes["href"] = "http://" + Convert.ToString(DataBinder.Eval(dbr, "site"));

        }


        if (Convert.ToString(DataBinder.Eval(dbr, "email")) == "")
        {
            HyperLink lnk = (HyperLink)e.Item.FindControl("aEmail");
        }
        else
        {
            HyperLink lnk = (HyperLink)e.Item.FindControl("aEmail");
            lnk.Attributes["href"] = "mailto:" + Convert.ToString(DataBinder.Eval(dbr, "email"));
        }


        if (Convert.ToString(DataBinder.Eval(dbr, "endereco")) == "")
        {
            //string endereco = Convert.ToString(DataBinder.Eval(dbr, "endereco")) + " " + Convert.ToString(DataBinder.Eval(dbr, "bairro")) + " " + Convert.ToString(DataBinder.Eval(dbr, "cidade"));
            //string info = "";//lblTituloAnuncio.Text + "</br>" + endereco;

            LinkButton lnk = (LinkButton)e.Item.FindControl("aMapa");
            lnk.Enabled = false;
            //lnk.Attributes["onclick"] = "javascript:window.open('mapa.aspx?info=" + info + "&endereco="+endereco+"', null, 'left = 400, top = 100, height = 480, width = 500, status = no, resizable = no, scrollbars = no, toolbar = no, location = no, menubar = no'); void(0)";

        }

        if (Convert.ToString(DataBinder.Eval(dbr, "foto")) != "")
        {
            Image imgFoto = (Image)e.Item.FindControl("imgFoto");

            string foto = Page.ResolveUrl("~/convites/" + Convert.ToString(DataBinder.Eval(dbr, "foto")));

            imgFoto.ImageUrl = foto;
        }


    }

    protected void ddlFiltro_SelectedIndexChanged(object sender, EventArgs e)
    {
        vTipoCategoria = Convert.ToInt32(Session["tipo_convite"].ToString());
        DataSet dados = ws.ConsultaConviteTela(vTipoCategoria, "0");
        DataTable table = dados.Tables["convite"];
        DataView view = table.DefaultView;
        view.Sort = ddlFiltro.SelectedValue;

        dlAnunciante.DataSource = view;
        dlAnunciante.DataBind();

    }

    protected void dlAnunciante_ItemCommand(object source, DataListCommandEventArgs e)
    {
        if (e.CommandName == "ContaClick")
        {
            Label lnk1 = (Label)e.Item.FindControl("lblCodigoAnuncio");
            string key = lnk1.Text;
            ws.contaClicks(Convert.ToInt32(key));

            HyperLink lnk = (HyperLink)e.Item.FindControl("aLogo");

            string myScript = "window.open('" + lnk.NavigateUrl + "', null,''); void(0)";

            lnk.Attributes["onclick"] = myScript;
        }

        if (e.CommandName == "MostraMapa")
        {

            Label lblEndereco = (Label)e.Item.FindControl("lblEndereco");
            Label lblBairroCidade = (Label)e.Item.FindControl("lblBairroCidade");
            Label lblNomeFantasia = (Label)e.Item.FindControl("lblNomeFantasia");

            string endereco;
            endereco = lblEndereco.Text + " " + lblBairroCidade.Text;

            ifCategoriaAnuncio.Attributes["src"] = Page.ResolveUrl("~/mapa.aspx?endereco=" + endereco + "&t=" + lblNomeFantasia.Text);
            AjaxControlToolkit.ModalPopupExtender mp = (AjaxControlToolkit.ModalPopupExtender)e.Item.FindControl("btnMapaCategoria_ModalPopupExtender");
            mp.Show();
            UpdatePanel1.Update();

        }

    }

    protected void ddlMes_SelectedIndexChanged(object sender, EventArgs e)
    {
        DropDownList actionsDDL = sender as DropDownList;
        Label projectCandidateIdHF = actionsDDL.Parent.FindControl("lblCodAnuncio") as Label;
    }

    private void recarregaLayout()
    {
        btnFechar.ImageUrl = Page.ResolveUrl("~/imagens/close.png");
        Image img = (Image)UpdateProgress2.FindControl("imgAguarde");
        img.ImageUrl = Page.ResolveUrl("~/imagens/wait.gif");

    }
}