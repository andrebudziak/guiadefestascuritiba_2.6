using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class Administracao_cadastro_categoria_anuncio : System.Web.UI.Page
{
    WebService ws = new WebService();

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            lblHash.Visible = false;
            populaCategoria(0, ddlCategoria);
            populaAnuncio(ddlAnuncio);

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
            ddlAnuncio.SelectedValue = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblCodigoAnuncio")).Text;

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

        e.InputParameters["codigo_anunciante"] = ddlAnuncio.SelectedValue;
        e.InputParameters["codigo_categoria"] = ddlCategoria.SelectedValue;

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
            e.InputParameters["nome"] = "0";
        else
            e.InputParameters["nome"] = txtPesquisa.Text;

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
        populaAnuncio(ddlAnuncio);
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


    private void populaAnuncio(DropDownList dl)
    {
        DataSet data = ws.PopulaAnuncio();
        //criar um objeto Data Row
        DataRow oDR = data.Tables[0].NewRow();

        //Preencher o datarow com valores
        oDR["nome_fantasia"] = "[Selecione]";
        oDR["codigo"] = "0";

        //Incluir um datarow ao dataset
        data.Tables[0].Rows.Add(oDR);

        dl.DataSource = data;
        dl.DataBind();

        dl.Items.FindByValue("0").Selected = true;

    }


    protected void ddlCategoria_SelectedIndexChanged(object sender, EventArgs e)
    {
        
    }
}