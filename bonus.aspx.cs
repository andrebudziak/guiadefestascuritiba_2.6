using System;
using System.Collections.Generic;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.Net;
using System.Net.Mail;
//using iTextSharp.text;
//using iTextSharp.text.pdf;
using System.IO;

public partial class bonus : System.Web.UI.Page
{
    public string message;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            lblData.Text = "Curitiba," + DateTime.Now.ToString();
            txtCodigoAnunciante.Visible = false;
            lblImagem.Visible = false;

            if (Request.QueryString["anunciante"] != null)
            {
               txtCodigoAnunciante.Text = Request.QueryString["anunciante"].ToString();
               //Alimenta Anunciantes
               WebService ws = new WebService();               
               DataSet dadosA = new DataSet();
               dadosA = ws.bonusAnunciante(Convert.ToInt32(txtCodigoAnunciante.Text));

               lblAnunciante.Text = dadosA.Tables[0].Rows[0]["nome_fantasia"].ToString();
               lblEndereco.Text = dadosA.Tables[0].Rows[0]["endereco"].ToString() + "\n" +
                                  dadosA.Tables[0].Rows[0]["bairro"].ToString() + "\n" + dadosA.Tables[0].Rows[0]["cidade"].ToString();
               imgBonus.Src = "~/bonus/" + dadosA.Tables[0].Rows[0]["bonus"].ToString() + "";
               lblImagem.Text = dadosA.Tables[0].Rows[0]["bonus"].ToString();

            }
        }
    }
    protected void btn_imprimir_Click(object sender, ImageClickEventArgs e)
    {
        if ((txtEmail.Text != "") && (txtNome.Text != "") && (txtFone.Text != ""))
        {
           // string myScript = @"window.print();";
           // ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);

            WebService ws = new WebService();               
            if(ws.IncluirBonusRetorno(0,Convert.ToInt32(txtCodigoAnunciante.Text),txtNome.Text,txtFone.Text,txtEmail.Text,DateTime.Now) ==0 )
            {
               string myScript2 = @"alert('Erro ao gravar informacoes!');";
               ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript2 + "</script>", false);            
            }
            
            message += " ";
            message += "<table border='0' cellpadding='0' cellspacing='0' style='width:100%;'>";
            message += "<tr>";
            message += "<td>";
            message += "Nome";
            message += "</td>";
            message += "<td align='left'>";
            message += "" + txtNome.Text;
            message += "</td>";
            message += "<td>";
            message += "&nbsp;</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "E-mail";
            message += "</td>";
            message += "<td align='left'>";
            message += "" + txtEmail.Text;
            message += "</td>";
            message += "<td>";
            message += "&nbsp;</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "Telefone";
            message += "</td>";
            message += "<td align='left'>";
            message += "" + txtFone.Text;
            message += "</td>";
            message += "<td>";
            message += "&nbsp;</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "Anunciante";
            message += "</td>";
            message += "<td align='left'>";
            message += "" + lblAnunciante.Text;
            message += "</td>";
            message += "<td>";
            message += "&nbsp;</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "Data";
            message += "</td>";
            message += "<td align='left'>";
            message += "" + lblData.Text;
            message += "</td>";
            message += "<td>";
            message += "&nbsp;</td>";
            message += "</tr>";
            message += "</table>";

            GeraPDF(lblImagem.Text);

            
            // cria o objeto de mensagem de e-mail
            MailMessage objEmail = new MailMessage();

            // remetente do e-mail
            objEmail.From = new MailAddress("bonus@guiadefestacuritiba.com.br");
            // responder para 
            //objEmail.ReplyTo = new MailAddress("email@docliente.com.br");

            //destinatários do e-mail 
            objEmail.To.Add("bonus@guiadefestacuritiba.com.br");
            //objEmail.To.Add("teste2@email.com.br");
            // veja que podemos adicionar quantos e-mails desejarmos como destino, para isto, repita a linha acima modificando o e-mail

            // cópia oculta da mensagem
            objEmail.Bcc.Add("comercial@temnarede.com.br");

            objEmail.Priority = MailPriority.Normal;
            // identifica se o conteúdo do e-mail é HTML ou texto simples
            objEmail.IsBodyHtml = true;
            // assunto do e-mail
            objEmail.Subject = "Retorno Bonus";
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
            objSmtp.Credentials = new System.Net.NetworkCredential("bonus@guiadefestacuritiba.com.br", "guia2010");
            objSmtp.UseDefaultCredentials = true;

            objSmtp.Send(objEmail);
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('Contato enviado com sucesso!'); </script>", false);
            txtNome.Text = "";
            txtFone.Text = "";
            txtEmail.Text = "";
            

        }
        else
        {
            string myScript = @"alert('Campos Nome, Telefone e Email sao obrigatorios!');";
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);
        }

    }

    void GeraPDF(string imagem)
    {
     /*   Response.ContentType = "application/pdf";

        Response.AddHeader("content-disposition", "attachment;filename=bonus.pdf");

        Response.Cache.SetCacheability(HttpCacheability.NoCache);

        string imageFilePath = Server.MapPath(".") + "/bonus/"+imagem;

        iTextSharp.text.Image jpg = iTextSharp.text.Image.GetInstance(imageFilePath);

        // Page site and margin left, right, top, bottom is defined
        Document pdfDoc = new Document(PageSize.A4, 0f, 0f, 0f, 0f);

        //Resize image depend upon your need
        //For give the size to image
        jpg.ScaleToFit(500, 380);

        //If you want to choose image as background then,

        jpg.Alignment = iTextSharp.text.Image.UNDERLYING;

        //If you want to give absolute/specified fix position to image.
        jpg.SetAbsolutePosition(50, 450);
        

        PdfWriter.GetInstance(pdfDoc, Response.OutputStream);

        pdfDoc.Open();

        pdfDoc.NewPage();

        BaseFont Arial = BaseFont.CreateFont(BaseFont.HELVETICA, BaseFont.CP1252, BaseFont.NOT_EMBEDDED);
        Font font = new Font(Arial, 11);

        BaseFont Arial2 = BaseFont.CreateFont(BaseFont.HELVETICA, BaseFont.CP1252, BaseFont.NOT_EMBEDDED);
        Font font2 = new Font(Arial, 13);
        

        PdfPTable datatable = new PdfPTable(1);
        datatable.DefaultCell.Padding = 1;

        float[] headerwidths = { 100 }; // percentage
        datatable.SetWidths(headerwidths);
        datatable.WidthPercentage = 100; // percentage

        datatable.DefaultCell.BorderWidth = 1;
        datatable.DefaultCell.HorizontalAlignment = Element.ALIGN_CENTER;
        datatable.AddCell("");

        datatable.HeaderRows = 1;  // this is the end of the table header
        
        datatable.DefaultCell.BorderWidth = 0;

        Phrase text1 = new Phrase("Ao contratar os serviços do", font);
        Phrase text2 = new Phrase(lblAnunciante.Text, font2);
        Phrase text3 = new Phrase(lblEndereco.Text+"\n\n", font);
        Phrase text4 = new Phrase("apresente este Bônus e conheça as vantagens de ser \n um cliente do Guia de Festas Curitiba.\n\n", font);
        Phrase text5 = new Phrase("Nome:" + txtNome.Text, font);
        Phrase text6 = new Phrase("E-mail:" + txtEmail.Text, font);
        Phrase text7 = new Phrase("Telefone:" + txtFone.Text + "\n\n", font);
        Phrase text8 = new Phrase(DateTime.Now.ToString()+"\n\n", font);
        Phrase text9 = new Phrase("Bônus válido por 30 dias", font);
        Phrase text10 = new Phrase("Bônus não acumulativo", font);
        
        datatable.AddCell("\n\n\n\n\n\n\n\n\n\n\n");
        datatable.AddCell(text1);
        datatable.AddCell(text2);
        datatable.AddCell(text3);
        datatable.AddCell(text4);
        datatable.AddCell(text5);
        datatable.AddCell(text6);
        datatable.AddCell(text7);
        datatable.AddCell(text8);
        datatable.AddCell(text9);
        datatable.AddCell(text10);


        pdfDoc.Add(datatable);

        pdfDoc.Add(jpg);

        pdfDoc.Close();

        Response.Write(pdfDoc);

        Response.End();*/
    }

   
}
