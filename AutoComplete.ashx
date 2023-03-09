<%@ WebHandler Language="C#" Class="AutoComplete" %>

using System;
using System.Web;
using System.Data.SqlClient;
using System.Configuration;
using System.Collections.Generic;

public class AutoComplete : IHttpHandler {

    public void ProcessRequest(HttpContext context)
    {
        string firstname = context.Request.QueryString["q"];
        
        string sql = "select c.nome_fantasia from cliente c "+
                      "INNER JOIN anuncio a ON a.codigo_cliente = c.codigo "+
                      "WHERE (c.nome_fantasia like '%" + firstname + "%' and a.status=1 )  ";
        string conexao = ConfigurationManager.AppSettings["ConnectionString"];
        using (SqlConnection connection = new SqlConnection(conexao))
        using (SqlCommand command = new SqlCommand(sql, connection))
        {
            connection.Open();

            using (SqlDataReader reader = command.ExecuteReader())
            {
                List<string> list = new List<string>();
                while (reader.Read())
                {
                    context.Response.Write(reader[0].ToString() + Environment.NewLine);
                }
            }
        }
    }
 
    public bool IsReusable {
        get {
            return false;
        }
    }

}