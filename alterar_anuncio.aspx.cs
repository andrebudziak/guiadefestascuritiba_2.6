using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class alterar_anuncio : System.Web.UI.Page
{
    DataTable tabela = new DataTable();

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {

            if (Session["dadosT"] != null)
            {
                tabela = ((DataTable)HttpContext.Current.Session["dadosT"]);
                
                grdDados.DataSource = tabela;
                grdDados.DataBind();

            }
            else
            {
                tabela = CriaDataTable();
                Session["dadosT"] = tabela;
            }

            grdDados.DataSource = tabela;
            grdDados.DataBind();

        }

    }

    protected void AsyncFileUpload1_UploadedComplete(object sender, AjaxControlToolkit.AsyncFileUploadEventArgs e)
    {
        System.Threading.Thread.Sleep(5000);

        if (fileUploadArquivo1.HasFile)
        {
            string strPath = MapPath("~/temas/") + fileUploadArquivo1.FileName;
            fileUploadArquivo1.SaveAs(strPath);
            
            tabela = ((DataTable)HttpContext.Current.Session["dadosT"]);
            incluirNoDataTable(fileUploadArquivo1.FileName, tabela);

        }
    }

    private DataTable CriaDataTable()
    {

       DataTable mDataTable = new DataTable();

       DataColumn mDataColumn;

       mDataColumn = new DataColumn();
       mDataColumn.DataType = Type.GetType("System.String");
       mDataColumn.ColumnName = "foto";
       mDataTable.Columns.Add(mDataColumn);

       return mDataTable;
    }

    private DataTable incluirNoDataTable(string foto, DataTable mTable)
    {
       DataRow linha;

       linha = mTable.NewRow();

       linha["foto"] = foto;

       mTable.Rows.Add(linha);

       return mTable;
    }

    protected void grdDados_RowDeleting(object sender, GridViewDeleteEventArgs e)
    {
        int index = e.RowIndex;
        int codigo = Convert.ToInt32(((Label)grdDados.Rows[index].FindControl("lblCodigo")).Text);
    }

    protected void grdDados_RowCommand(object sender, GridViewCommandEventArgs e)
    {
        if (e.CommandName == "Select")
        {

            WebControl wc = ((WebControl)e.CommandSource);
            GridViewRow row = ((GridViewRow)wc.NamingContainer);


        }
    }

    protected void grdDados_RowDataBound(object sender, GridViewRowEventArgs e)
    {
        if (e.Row.RowType == DataControlRowType.DataRow)
        {

        }
    }



}