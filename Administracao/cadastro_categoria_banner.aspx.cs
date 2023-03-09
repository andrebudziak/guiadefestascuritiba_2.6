using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class Administracao_cadastro_categoria_banner : System.Web.UI.Page
{
    WebService ws = new WebService();

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            lblHash.Visible = false;
            populaCategoria(0, ddlCategoria);
            populaBanner(0, 0, ddlBanner);

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
            ddlCategoria.SelectedValue = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblCodigoCategoria")).Text;            
            ddlBanner.SelectedValue = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblCodigoBanner")).Text;

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

        e.InputParameters["codigoBanner"] = ddlBanner.SelectedValue;
        e.InputParameters["codigoCategoria"] = ddlCategoria.SelectedValue;

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
            e.InputParameters["banner"] = "0";
        else
            e.InputParameters["banner"] = txtPesquisa.Text;

        if (ddlCategoria.SelectedValue == "")
           e.InputParameters["categoria"] = "0";
        else
           e.InputParameters["categoria"] = ddlCategoria.SelectedValue;


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
        populaCategoria(0, ddlCategoria);
        populaBanner(0, 0, ddlBanner);
        grdDados.DataBind();
        ObjectDataSource1.Select();

    }

    private void populaCategoria(Int32 codigo_categoria, DropDownList dl)
    {
        DataSet data = ws.PopulaCategoria();
        //criar um objeto Data Row
        DataRow oDR = data.Tables[0].NewRow();

        //Preencher o datarow com valores
        oDR["descricao"] = "[Selecione]";
        oDR["codigo"] = "0";

        //Incluir um datarow ao dataset
        data.Tables[0].Rows.Add(oDR);

        dl.DataSource = data;
        dl.DataBind();

        dl.Items.FindByValue("0").Selected = true;
        
    }


    private void populaBanner(Int32 codigo_banner,Int32 codigo_categoria, DropDownList dl)
    {
        DataSet data = ws.DadosBannerCategoria(codigo_banner,"0",codigo_categoria);
        //criar um objeto Data Row
        DataRow oDR = data.Tables[0].NewRow();

        //Preencher o datarow com valores
        oDR["banner"] = "[Selecione]";
        oDR["codigo_banner"] = "0";

        //Incluir um datarow ao dataset
        data.Tables[0].Rows.Add(oDR);

        dl.DataSource = data;
        dl.DataBind();

        dl.Items.FindByValue("0").Selected = true;

    }


    protected void ddlCategoria_SelectedIndexChanged(object sender, EventArgs e)
    {
        populaBanner(0, Convert.ToInt32(ddlCategoria.SelectedValue), ddlBanner);
    }
}