using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class tvOnline : System.Web.UI.Page
{
    private WebService ws = new WebService();
    PagedDataSource pds = new PagedDataSource();

    private void Page_PreInit(object sender, EventArgs e)
    {
        Session["menu"] = "0";
    }

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            MostraVideo();

            if (Session["idVideo"] != null)
            {
               DataSet dado = ws.ConsultaVideo(Convert.ToInt32(Session["idVideo"].ToString()), "0");
               string arquivo = dado.Tables[0].Rows[0]["video"].ToString();

               dlVideoGrande.DataSource = dado;
               dlVideoGrande.DataBind();

               upPlayerTv.Update();

            }

            DataSet dados = ws.ConsultaVideo(0, "0");
            dlVideo.DataSource = dados;
            dlVideo.DataBind();

            recarregaLayout();
        }

    }

    protected void dlVideo_ItemCommand(object source, DataListCommandEventArgs e)
    {

        if (e.CommandName == "MostraVideo")
        {

            WebControl wc = ((WebControl)e.CommandSource);
            DataListItem row = ((DataListItem)wc.NamingContainer);

            LinkButton lkbItem = ((LinkButton)dlVideo.Items[row.ItemIndex].FindControl("aBanner"));

            DataSet dado = ws.ConsultaVideo(Convert.ToInt32(lkbItem.CommandArgument), "0");
            string arquivo = dado.Tables[0].Rows[0]["video"].ToString();

            upTvOnline.Update();
            //Label lblVisualiza = ((Label)dlVideoGrande.Items[0].FindControl("lblVisualiza"));
            //lblVisualiza.Text = montaVisualizadorG(arquivo);

            DataSet dados = ws.ConsultaVideo(0, "0");
            dlVideo.DataSource = dados;
            dlVideo.DataBind();

            dlVideoGrande.DataSource = dado;
            dlVideoGrande.DataBind();

            upPlayerTv.Update();
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

        if (Convert.ToString(DataBinder.Eval(dbr, "descricao")) != "")
        {
            Label lblDesc = (Label)e.Item.FindControl("lblDescricao");
            lblDesc.Text = Convert.ToString(DataBinder.Eval(dbr, "descricao"));
        }

        if (Convert.ToString(DataBinder.Eval(dbr, "titulo")) != "")
        {
            Label lblDesc = (Label)e.Item.FindControl("lblTitulo");
            lblDesc.Text = Convert.ToString(DataBinder.Eval(dbr, "titulo"));
        }

    }
  

    protected void dlVideoGrande_ItemDataBound(object sender, DataListItemEventArgs e)
    {
        DataRowView dbr = (DataRowView)e.Item.DataItem;

        if (Convert.ToString(DataBinder.Eval(dbr, "video")) != "")
        {

           string arquivo = Convert.ToString(DataBinder.Eval(dbr, "video"));
           Label lblVisualiza = ((Label)e.Item.FindControl("lblVisualiza"));
           lblVisualiza.Text = montaVisualizadorG(arquivo);

           Label lblArquivo = ((Label)e.Item.FindControl("lblArquivo"));
           lblArquivo.Text = arquivo;
            /*string imagem = Page.ResolveUrl("~/video/" + Convert.ToString(DataBinder.Eval(dbr, "miniatura")));
            Image imgVideo = (Image)e.Item.FindControl("imgVideo");
            imgVideo.ImageUrl = imagem;*/
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
                             "height='390px' marginheight='0' src='video.aspx?a=" + nomeArquivo + "' marginwidth='0' scrolling='auto' " +
                             "width='640px'>" +
                             "</iframe>";

                    break;
                }
        }

        if (nomeArquivo.Substring(0, 4).ToUpper() == "HTTP")
        {
            player = " <iframe ID='ifVideo' runat='server' align='middle' frameborder='0' " +
                     "height='400px' marginheight='0' src=" + Page.ResolveUrl("~/video.aspx") + "?a=" + nomeArquivo + "' marginwidth='0' scrolling='auto' " +
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
        pds.PageSize = 1;
        pds.CurrentPageIndex = CurrentPage;
        lnkProximo.Enabled = !pds.IsLastPage;
        lnkAnterior.Enabled = !pds.IsFirstPage;

        dlVideoGrande.DataSource = pds;
        dlVideoGrande.DataBind();
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

    private void recarregaLayout()
    {
        imgPlayDir.ImageUrl = Page.ResolveUrl("~/imagens/play_dir.png");
        imgPlayEsq.ImageUrl = Page.ResolveUrl("~/imagens/play_esq.png");

    }

}