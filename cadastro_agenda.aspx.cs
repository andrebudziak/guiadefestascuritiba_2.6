using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class cadastro_agenda : System.Web.UI.Page
{
    public bool exportando;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            lblHash.Visible = false;
            lblCodigoAnuncio.Visible = false;

            /*########################### APAGUE ##################*/
            lblCodigoAnuncio.Text = "40";
            /*#####################################################*/

            if (Request.QueryString["h"] != null)
            {
                lblHash.Text = Request.QueryString["h"].ToString();

                lblCodigo.Visible = false;
                //  set the key names from my data class.
                grdBonus.DataKeyNames = new WebService().PrimaryKeyColumnNames;

                //'HTTP/1.1
                Response.CacheControl = "no-cache";
                Response.AddHeader("cache-control", "no-cache");
                //'HTTP/1.0
                Response.AddHeader("Pragma", "no-cache");
                Response.Expires = -1;// ' minutos até a expiração
                Response.ExpiresAbsolute = DateTime.Now; //' data de expiração

            }
            else
            {
                // Response.Redirect("login.aspx");
            }


        }
        

    }

    private bool LoadDataEmpty
    {
        //  some controls that are used within a GridView, such as the calendar control, can cuase post backs.
        //  we need to preserve LoadDataEmpty across post backs.
        get { return (bool)(ViewState["LoadDataEmpty"] ?? false); }
        set { ViewState["LoadDataEmpty"] = value; }
    }

    protected void grdBonus_RowCommand(object sender, GridViewCommandEventArgs e)
    {
        //  handle the save button on the footer row.
        if (e.CommandName == "Save")
        {
            ObjectDataSource1.Insert();
        }
        if (e.CommandName == "Update")
        {
            ObjectDataSource1.Update();
        }
    }
    protected void ObjectDataSource1_Updating(object sender, ObjectDataSourceMethodEventArgs e)
    {
        e.InputParameters["codigo"] = ((TextBox)grdBonus.Rows[grdBonus.EditIndex].FindControl("txtCodigo")).Text;
        e.InputParameters["codigo_anuncio"] = lblCodigoAnuncio.Text;
        e.InputParameters["descricao"] = ((TextBox)grdBonus.Rows[grdBonus.EditIndex].FindControl("txtDescricao")).Text;
        e.InputParameters["status"] = ((DropDownList)grdBonus.Rows[grdBonus.EditIndex].FindControl("ddlStatus")).SelectedValue;
        e.InputParameters["data"] = ((TextBox)grdBonus.Rows[grdBonus.EditIndex].FindControl("txtData")).Text;
    }

    protected void grdBonus_RowDeleting(object sender, GridViewDeleteEventArgs e)
    {
        int index = e.RowIndex;
        int codigo = Convert.ToInt32(((Label)grdBonus.Rows[index].FindControl("lblCodigo")).Text);
        lblCodigo.Text = codigo.ToString();
    }

    protected void ObjectDataSource1_Inserting(object sender, ObjectDataSourceMethodEventArgs e)
    {
        if(((TextBox)grdBonus.FooterRow.FindControl("txtCodigo")).Text == string.Empty) 
           e.InputParameters["codigo"] = "0";
        else
            e.InputParameters["codigo"] = ((TextBox)grdBonus.FooterRow.FindControl("txtCodigo")).Text;

        e.InputParameters["codigo_anuncio"] = lblCodigoAnuncio.Text;
        e.InputParameters["descricao"] = ((TextBox)grdBonus.FooterRow.FindControl("txtDescricao")).Text;
        e.InputParameters["status"] = ((DropDownList)grdBonus.FooterRow.FindControl("ddlStatus")).SelectedValue;
        e.InputParameters["data"] = ((TextBox)grdBonus.FooterRow.FindControl("txtData")).Text;
    }

    protected void ObjectDataSource1_Deleting(object sender, ObjectDataSourceMethodEventArgs e)
    {
        e.InputParameters["codigo"] = lblCodigo.Text;
    }

    protected void ObjectDataSource1_Selected(object sender, ObjectDataSourceStatusEventArgs e)
    {
        //  bubble exceptions before we touch e.ReturnValue
        if (e.Exception != null)
        {
            throw e.Exception;
        }

        //  get the DataTable from the ODS select mothod
        DataSet dataTable = (DataSet)e.ReturnValue;

        //  if rows=0 then add a dummy (null) row and set the LoadDataEmpty flag.
        if (dataTable.Tables[0].Rows.Count == 0)
        {
            dataTable.Tables[0].Rows.Add(dataTable.Tables[0].NewRow());
            LoadDataEmpty = true;
        }
        else
        {
            LoadDataEmpty = false;
        }

    }

    protected void grdBonus_RowCreated(object sender, GridViewRowEventArgs e)
    {
        //  when binding a row, look for a zero row condition based on the flag.
        //  if we have zero data rows (but a dummy row), hide the grid view row
        //  and clear the controls off of that row so they don't cause binding errors
        if (LoadDataEmpty && e.Row.RowType == DataControlRowType.DataRow)
        {
            e.Row.Visible = false;
            e.Row.Controls.Clear();
        }
    }


    protected void grdBonus_RowDataBound(object sender, GridViewRowEventArgs e)
    {
        if (e.Row.RowType == DataControlRowType.DataRow)
        {
            DataRowView dbr = (DataRowView)e.Row.DataItem;

            Label lblData = (Label)e.Row.FindControl("lblData");
            if(lblData != null)
               lblData.Text = string.Format("{0:dd/MM/yyyy}", Convert.ToDateTime(DataBinder.Eval(dbr, "data")));
        }

    }
}