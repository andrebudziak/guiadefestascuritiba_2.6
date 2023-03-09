using System;
using System.Data;
using System.Configuration;
using System.Collections;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using System.Web.Services;
using eChat;
using System.Web.Script.Services;
using System.Web.Script;
using System.Collections.Generic;
 
public partial class Chat : System.Web.UI.Page
{
    WebService ws = new WebService();
    
    protected void Page_Load(object sender, EventArgs e)
    {
        if (Session["UserName"] == null)
            Response.Redirect("Index.aspx");
        if (string.IsNullOrEmpty(Request.QueryString["rid"]))
            Response.Redirect("Index.aspx");        

        if (Request.QueryString["tp"].ToString() == "2")
        {
            dlStatus.Visible = false;
            lblStatus.Visible = false;
            lblUserName.Text = Session["UserName"].ToString();
        }
        if (Request.QueryString["tp"].ToString() == "1")
        {
            if (Session["idCliente"] == null)
                Response.Redirect("Index.aspx");
            else
            {
                int idCliente = Convert.ToInt32(Session["idCliente"].ToString());
                if (Session["idSessao"] == null)
                {
                    int idSessao = ws.SetStatusChat(0, idCliente, 1);
                    Session["idSessao"] = idSessao;
                }

            }
            lblUserName.Text = Session["UserName"].ToString();

            dlStatus.Visible = true;
            lblStatus.Visible = true;
        }

        txtMsg.Attributes.Add("onkeypress", "return clickButton(event,'btn')");
        if (!IsPostBack)
		{
           hdnRoomID.Value = Request.QueryString["rid"];
           ChatRoom room = ChatEngine.GetRoom(hdnRoomID.Value);
		   string prevMsgs=room.JoinRoom(Session["UserName"].ToString(),Session["UserName"].ToString() );
           txt.Text = prevMsgs;
       
           foreach (string s in room.GetRoomUsersNames())
           {
              lstMembers.Items.Add(new ListItem(s, s));
           }

           foreach (ListItem lst in lstMembers.Items)
           {
               dlFalar.Items.Add(lst);
           }

            DataSet dados = ws.DadosUsuariosChat();
            ddlClientes.DataSource = dados;
            ddlClientes.DataBind();
             
            /*dlFalar.DataSource = dados;
            dlFalar.DataBind();
            dlFalar.Items.Insert(0, new ListItem("Todos", "0", true));*/
					
		}			
        	
    }
   

    #region Script Callback functions

    /// <summary>
    /// This function is called from the client script 
    /// </summary>
    /// <param name="msg"></param>
    /// <param name="roomID"></param>
    /// <returns></returns>
    [WebMethod]
    static public string SendMessage(string msg, string roomID, string msgFrom)
    {
        try
        {
            ChatRoom room = ChatEngine.GetRoom(roomID);
            string res = "";
            if (room != null)
            {
                res = room.SendMessage(msg, HttpContext.Current.Session["UserName"].ToString(), msgFrom);
            }
            return res;
        }
        catch (Exception ex)
        {

        }
        return "";
    }


    /// <summary>
    /// This function is called peridically called from the user to update the messages
    /// </summary>
    /// <param name="otherUserID"></param>
    /// <returns></returns>
    [WebMethod]
    static public string UpdateUser(string roomID)
    {
        try
        {
            ChatRoom room = ChatEngine.GetRoom(roomID);
            if (room != null)
            {
                string res = "";
                if (room != null)
                {
                    res = room.UpdateUser(HttpContext.Current.Session["UserName"].ToString());
                }
                return res;
            }
        }
        catch (Exception ex)
        {

        }
        return "";
    }


    /// <summary>
    /// This function is called from the client when the user is about to leave the room
    /// </summary>
    /// <param name="otherUser"></param>
    /// <returns></returns>
    [WebMethod]
    static public string LeaveRoom(string roomID)
    {
        try
        {
            ChatRoom room = ChatEngine.GetRoom(roomID);
            if (room != null)
            {
                int idCliente = Convert.ToInt32(HttpContext.Current.Session["idCliente"].ToString());
                room.UpdateAnunciante(HttpContext.Current.Session["UserName"].ToString(), idCliente);
                room.LeaveRoom(HttpContext.Current.Session["UserName"].ToString());
            }
        }
        catch (Exception ex)
        {

        }
        return "";
    }


    /// <summary>
    /// Returns a comma separated string containing the names of the users currently online
    /// </summary>
    /// <param name="roomID"></param>
    /// <returns></returns>
    [WebMethod]
    static public string UpdateRoomMembers(string roomID)
    {
        try
        {
            ChatRoom room = ChatEngine.GetRoom(roomID);
            if (room != null)
            {
                IEnumerable<string> users=room.GetRoomUsersNames();
                string res="";

                foreach (string  s in users)
	            {
                    res+=s+",";
		    	}
                return res;
            }
        }
        catch (Exception ex)
        {
        }
        return "";
    }
    #endregion

    protected void btnEnviar_Click(object sender, EventArgs e)
    {

    }


    protected void dlFalar_SelectedIndexChanged(object sender, EventArgs e)
    {
        //ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>AtualizaLista(); </script>", false);
        
        DataSet dados = ws.DadosUsuariosChat();
        ddlClientes.DataSource = dados;
        ddlClientes.DataBind();
    }

    protected void ddlClientes_ItemDataBound1(object sender, DataListItemEventArgs e)
    {
        DataRowView dbr = (DataRowView)e.Item.DataItem;
        if (Convert.ToString(DataBinder.Eval(dbr, "status")) != "")
        {
            string status = Convert.ToString(DataBinder.Eval(dbr, "status"));
            HtmlImage btn = (HtmlImage)e.Item.FindControl("imgStatus");

            if (status == string.Empty)
                btn.Src = "~/imagens/offline.png";
            if (status == "0")
                btn.Src = "~/imagens/offline.png";
            if (status == "1")
                btn.Src = "~/imagens/online.png";
            if (status == "2")
                btn.Src = "~/imagens/ausente.png";
            if (status == "3")
                btn.Src = "~/imagens/ocupado.png";
        }

        if (Convert.ToString(DataBinder.Eval(dbr, "site")) != "")
        {
            HyperLink lnk = (HyperLink)e.Item.FindControl("aCliente");
            lnk.Attributes["href"] = "http://" + Convert.ToString(DataBinder.Eval(dbr, "site"));

        }


    }
    protected void dlStatus_SelectedIndexChanged(object sender, EventArgs e)
    {
        if (Session["idSessao"] != null)
        {
            int idCliente = Convert.ToInt32(Session["idCliente"].ToString());
            ws.SetStatusChat(1,idCliente,Convert.ToInt32(dlStatus.SelectedValue));

            DataSet dados = ws.DadosUsuariosChat();
            ddlClientes.DataSource = dados;
            ddlClientes.DataBind();

        }
    }
}
