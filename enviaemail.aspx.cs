using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Net;
using System.Net.Mail;

public partial class enviaemail : System.Web.UI.Page
{
    private string message;
    private string nomeremetente;
    private string emailsmtp;
    private string emailcontato;
    private string assunto;
    private string informacoes;
    private string smtp;
    private string senhasmtp;

    protected void Page_Load(object sender, EventArgs e)
    {
        if(Form.Method == "post")
        {
            nomeremetente = Request.Form["nomeremetente"];
            emailcontato = Request.Form["emailcontato"];
            assunto = Request.Form["assunto"];
            informacoes = Request.Form["mensagem"];
            emailsmtp = Request.Form["emailsmtp"];
            smtp = Request.Form["smtp"];
            senhasmtp = Request.Form["senhasmtp"];

            enviaEmail(message, nomeremetente, emailsmtp, emailcontato, assunto, informacoes, smtp, senhasmtp);          
        
        }
    }


    private void enviaEmail(string message, string nome, string emailsmtp, string emailcontato, string assunto, string informacoes,string smtp, string senhasmtp)
    {
        message += " ";
        message += "<table border='0' cellpadding='0' cellspacing='0' style='width:100%;'>";
        message += "<tr>";
        message += "<td>";
        message += "Nome";
        message += "</td>";
        message += "<td align='left'>";
        message += "" + nome;
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "E-mail";
        message += "</td>";
        message += "<td align='left'>";
        message += "" + emailcontato;
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "Assunto";
        message += "</td>";
        message += "<td align='left'>";
        message += "" + assunto;
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "Informações";
        message += "</td>";
        message += "<td align='left'>";
        message += "" + informacoes;
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "<td>   ";
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "</table>";

        // cria o objeto de mensagem de e-mail
        MailMessage objEmail = new MailMessage();

        // remetente do e-mail
        objEmail.From = new MailAddress(emailcontato);

        //destinatários do e-mail 
        objEmail.To.Add(emailsmtp);

        objEmail.Priority = MailPriority.Normal;
        // identifica se o conteúdo do e-mail é HTML ou texto simples

        objEmail.IsBodyHtml = true;
        // assunto do e-mail
        
        objEmail.Subject = "Contato site";
        
        // corpo do e-mail
        objEmail.Body = message;

        //Para evitar problemas de caracteres "estranhos", configuramos o charset para "ISO-8859-1" 
        objEmail.SubjectEncoding = System.Text.Encoding.GetEncoding("ISO-8859-1");
        objEmail.BodyEncoding = System.Text.Encoding.GetEncoding("ISO-8859-1");

        // cria o objeto que envia de fato o e-mail
        SmtpClient objSmtp = new SmtpClient();
        objSmtp.Host = smtp;
        objSmtp.Port = 25;

        objSmtp.DeliveryMethod = SmtpDeliveryMethod.Network;
        objSmtp.Credentials = new System.Net.NetworkCredential(emailsmtp, senhasmtp);
        objSmtp.UseDefaultCredentials = true;

        try
        {
            objSmtp.Send(objEmail);
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('Contato enviado com sucesso!'); </script>", false);
          

        }
        catch (Exception ex)
        {
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('" + ex.Message + "'); </script>", false);
        }
            
    
    
    }
}