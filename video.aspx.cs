using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class video : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {

       if (Request.QueryString["a"] != null)
       {
           string arquivo = Request.QueryString["a"].ToString();

           if (arquivo.Substring(0, 4) == "http")
           {
               demoplayer.Attributes["src"] = arquivo;
           }
           else
               demoplayer.Attributes["src"] = "album/" + arquivo;
       }

    }
}