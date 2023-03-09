using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class Administracao_cadastro_oferta : System.Web.UI.Page
{
    WebService ws = new WebService();

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            lblHash.Visible = false;
            if (Session["hash"] != null)
            {
                lblHash.Text = Session["hash"].ToString();
                lblCodigo.Text = "0";
            }
            else
            {
                // Response.Redirect("login.aspx");
                lblCodigo.Text = "0";

            }
        }
    }

    protected void btnIncluir_Click(object sender, EventArgs e)
    {
        ObjectDataSource1.Insert();
        ObjectDataSource1.Select();

        string myScript = @"alert('Registro Incluido!');";
        ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);

    }

    protected void grdDados_RowDeleting(object sender, GridViewDeleteEventArgs e)
    {
        int index = e.RowIndex;
        int codigo = Convert.ToInt32(((Label)grdDados.Rows[index].FindControl("lblCodigo")).Text);
        lblCodigo.Text = codigo.ToString();
    }

    protected void grdDados_RowCommand(object sender, GridViewCommandEventArgs e)
    {
        if (e.CommandName == "Select")
        {

            WebControl wc = ((WebControl)e.CommandSource);
            GridViewRow row = ((GridViewRow)wc.NamingContainer);

            lblCodigo.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblCodigo")).Text;
            ddlCliente.SelectedValue = ((DropDownList)grdDados.Rows[row.RowIndex].FindControl("ddlCliente")).SelectedValue;
            txtDescricao.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblDescricao")).Text;
            txtDesconto.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblDesconto")).Text;
            txtDe.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblDe")).Text;
            txtPor.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblPor")).Text;
            txtEconomia.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblEconomia")).Text;
            txtValidade.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblValidade")).Text;
            txtValidade.Text = Convert.ToDateTime(txtValidade.Text).ToString("dd/MM/yyyy");
            txtArquivoMiniatura.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblMiniatura")).Text;
            txtArquivoNormal.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblOferta")).Text;
            ddlStatus.SelectedValue = ((DropDownList)grdDados.Rows[row.RowIndex].FindControl("ddlStatus")).SelectedValue;
            
            DataSet dadost = ws.ConsultaOferta(Convert.ToInt32(lblCodigo.Text), "0");
            CKEditor1.Text = dadost.Tables[0].Rows[0]["texto"].ToString();
        }
    }

    protected void grdDados_RowDataBound(object sender, GridViewRowEventArgs e)
    {
        if (e.Row.RowType == DataControlRowType.DataRow)
        {

        }
    }

    protected void ObjectDataSource1_Deleting(object sender, ObjectDataSourceMethodEventArgs e)
    {
        e.InputParameters["codigo"] = lblCodigo.Text;
        lblCodigo.Text = "0";
    }

    protected void ObjectDataSource1_Inserting(object sender, ObjectDataSourceMethodEventArgs e)
    {
        if (lblCodigo.Text == "0")
            e.InputParameters["codigo"] = 0;
        else
            e.InputParameters["codigo"] = Convert.ToInt32(lblCodigo.Text);

        e.InputParameters["codigo_anuncio"] = ddlCliente.SelectedValue;
        e.InputParameters["descricao"] = txtDescricao.Text;
        e.InputParameters["desconto"] = txtDesconto.Text;
        e.InputParameters["de"] = txtDe.Text;
        e.InputParameters["por"] = txtPor.Text;
        e.InputParameters["economia"] = txtEconomia.Text;
        e.InputParameters["validade"] = Convert.ToDateTime(txtValidade.Text);
        e.InputParameters["texto"] = CKEditor1.Text;
        e.InputParameters["miniatura"] = txtArquivoMiniatura.Text;
        e.InputParameters["oferta"] = txtArquivoNormal.Text;
        e.InputParameters["status"] = ddlStatus.SelectedValue;

    }

    protected void btnSalvar_Click(object sender, EventArgs e)
    {
        ObjectDataSource1.Insert();
        ObjectDataSource1.Select();

        string myScript = @"alert('Registro Salvo!');";
        ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);
    }

    protected void ImageButton1_Click(object sender, ImageClickEventArgs e)
    {
        Response.Redirect("Default.aspx");

    }

    protected void ObjectDataSource1_Selecting(object sender, ObjectDataSourceSelectingEventArgs e)
    {
        e.InputParameters["codigo"] = "0";
        if (txtPesquisa.Text == "")
            e.InputParameters["descricao"] = "0";
        else
            e.InputParameters["descricao"] = txtPesquisa.Text;
    }

    protected void btnPesquisar_Click1(object sender, EventArgs e)
    {
        if (txtPesquisa.Text != "")
        {
            grdDados.DataBind();
            ObjectDataSource1.Select();
        }
        else
        {
            string myScript = @"alert('Digite um valor no campo pesquisa!');";
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);
        }


    }

    protected void btnRefresh_Click(object sender, ImageClickEventArgs e)
    {
        txtPesquisa.Text = "";
        grdDados.DataBind();
        ObjectDataSource1.Select();

    }

    protected void AsyncFileUpload1_UploadedCompleteM(object sender, AjaxControlToolkit.AsyncFileUploadEventArgs e)
    {
        System.Threading.Thread.Sleep(5000);
        if (fileUploadMiniatura.HasFile)
        {
            string strPath = MapPath("~/ofertas/") + fileUploadMiniatura.FileName;
            fileUploadMiniatura.SaveAs(strPath);
        }
    }

    protected void AsyncFileUpload1_UploadedCompleteN(object sender, AjaxControlToolkit.AsyncFileUploadEventArgs e)
    {
        System.Threading.Thread.Sleep(5000);
        if (fileUploadNormal.HasFile)
        {
            string strPath = MapPath("~/ofertas/") + fileUploadNormal.FileName;
            fileUploadNormal.SaveAs(strPath);
        }
    }


}