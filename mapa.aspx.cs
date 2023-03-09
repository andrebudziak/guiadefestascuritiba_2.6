using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.HtmlControls;
using System.Text;

public partial class mapa : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {

            if (Request.QueryString["endereco"] != null)
            {
                string info = Request.QueryString["info"].ToString();
                string endereco = Request.QueryString["endereco"].ToString();

                var mapPanel = pnMap;
                var divId = string.Format("dealloc_{0}", "1");
                var div = new HtmlGenericControl("div");
                div.Attributes.Add("id", divId);
                div.Attributes.Add("class", "mapdiv");
                mapPanel.Controls.Add(div);

                string js = GetJScriptForGeoAdress(divId, endereco, info);

                ScriptManager.RegisterStartupScript(this.Page, this.GetType(), "_map_" + "1", js, true);
            }
        
        }

    }


    public static string GetJScriptForGeoAdress(string id, string endereco, string info)
    {
        StringBuilder sb = new StringBuilder();

        sb.Append("function initialize_" + id + "() {{");
        sb.Append(" if (GBrowserIsCompatible()) {{ ");
        sb.Append(" var map = new GMap2(document.getElementById(\"{0}\"));");
        sb.Append("map.setCenter(new GLatLng(37.4419, -122.1419), 16);");
        sb.Append("geocoder = new GClientGeocoder();");
        sb.Append("if (geocoder) {{");
        sb.Append("geocoder.getLatLng(");
        sb.Append("'{1}',");
        sb.Append("function (point) {{");
        sb.Append("if (!point) {{");
        sb.Append("alert('{1} not found');");
        sb.Append("}} else {{");
        sb.Append("map.setCenter(point, 16);");
        sb.Append("var marker = new GMarker(point);");
        sb.Append("map.addOverlay(marker);");
        sb.Append("marker.openInfoWindowHtml('{2}');");
        sb.Append("}}}});}}");
        sb.Append("map.setUIToDefault();");

        sb.Append("}}}} initialize_" + id + "();");

        return string.Format(sb.ToString(), id, endereco, info);


    }

}