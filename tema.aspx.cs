using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;

public partial class tema : System.Web.UI.Page
{
    private WebService ws = new WebService();

    private void Page_PreInit(object sender, EventArgs e)
    {
        Session["menu"] = "0";
    }

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            GeraDestaque(dlDestaque, "0");
        }

    }

    private void GeraDestaque(DataList dt, string op)
    {
        DataSet dados = ws.ConsultaDestaque(0, "0", 2);
        dt.DataSource = dados;
        dt.DataBind();
    }

}