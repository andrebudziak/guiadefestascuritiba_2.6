using System;
using System.Collections;
using System.Configuration;
using System.Data;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Net;
using System.Net.Mail;

public partial class contato : System.Web.UI.Page
{
    private string message = "";

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {

        }

    }
    protected void btnEnviar_Click(object sender, ImageClickEventArgs e)
    {
        message += " ";
        message += "<table border='0' cellpadding='0' cellspacing='0' style='width:100%;'>";
        message += "<tr>";
        message += "<td>";
        message += "Nome";
        message += "</td>";
        message += "<td align='left'>";
        message += ""+txtNome.Text;
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "E-mail";
        message += "</td>";
        message += "<td align='left'>";
        message += ""+txtEmail.Text ;
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "Telefone";
        message += "</td>";
        message += "<td align='left'>";
        message += ""+txtFone.Text;
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "Cidade";
        message += "</td>";
        message += "<td align='left'>";
        message += ""+txtCidade.Text;
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "Assunto";
        message += "</td>";
        message += "<td align='left'>";
        message += ""+txtAssunto.Text;
        message += "</td>";
        message += "<td>";
        message += "&nbsp;</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "Informações";
        message += "</td>";
        message += "<td align='left'>";
        message += ""+txtInformacoes.Text;
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
        objEmail.From = new MailAddress("contato@guiadefestascuritiba.com.br");
        // responder para 
        //objEmail.ReplyTo = new MailAddress("email@docliente.com.br");

        //destinatários do e-mail 
        objEmail.To.Add("contato@guiadefestascuritiba.com.br");
        //objEmail.To.Add("teste2@email.com.br");
        // veja que podemos adicionar quantos e-mails desejarmos como destino, para isto, repita a linha acima modificando o e-mail

        // cópia oculta da mensagem
        //objEmail.Bcc.Add("email@oculto.com.br");

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
        objSmtp.Host = "smtp.guiadefestacuritiba.com.br";
        objSmtp.Port = 25;

        objSmtp.DeliveryMethod = SmtpDeliveryMethod.Network;
        objSmtp.Credentials = new System.Net.NetworkCredential("contato@guiadefestascuritiba.com.br", "ct@guia");
        objSmtp.UseDefaultCredentials = true;

        try
        {
            objSmtp.Send(objEmail);
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('Contato enviado com sucesso!'); </script>", false);
            txtNome.Text = "";
            txtCidade.Text = "";
            txtFone.Text = "";
            txtEmail.Text = "";
            txtAssunto.Text = "";
            txtInformacoes.Text = "";
        
        }
        catch (Exception ex)        
        {
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('"+ex.Message+"'); </script>", false);        
        }
        

    }
    protected void btnLimpar_Click(object sender, ImageClickEventArgs e)
    {
        txtNome.Text = "";
        txtCidade.Text = "";
        txtFone.Text = "";
        txtEmail.Text = "";
        txtAssunto.Text = "";
        txtInformacoes.Text = "";

    }
  
}
