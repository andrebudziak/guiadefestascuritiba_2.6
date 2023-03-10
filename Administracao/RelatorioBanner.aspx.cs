using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class Administracao_RelatorioBanners : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (Session["hash"] != null)
        {
            string strTitle = "Relatório de Banners";
            DataGrid drg = new DataGrid();
            drg.AutoGenerateColumns = true;
            WebService ws = new WebService();
            DataSet dados = ws.ConsultaBanner(0, "0");
            drg.DataSource = dados;
            drg.DataBind();
            new DataGridExcelExporter(drg, this.Page).Export(strTitle);

        }
        else
        {
            Response.Redirect("login.aspx");
        }

    }
}