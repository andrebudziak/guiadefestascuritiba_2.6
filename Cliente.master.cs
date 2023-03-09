using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class Cliente : System.Web.UI.MasterPage
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        { 
        
        }
    }

    protected void lbtnAgenda_Click(object sender, EventArgs e)
    {
        Response.Redirect("cadastro_agenda.aspx");
    }

}
