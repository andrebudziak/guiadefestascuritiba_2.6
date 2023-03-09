using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using iTextSharp.text;
using iTextSharp.text.pdf;
using iTextSharp.text.html.simpleparser;
using System.IO;
using System.Text;
using System.Collections;
using System.Net;
using System.Net.Mail;

public partial class Administracao_Default2 : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        { 
            txtVencimento.Text = new DateTime(2009, 3, 6).ToString("dd/MM/yyyy");
            txtValorBoleto.Text = "656,40";
            txtNumeroDocumentoBoleto.Text = "B20005446";

            //'Cedente
            txtCodigoCedente.Text = "0806498";
            txtNossoNumeroBoleto.Text = "00000333271";
            txtCPFCNPJ.Text = "59.323.998/0001-08";
            txtNomeCedente.Text = "Uniabc";
            txtAgenciaCendente.Text = "432";
            txtContaCedente.Text = "0806498";

            //'Sacado
            txtCPFCNPJSacado.Text = "000.000.000-00";
            txtNomeSacado.Text = "Fulano de Silva";
            txtEnderecoSacado.Text = "SSS 154 Bloco J Casa 23";
            txtBairroSacado.Text = "Testando";
            txtCidadeSacado.Text = "Testelândia";
            txtCEPSacado.Text = "70000000";
            txtUFSacado.Text = "DF";         
        
        
        }
    }

    protected void Button1_Click(object sender, EventArgs e)
    {

        //'Informa os dados do cedente
        BoletoNet.Cedente c = new BoletoNet.Cedente("10.624.585/0001-74", "TEM NA REDE PROVEDORES LTDA", "4195","5", "95338","8");
        //'Dependendo da carteira, é necessário informar o código do cedente (o banco que fornece)
        //c.Codigo = Convert.ToInt32(txtCodigoCedente.Text);

        //'Dados para preenchimento do boleto (data de vencimento, valor, carteira e nosso número)
        BoletoNet.Boleto b = new BoletoNet.Boleto(Convert.ToDateTime(txtVencimento.Text), Convert.ToDouble(txtValorBoleto.Text), "16", txtNossoNumeroBoleto.Text, c);
        

        //'Dependendo da carteira, é necessário o número do documento
        b.NumeroDocumento = txtNumeroDocumentoBoleto.Text;

        //'Informa os dados do sacado
        b.Sacado = new BoletoNet.Sacado(txtCPFCNPJSacado.Text, txtNomeSacado.Text);
        b.Sacado.Endereco.End = txtEnderecoSacado.Text;
        b.Sacado.Endereco.Bairro = txtBairroSacado.Text;
        b.Sacado.Endereco.Cidade = txtCidadeSacado.Text;
        b.Sacado.Endereco.CEP = txtCEPSacado.Text;
        b.Sacado.Endereco.UF = txtUFSacado.Text;

        BoletoNet.Instrucao_BancoBrasil i = new BoletoNet.Instrucao_BancoBrasil();
        i.Descricao = "Não Receber após o vencimento";
        b.Instrucoes.Add(i);

        //'Espécie do Documento - [R] Recibo
        b.EspecieDocumento = new BoletoNet.EspecieDocumento_BancoBrasil();

        BoletoNet.BoletoBancario bb = new BoletoNet.BoletoBancario();
        bb.CodigoBanco = 01; //'-> Referente ao código do Banco do Brasil
        bb.Boleto = b;
        bb.MostrarCodigoCarteira = true;
        bb.Boleto.Valida();

        bb.MostrarComprovanteEntrega = true;

        panelDados.Visible = false;

        if(panelBoleto.Controls.Count == 0)
            panelBoleto.Controls.Add(bb);

        bb.MontaHtmlNoArquivoLocal(Server.MapPath(".") + "/boleto/" + "boleto.html");

        /*string message = "";

        message += "";
        
        message += "<table style='width: 100%;' border='0' cellpadding='0' cellspacing='0'>";
        message += "<tr>";
        message += "<td>";
        message += "Ola! " + "Andre Budziak Neto" + " ";
        message += "</td> ";
        message += "</tr>";
        message += "<tr>";
        message += "<td>  ";
        message += "Este é o boleto de cobrança referente aos serviços prestados. ";
        message += "</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "O boleto esta em anexo no formato html. ";
        message += "</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td style='height:100px;'>";
        message += "</td> ";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "</td> ";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "</td> ";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "Muito obrigado !!!!</td> ";
        message += "</tr>";
        message += "<tr>";
        message += "<td style='height:50px;'>";
        message += "</td> ";
        message += "</tr>";
        message += "<tr>";
        message += "<td>  ";
        message += " Guia de Festas Curitiba " ;
        message += "</td>";
        message += "</tr>";
        message += "<tr>";
        message += "<td>";
        message += "</td> ";
        message += "</tr>";
        message += "</table>";


        // cria o objeto de mensagem de e-mail
        MailMessage objEmail = new MailMessage();

        // remetente do e-mail
        objEmail.From = new MailAddress("cobranca@guiadefestacuritiba.com.br");
        // responder para 
        //objEmail.ReplyTo = new MailAddress("email@docliente.com.br");

        //destinatários do e-mail 
        objEmail.To.Add("andre_budziak@hotmail.com");
        //objEmail.To.Add("teste2@email.com.br");
        // veja que podemos adicionar quantos e-mails desejarmos como destino, para isto, repita a linha acima modificando o e-mail

        // cópia oculta da mensagem
        //objEmail.Bcc.Add("email@oculto.com.br");

        objEmail.Priority = MailPriority.Normal;
        // identifica se o conteúdo do e-mail é HTML ou texto simples
        objEmail.IsBodyHtml = true;
        // assunto do e-mail
        objEmail.Subject = "Boleto";
        // corpo do e-mail
        objEmail.Body = message;

        AlternateView vwBoleto = bb.HtmlBoletoParaEnvioEmail();

        objEmail.AlternateViews.Add(vwBoleto);

        //Para evitar problemas de caracteres "estranhos", configuramos o charset para "ISO-8859-1" 
        objEmail.SubjectEncoding = System.Text.Encoding.GetEncoding("ISO-8859-1");
        objEmail.BodyEncoding = System.Text.Encoding.GetEncoding("ISO-8859-1");


        var dataStream = vwBoleto.ContentStream;
        byte[] byteBuffer = new byte[dataStream.Length];
        var encoding = Encoding.GetEncoding(vwBoleto.ContentType.CharSet);
        string body = encoding.GetString(byteBuffer, 0,
            dataStream.Read(byteBuffer, 0, byteBuffer.Length));*/

        

        /*
        // cria o objeto que envia de fato o e-mail
        SmtpClient objSmtp = new SmtpClient();
        objSmtp.Host = "smtp.guiadefestacuritiba.com.br";
        objSmtp.Port = 25;

        
        objSmtp.DeliveryMethod = SmtpDeliveryMethod.Network;
        objSmtp.Credentials = new System.Net.NetworkCredential("cobranca@guiadefestacuritiba.com.br", "guia@curitiba");
        objSmtp.UseDefaultCredentials = true;
        

        try
        {
            objSmtp.Send(objEmail);
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('Contato enviado com sucesso!'); </script>", false);

        }
        catch (Exception ex)
        {
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('" + ex.Message + "'); </script>", false);
        }*/



    }

    private string GerarImagem()
    {
        string address = Server.MapPath(".") + "/boleto/" + "boleto.html";
        int width = 1536;
        int height = 2048;

        int webBrowserWidth = 670;
        int webBrowserHeight = 1000;

        System.Drawing.Bitmap bmp = WebsiteThumbnailImageGenerator.GetWebSiteThumbnail(address, webBrowserWidth, webBrowserHeight, width, height);

        string file = Server.MapPath(".") + "/boleto/" + "boleto.bmp";

        bmp.Save(file);
        
        using (System.Drawing.Image img = System.Drawing.Image.FromFile(Server.MapPath(".") + "/boleto/" + "boleto.bmp"))
        {
            img.Save(Server.MapPath(".") + "/boleto/" + "boleto.jpg", System.Drawing.Imaging.ImageFormat.Jpeg);
        }
        return file;
    }


    protected void btnGeraPdf_Click(object sender, EventArgs e)
    {
        string imagePath = GerarImagem();
        imagePath = Server.MapPath(".") + "/boleto/" + "boleto.jpg";

        string pdfPath = Server.MapPath(".") + "/boleto/" + "boleto.pdf";

        Document doc = new Document();
        try
        {
            PdfWriter.GetInstance(doc, new FileStream(pdfPath, FileMode.Create));
            doc.Open();
            iTextSharp.text.Image gif = iTextSharp.text.Image.GetInstance(imagePath);
            //gif.ScaleAbsolute(520f, 624f);
            gif.ScaleToFit(800, 600);
            doc.Add(gif);
        }
        catch (DocumentException dex)
        {

        }
        catch (IOException ioex)
        {

        }
        catch (Exception ex)
        {

        }
        finally
        {
            doc.Close();
        }

    }
}