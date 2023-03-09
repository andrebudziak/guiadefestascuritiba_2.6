using System;
using System.Web;
using System.Web.Services;
using System.Web.Services.Protocols;
using System.Data;
using System.Configuration;
using System.Data.SqlClient;
using eChat;
using System.Collections.Generic;

[WebService(Namespace = "http://tempuri.org/")]
[WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
// To allow this Web Service to be called from script, using ASP.NET AJAX, uncomment the following line. 
// [System.Web.Script.Services.ScriptService]
public class Service : System.Web.Services.WebService
{
    private string connstring = "server=sqlserver01.guiadefestascuritiba.hospedagemdesites.ws;uid=guiadefestascuritiba;pwd=guia@curitiba;database=guiadefestascuritiba;Enlist=false;Connection lifetime=50;Pooling=true;Packet Size=8192;";

    public Service () 
    {

        //Uncomment the following line if using designed components 
        //InitializeComponent(); 
    }

    [WebMethod(Description = "Logar no sistema")]
    public int authenticateUser(string UserName, string Password)
    {
    
        SqlConnection con = new SqlConnection();
        con.ConnectionString = connstring;
        con.Open();

        SqlCommand comm = new SqlCommand("select descricao,senha,codigo_anunciante from usuario where descricao = @usuario AND senha = @senha", con);
        SqlParameter pUserName = new SqlParameter("@usuario", UserName);
        SqlParameter pPassword = new SqlParameter("@senha", Password);

        comm.Parameters.Add(pUserName);
        comm.Parameters.Add(pPassword);

        SqlDataReader r = comm.ExecuteReader();
        int id = 0;

		if (r.HasRows)
		{
            while (r.Read())
            {
                id = r.GetInt32(2);
                return id;
            }
		}
		else
		{
            return 0;
		}
        comm.Dispose();
        r.Dispose();
        con.Close();
        return 0;

    }

    [WebMethod(Description = "Nome no sistema")]
    public string NomeUser(string UserName, string Password)
    {

        SqlConnection con = new SqlConnection();
        con.ConnectionString = connstring;
        con.Open();

        SqlCommand comm = new SqlCommand("select c.nome_fantasia,u.descricao,u.senha,u.codigo_anunciante from usuario u  " +
                                         "inner join cliente c on c.codigo = u.codigo_anunciante  " +
                                         "where u.descricao = @usuario AND u.senha = @senha", con);
        SqlParameter pUserName = new SqlParameter("@usuario", UserName);
        SqlParameter pPassword = new SqlParameter("@senha", Password);

        comm.Parameters.Add(pUserName);
        comm.Parameters.Add(pPassword);

        SqlDataReader r = comm.ExecuteReader();
        string nome = "";

        if (r.HasRows)
        {
            while (r.Read())
            {
                nome = r.GetString(0);
                return nome;
            }
        }
        else
        {
            return "";
        }
        comm.Dispose();
        r.Dispose();
        con.Close();
        return "";

    }


   

    
}
